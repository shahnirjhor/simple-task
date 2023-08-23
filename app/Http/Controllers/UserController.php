<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

/**
 * Class UserController
 * @package App\Http\Controllers
 * @category Controller
 */
class UserController extends Controller
{
    /**
     * load constructor method
     *
     * @access public
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:user-read|user-create|user-update|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource
     *
     * @access public
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = "User List";
        $users = $this->filter($request)->paginate(10)->withQueryString();
        return view('users.index', compact('users', 'title'));
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
        $roleName = auth()->user()->getRoleNames();
        $roleFor = $roleName['0'];

        $query = User::orderBy('id', 'DESC');

        if ($request->id)
            $query->where('id', $request->id);

        if ($request->name)
            $query->where('name', 'like', $request->name . '%');

        if ($request->email)
            $query->where('email', 'like', $request->email . '%');

        if ($roleFor != "Super Admin")
            $query->where('id', Auth::user()->id);

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "User Create";
        $staffRoles = Role::where('role_for', '1')->pluck('name', 'name')->all();
        return view('users.create', compact('staffRoles', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $data = $request->only(['name', 'email', 'phone', 'status']);
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $user->assignRole($request->staff_roles);

        return redirect()->route('users.index')->with('success', trans('User Created Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $roleName = auth()->user()->getRoleNames();
        $roleFor = $roleName['0'];

        $staffRoles = ($roleFor == "Super Admin") ? (Role::pluck('name', 'name')->all()) : (Role::where('role_for', '1')->pluck('name', 'name')->all());

        return view('users.edit', compact('user', 'roleFor', 'staffRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validation($request, $user->id);

        $password = $user->password;
        $roles = $request->staff_roles;

        $data = $request->only(['name', 'email', 'phone', 'status']);
        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $password;
        }
        $user->update($data);
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($roles);
        return redirect()->route('users.index')->with('success', trans('User Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function validation(Request $request, $id = 0)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'staff_roles' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
        ]);
        if ($id === 0) {
            $this->validate($request, [
                'email' => ['required', 'unique:users,email', 'email', 'max:255'],
                'password' => ['required', 'same:password_confirmation'],
            ]);
        } else {
            $this->validate($request, [
                'email' => ['required', 'unique:users,email,' . $id, 'email', 'max:255'],
                'password' => ['nullable', 'same:password_confirmation']
            ]);
        }
    }
}
