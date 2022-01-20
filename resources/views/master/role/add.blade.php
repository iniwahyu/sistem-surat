@extends($appTemplate)

@section('css-library')
    
@endsection

@section('css')
    
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <form action="{{ url("$url") }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" id="i-nama" class="form-control" name="nama" required autofocus>
                    </div>
                    <div class="col-12 mt-3">
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