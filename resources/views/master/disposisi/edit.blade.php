@extends( $appTemplate )

@section('css-library')
    
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
            <form action="{{ url("$url/" . $id) }}" method="post">
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
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" id="i-nama" class="form-control" name="nama" value="{{ $disposisi->nama }}" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js-library')
    
@endsection

@section('js')
    
@endsection