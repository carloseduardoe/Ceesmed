<?php

namespace CEM\Http\Controllers;

use CEM\Role;
use CEM\User;
use CEM\Doctor;
use Illuminate\Http\Request;
use CEM\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
  public function index() {
    if (Auth::user()->cant('index', Role::class)) {
      abort(403, 'This action is unauthorized');
    }

    $data = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')
    ->join('roles', 'role_user.role_id', '=', 'roles.id')
    ->where('role_user.role_id', '<>', '1')
    ->orderBy('role_user.role_id', 'DESC')
    ->orderBy('users.name')
    ->select('users.id as user_id', 'users.name as user', 'roles.name as role', 'role_user.id as id')
    ->paginate();

    return view('crud.roles.index', compact('data'));
  }

  public function create() {
    if (Auth::user()->cant('create', Role::class)) {
      abort(403, 'This action is unauthorized');
    }
    return view('crud.roles.create')->with([
      'users' => User::get(['id', 'name']),
      'roles' => Role::where('name', '<>', 'patient')->get(['id', 'name'])
    ]);
  }

  public function store(RoleRequest $request) {
    if (Auth::user()->cant('create', Role::class)) {
      abort(403, 'This action is unauthorized');
    }
    if (User::find($request->user_id)->hasRole([Role::find($request->role_id)->name])) {
      return back()->with([
        'info' => 'The requested Role is already assigned.',
      ]);
    } else {
      if (Role::find($request->role_id)->name == 'doctor') {
        return redirect()->route('doctors.create');
      } else {
        User::find($request->user_id)->roles()->attach(Role::find($request->role_id));
        return redirect()->route('roles.index')->with([
          'info' => 'Role assigned successfully'
        ]);
      }
    }
  }

  public function show(Role $role) {
    if (Auth::user()->cant('index', Role::class)) {
      abort(403, 'This action is unauthorized');
    }
    return redirect()->route('roles.index', ['n', $role->id]);
  }

  public function destroy($id) {
    if (Auth::user()->cant('delete', Role::find(1))) {
      abort(403, 'This action is unauthorized');
    }

    $data = DB::table('role_user')->where('id', $id)->first();
    if (Role::where('id', $data->role_id)->first()->name == 'doctor') {
      Doctor::where('user_id', $data->user_id)->delete();
    }
    DB::table('role_user')->where('id', $data->id)->delete();

    return redirect()->route('roles.index')->with([
      'info' => 'Role deleted successfully.'
    ]);
  }
}
