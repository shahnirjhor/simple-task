<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

/**
 * Class RoleController
 * @package App\Http\Controllers
 * @category Controller
 */
class RoleController extends Controller
{
    /**
     * load constructor method
     *
     * @access public
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:role-read|role-create|role-edit|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @access public
     * @return mixed
     */
    public function index(Request $request)
    {
        $title = "Plan List";
        $roles = $this->filter($request)->paginate(10)->withQueryString();
        return view('roles.index', compact('roles','title'));
    }

    private function filter(Request $request)
    {
        $query = Role::latest();
        if ($request->name)
            $query->where('name', 'like', $request->name . '%');
        if (isset($request->role_for))
            $query->where('role_for', $request->role_for);
        return $query;
    }
}
