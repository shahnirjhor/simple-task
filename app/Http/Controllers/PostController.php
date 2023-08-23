<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Post;
use App\Jobs\AfterPublishPostJob;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PostController extends Controller
{
    /**
     * load constructor method
     *
     * @access public
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:post-read|post-create|post-update|post-delete', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @access public
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        dd($emails);
        dispatch(new AfterPublishPostJob())->delay(now()->addMinutes(1));
        dd("Email Has been delivered");

        $title = "All Posts";
        $posts = $this->filter($request)->paginate(10)->withQueryString();
        return view('posts.index', compact('title', 'posts'));
    }

    /**
     * Filter user data
     *
     * @access private
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    private function filter(Request $request)
    {
        $query = Post::orderBy('id', 'DESC');

        if ($request->id)
            $query->where('id', $request->id);

        if ($request->title)
            $query->where('title', 'like', $request->title . '%');

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Post Create";
        return view('posts.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $roleNameArray = auth()->user()->getRoleNames();
        $roleName = $roleNameArray['0'];
        $roleInfo = Role::where('name', $roleName)->first();

        $totalPosts = Post::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->count();

        if ($roleInfo->daily_post_limits == "0" || $totalPosts < $roleInfo->daily_post_limits) {
            $data = $request->only(['title', 'description', 'schedule_type', 'schedule_time']);
            $data['user_id'] = Auth::user()->id;
            if ($request->schedule_time == null && $request->schedule_type == null) {
                $data['schedule_time'] = date("Y-m-d h:i:s");
                $data['schedule_type'] = "now";
                $data['post_status'] = "Published";
            }
            Post::create($data);
            return redirect()->route('posts.index')->with('success', trans('Post Create Successfully'));
        } else {
            return redirect()->route('posts.index')->with('error', trans('Daily Post Limits Is Expired'));
        }
    }

    /**
     * validation check for create & edit
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    private function validation(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'schedule_type' => ['nullable', 'in:now,later'],
            'schedule_time' => ['required_if:schedule_type,later']
        ]);
    }
}
