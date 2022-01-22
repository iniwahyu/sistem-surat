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
            <form action="{{ url("$url/$users->id") }}" method="post">
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
                        <label>Username</label>
                        <input type="text" id="i-username" class="form-control" name="username" value="{{ $users->username }}" required readonly>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="i-password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" id="i-password-confirm" class="form-control" name="password_confirm">
                    </div>
                    <div class="form-group">
                        <label>Hak Akses / Role</label>
                        <select id="select-role" class="form-control" name="role_id" required>
                            <option value="">Pilih Hak Akses / Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $users->role_id ? 'selected' : '' }} >{{ $role->nama }}</option>
                            @endforeach
                        </select>
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