@extends( $appTemplate )

@section('css-library')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('css')
    
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-lg-4">
        <a href="{{ url("$url") }}" class="btn btn-primary">Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <form action="{{ url("$url/$id") }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kategori Surat</label>
                                <select id="select-kategori" class="form-control" name="kategori" required>
                                    <option value="">Pilih Kategori Surat</option>
                                    <option value="Masuk" {{ $surat->kategori == 'Masuk' ? 'selected' : '' }} >Surat Masuk</option>
                                    <option value="Keluar" {{ $surat->kategori == 'Keluar' ? 'selected' : '' }} >Surat Keluar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Surat</label>
                        <select id="select-jenis" class="form-control" name="jenis_id" required>
                            <option value="">Pilih Jenis Surat</option>
                            @foreach ($data['jenis_surat'] as $js)
                                <option value="{{ $js->id }}" {{ $surat->jenis_id == $js->id ? 'selected' : '' }} >{{ $js->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Asal Surat</label>
                        <select id="select-asal" class="form-control" name="asal_id" required>
                            <option value="">Pilih Asal Surat</option>
                            @foreach ($data['asal_surat'] as $as)
                                <option value="{{ $as->id }}" {{ $surat->asal_id == $as->id ? 'selected' : '' }} >{{ $as->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Disposisi</label>
                        <select id="select-disposisi" class="form-control" name="disposisi_id">
                            <option value="">Tidak Ada</option>
                            @foreach ($data['disposisi'] as $d)
                                <option value="{{ $d->id }}" {{ $surat->disposisi_id == $d->id ? 'selected' : '' }} >{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <input type="text" class="form-control" name="nomor" value="{{ $surat->nomor }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input type="text" id="i-tanggal" class="form-control" name="tanggal" value="{{ $surat->tanggal }}" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Perihal</label>
                        <textarea id="i-perihal" class="form-control" cols="30" rows="3" name="perihal" required>{{ $surat->perihal }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Berkas</label>
                        <input type="file" name="berkas" id="i-berkas" data-default-file="{{ url("/upload/berkas", ['filename' => $surat->berkas]) }}" data-max-file-size="3M">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-1 mb-1" required>Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js-library')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('js')
<script>
    $(function() {
        $('#i-tanggal').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });

        $('#i-berkas').dropify();
    })
</script>
@endsection