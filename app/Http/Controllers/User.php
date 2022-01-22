<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Library
use Illuminate\Support\Facades\Hash;

// Load Model
use App\Models\UserModel;
use App\Models\MasterRoleModel;

class User extends Controller
{
    private $views      = '/user';
    private $url        = "/user";

    public function __construct()
    {
        $this->mUser = new UserModel();
        $this->mMasterRole = new MasterRoleModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Variable
        $title = 'Data User';
        $url = $this->url;

        // Get Data
        $users = $this->mUser->all();

        // View
        return view("$this->views/index", compact('title', 'url', 'users'));
    }

    public function getData()
    {
        $data = $this->mUser->getUsersWithRole();
        return \DataTables::queryBuilder($data)
            ->addIndexColumn()
            ->addColumn('actions', function($data) {
                return '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'. url("$this->url/$data->id/edit") .'" class="btn btn-primary">Edit</a>
                        <a href="javascript:void(0);" class="btn btn-danger delete" data-id="'. $data->id .'">Delete</a>
                    </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Variable
        $title = 'Tambah User';
        $url = $this->url;

        // Get Data
        $roles = $this->mMasterRole->all();

        // View
        return view("$this->views/create", compact('title', 'url', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $hai = $request->validate([
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|min:5',
            'password_confirm' => 'required|min:5|same:password',
            'role_id' => 'required',
        ]);

        // Table users
        $dataUsers = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ];
        $this->mUser->create($dataUsers);

        // Response
        return redirect("$this->url")->with('sukses', 'User Berhasil Ditambahkan');
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
        // Variable
        $title = 'Ubah User';
        $url = $this->url;

        // Get Data
        $roles = $this->mMasterRole->all();
        $users = $this->mUser->where('id', $id)->first();

        // View
        return view("$this->views/edit", compact('title', 'url', 'roles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate
        $request->validate([
            'username' => 'required|min:3|unique:users,username,'.$id,
            'password' => 'nullable|min:5',
            'password_confirm' => 'nullable|min:5|same:password',
            'role_id' => 'required',
        ]);

        // Table users
        if ($request->has('password')) {
            $dataUsers = [
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ];
        } else {
            $dataUsers = [
                'username' => $request->username,
                'role_id' => $request->role_id,
            ];
        }
        $this->mUser->where('id', $id)->update($dataUsers);

        // Response
        return redirect("$this->url")->with('sukses', 'User Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mUser->findOrFail($id)->delete();

        // Response
        $response = [
            'status' => true,
            'code' => 200,
            'message' => 'Berhasil Dihapus',
        ];
        return response()->json($response);
    }
}
