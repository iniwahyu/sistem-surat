<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library

// Load Model
use App\Models\MasterRoleModel;

class Role extends Controller
{
    private $views      = '/master/role';
    private $url        = "/master/role";

    public function __construct()
    {
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
        $title = 'Data Role';
        $url = $this->url;

        // Get Data
        $roles = $this->mMasterRole->all();

        // View
        return view("$this->views/index", compact('title', 'url', 'roles'));
    }

    public function getData()
    {
        $data = $this->mMasterRole->all();
        return \DataTables::of($data)
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
        $title = 'Tambah Role';
        $url = $this->url;

        // Get Data

        // View
        return view("$this->views/create", compact('title', 'url'));
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
        $request->validate([
            'nama' => 'required|unique:master_role,nama',
        ]);

        // Table master_role
        $dataMasterRole = [
            'nama' => $request->nama,
        ];
        $this->mMasterRole->create($dataMasterRole);

        // Response
        return redirect("$this->url")->with('sukses', 'Role Berhasil Ditambahkan');
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
        $title = 'Ubah Role';
        $url = $this->url;
        $id = $id;

        // Get Data
        $roles = $this->mMasterRole->where('id', $id)->first();

        // View
        return view("$this->views/edit", compact('title', 'url', 'id', 'roles'));
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
            'nama' => 'required|unique:master_role,nama,'.$id,
        ]);

        // Table master_role
        $dataMasterRole = [
            'nama' => $request->nama,
        ];
        $this->mMasterRole->where('id', $id)->update($dataMasterRole);

        // Response
        return redirect("$this->url")->with('sukses', 'Role Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mMasterRole->findOrFail($id)->delete();

        // Response
        $response = [
            'status' => true,
            'code' => 200,
            'message' => 'Berhasil Dihapus',
        ];
        return response()->json($response);
    }
}
