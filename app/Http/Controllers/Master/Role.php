<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library

// Load Model
use App\Models\MasterRoleModel;

class Role extends Controller
{
    private $views      = 'master/role';
    private $url        = 'master/role';
    private $title      = '';

    public function __construct()
    {
        $this->mMasterRole  = new MasterRoleModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Data
        $roles = $this->mMasterRole->all();

        return view("$this->views/index", compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get Data
        
        // Variable
        $title = 'Tambah Role';
        $url = $this->url;

        return view("$this->views/add", compact('title', 'url'));
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

        $dataMasterRole = [
            'nama' => $request->nama,
        ];
        $this->mMasterRole->create($dataMasterRole);

        // Response
        return redirect($this->url)->with('sukses', 'Role Berhasil Ditambahkan');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
