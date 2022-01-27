<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Library
use Str;

// Load Model
use App\Models\SuratModel;
use App\Models\MasterJenisModel;
use App\Models\MasterAsalModel;
use App\Models\MasterDisposisiModel;

class Surat extends Controller
{
    private $views      = '/surat';
    private $url        = "/surat";

    public function __construct()
    {
        $this->mSurat = new SuratModel();
        $this->mJenis = new MasterJenisModel();
        $this->mAsal = new MasterAsalModel();
        $this->mDisposisi = new MasterDisposisiModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Variable
        $title = 'Data Surat';
        $url = $this->url;

        // Get Data

        // View
        return view("$this->views/index", compact('title', 'url'));
    }

    public function getData()
    {
        $data = $this->mSurat->getSurat();
        return \DataTables::queryBuilder($data)
            ->addIndexColumn()
            ->addColumn('berkas', function($data) {
                return '<a href="'.$data->berkas.'">Lihat Berkas</a>';
            })
            ->addColumn('actions', function($data) {
                return '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'. url("$this->url/$data->id/edit") .'" class="btn btn-primary">Edit</a>
                        <a href="javascript:void(0);" class="btn btn-danger delete" data-id="'. $data->id .'">Delete</a>
                    </div>';
            })
            ->rawColumns(['actions', 'berkas'])
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
        $title = 'Tambah Surat';
        $url = $this->url;

        // Get Data
        $data = [
            'jenis_surat' => $this->mJenis->all(),
            'asal_surat' => $this->mAsal->all(),
            'disposisi' => $this->mDisposisi->all(),
        ];

        // View
        return view("$this->views/create", compact('title', 'url', 'data'));
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
            'kategori' => 'required',
            'jenis_id' => 'required',
            'asal_id' => 'required',
            'nomor' => 'required',
            'tanggal' => 'required',
            'perihal' => 'required',
            'berkas' => 'required'
        ]);

        // Request File
        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $fileName = Str::uuid().".".$file->extension();
            $file->move(public_path() . "/upload/berkas/", $fileName);
        }

        // Table surat
        $dataSurat = [
            'users_id' => session('users_id'),
            'kategori' => $request->kategori,
            'jenis_id' => $request->jenis_id,
            'asal_id' => $request->asal_id,
            'disposisi_id' => $request->disposisi_id,
            'nomor' => $request->nomor,
            'tanggal' => $request->tanggal,
            'perihal' => $request->perihal,
            'berkas' => $fileName ?? null,
        ];
        $this->mSurat->create($dataSurat);

        // Response
        return redirect("$this->url")->with('sukses', 'Surat Berhasil Ditambahkan');
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
        $title = 'Ubah Surat';
        $url = $this->url;

        // Get Data
        $id = $id;
        $data = [
            'jenis_surat' => $this->mJenis->all(),
            'asal_surat' => $this->mAsal->all(),
            'disposisi' => $this->mDisposisi->all(),
            
        ];
        $surat = $this->mSurat->where('id', $id)->first();

        // View
        return view("$this->views/edit", compact('title', 'url', 'id', 'data', 'surat'));
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
            'kategori' => 'required',
            'jenis_id' => 'required',
            'asal_id' => 'required',
            'nomor' => 'required',
            'tanggal' => 'required',
            'perihal' => 'required',
            'berkas' => 'nullable'
        ]);

        // Get Data
        $surat = $this->mSurat->where('id', $id)->first();
        // dd($request->all());

        // Request File
        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $fileName = Str::uuid().".".$file->extension();
            $file->move(public_path() . "/upload/berkas/", $fileName);
        }

        // Table surat
        $dataSurat = [
            'users_id' => session('users_id'),
            'kategori' => $request->kategori,
            'jenis_id' => $request->jenis_id,
            'asal_id' => $request->asal_id,
            'disposisi_id' => $request->disposisi_id,
            'nomor' => $request->nomor,
            'tanggal' => $request->tanggal,
            'perihal' => $request->perihal,
            'berkas' => $fileName ?? $surat->berkas,
        ];
        $this->mSurat->where('id', $id)->update($dataSurat);

        // Response
        return redirect("$this->url")->with('sukses', 'Surat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // // Get Data
        // $banners        = $this->mBanner->find($id);
        
        // // Define Path File or Folder
        // $path       = public_path() . "/upload/banner/" . $banners->filename;
        // if (file_exists($path))
        // {
        //     // Remove File
        //     unlink($path);
        // }

        // // Remove Data from Table
        // $banners->delete();

        // // Reponse
        // // return redirect($this->url)->with('sukses', 'Banner Berhasil Dihapus');
        // return response()->json(['message' => 'ok']);
        $surat = $this->mSurat->findOrFail($id);

        // Path
        $path = public_path() . "/upload/berkas/" . $surat->berkas;
        if (file_exists($path)) {
            unlink($path);
        }
        $surat->delete();

        // Response
        $response = [
            'status' => true,
            'code' => 200,
            'message' => 'Berhasil Dihapus',
        ];
        return response()->json($response);
    }
}
