@extends( $appTemplate )

@section('css-library')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('css')
<style>
    th, td {
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-lg-4">
        <a href="{{ url("$url/create") }}" class="btn btn-primary">Tambah Data</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable1" class="table">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Perihal</th>
                            <th>Kategori Surat</th>
                            <th>Jenis Surat</th>
                            <th>Asal Surat</th>
                            <th>Disposisi</th>
                            <th>Tanggal</th>
                            <th>Berkas</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-library')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('js')
<script>
    $(function() {
        var table = $('#datatable1').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            scrollY: true,
            scrollX: true,
            scrollCollapse: true,
            ajax: "{{ url("$url/get-data") }}",
            columns: [
                {
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    defaultContent: "",
                },
                {data: 'nomor', name: 's.nomor'},
                {data: 'tanggal', name: 's.tanggal'},
                {data: 'perihal', name: 's.perihal'},
                {data: 'kategori', name: 's.kategori'},
                {data: 'nama_jenis', name: 'mjenis.nama'},
                {data: 'nama_asal', name: 'masal.nama'},
                {data: 'nama_disposisi', name: 'mdisposisi.nama'},
                {data: 'tanggal', name: 's.tanggal'},
                {
                    data: 'berkas', 
                    name: 's.berkas', 
                    orderable: false, 
                    searchable: false
                },
                {
                    data: 'actions', 
                    name: 'actions', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });

        $('#datatable1').on('click', '.delete', function(res) {
            if (confirm('Apakah yakin?') == true) {
                // alert('gotcha');
                let id = $(this).data('id');
                $.ajax({
                    type: 'DELETE',
                    url: "{{ url("$url") }}/" + id,
                    success: (result) => {
                        // $('#datatable!')
                        setInterval(() => {
                            table.ajax.reload();
                        }, 1000);
                    }
                })
            }
        })
    })
</script>
@endsection