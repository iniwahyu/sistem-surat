<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library

// Load Model
use App\Models\MasterJenisModel;

class Jenis extends Controller
{
    private $views      = '/master/jenis';
    private $url        = "/master/jenis";

    public function __construct()
    {
        $this->mMasterJenis = new MasterJenisModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Variable
        $title = 'Data Jenis Surat';
        $url = $this->url;

        // Get Data

        // View
        return view("$this->views/index", compact('title', 'url'));
    }

    public function getData()
    {
        $data = $this->mMasterJenis->all();
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
        $title = 'Tambah Jenis Surat';
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
            'nama' => 'required|unique:master_jenis,nama',
        ]);

        // Table master_role
        $dataMasterJenis = [
            'nama' => $request->nama,
        ];
        $this->mMasterJenis->create($dataMasterJenis);

        // Response
        return redirect("$this->url")->with('sukses', 'Jenis Surat Berhasil Ditambahkan');
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
        $title = 'Ubah Jenis Surat';
        $url = $this->url;
        $id = $id;

        // Get Data
        $jenis = $this->mMasterJenis->where('id', $id)->first();

        // View
        return view("$this->views/edit", compact('title', 'url', 'jenis', 'id'));
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
            'nama' => 'required|unique:master_jenis,nama,'.$id,
        ]);

        // Table master_role
        $dataMasterJenis = [
            'nama' => $request->nama,
        ];
        $this->mMasterJenis->where('id', $id)->update($dataMasterJenis);

        // Response
        return redirect("$this->url")->with('sukses', 'Jenis Surat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mMasterJenis->findOrFail($id)->delete();

        // Response
        $response = [
            'status' => true,
            'code' => 200,
            'message' => 'Berhasil Dihapus',
        ];
        return response()->json($response);
    }
}
