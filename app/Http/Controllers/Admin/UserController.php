<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email', 'email_verified_at', 'created_at']);
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('email_verified_at', function(User $user) {
                    return is_null($user->email_verified_at) ? 'Not Verified' : 'Verified';
                })
                ->editColumn('created_at', function(User $user) {
                    return date('m/d/Y', strtotime($user->created_at));
                })
                ->addColumn('action', function($row){
                       $btn = "<a class='btn btn-primary' href=".url('admin/users/'.$row->id.'/edit').">
                                Edit
                            </a>
                            <form id='form'".$row->id." action=".url("admin/users", $row->id)." method='post'>
                                ".csrf_field()."
                                ".method_field("DELETE")."
                                <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are You Sure Want to Delete?\")'>
                                    Delete
                                </button>
                            </form>";

                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = request()->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->to('admin/users')->with('success', 'User Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);

        return view('admin.user.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $data           = request()->all();
        $user           = User::findorfail($id);
        $user->name     = $data['name'];
        $user->email    = $data['email'];

        if (isset($data['password']) && !is_null($data['password'])) {
            $user->password = \Hash::make($data['password']);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->to('admin/users');
    }
}