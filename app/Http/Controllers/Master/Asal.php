<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library

// Load Model
use App\Models\MasterAsalModel;

class Asal extends Controller
{
    private $views      = '/master/asal';
    private $url        = "/master/asal";

    public function __construct()
    {
        $this->mMasterAsal = new MasterAsalModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Variable
        $title = 'Data Asal Surat';
        $url = $this->url;

        // Get Data

        // View
        return view("$this->views/index", compact('title', 'url'));
    }

    public function getData()
    {
        $data = $this->mMasterAsal->all();
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
        $title = 'Tambah Asal Surat';
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
            'nama' => 'required|unique:master_asal,nama',
        ]);

        // Table master_asal
        $dataMasterAsal = [
            'nama' => $request->nama,
        ];
        $this->mMasterAsal->create($dataMasterAsal);

        // Response
        return redirect("$this->url")->with('sukses', 'Asal Surat Berhasil Ditambahkan');
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
        $title = 'Ubah Asal Surat';
        $url = $this->url;

        // Get Data
        $asal = $this->mMasterAsal->where('id', $id)->first();
        $id = $id;

        // View
        return view("$this->views/edit", compact('title', 'url', 'asal', 'id'));
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
            'nama' => 'required|unique:master_asal,nama,'.$id,
        ]);

        // Table master_asal
        $dataMasterAsal = [
            'nama' => $request->nama,
        ];
        $this->mMasterAsal->where('id', $id)->update($dataMasterAsal);

        // Response
        return redirect("$this->url")->with('sukses', 'Asal Surat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mMasterAsal->findOrFail($id)->delete();

        // Response
        $response = [
            'status' => true,
            'code' => 200,
            'message' => 'Berhasil Dihapus',
        ];
        return response()->json($response);
    }
}
