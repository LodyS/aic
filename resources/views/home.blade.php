<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 align="center">Daftar Bonus Pegawai </h3><hr/> <div align="right">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @can('add')<a href="{{ url('tambah-bonus')}}" class="dropdown-item">Form</a>@endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('list')
                    @include('flash-message')
                    <table class="table table-hover">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Bonus</th>
                            <th>Aksi</th>
                        </tr>

                        @foreach ($data as $key=>$d)
                        <tr>
                            <td>{{ ++$key}}</td>
                            <td>{{ $d['nama'] }}</td>
                            <td>{{ $d['total_bonus'] }}</td>
                            <td>
                                @can('view detail')<a href="{{ url('detail/'. $d['id'])}}" class="btn btn-info btn-xs">Detail</a>@endcan
                                @can('modify')<a href="{{ url('edit/'. $d['id'])}}" class="btn btn-success btn-xs">Edit</a>@endcan
                                @can('delete')<button type="button" data-id="{{ $d['id'] }}" class="btn btn-danger btn-xs hapus">Hapus</button>@endcan</td>
                        <tr>
                        @endforeach
                    </table>
                    <br/>NB : Link form ada di dropdown
                    @else
                    Anda tidak memiliki akses untuk melihat data bonus pegawai
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form name="frm_edit" id="frm_edit" class="form-horizontal" action="{{route('destroy-bonus')}}" method="POST">@csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Bonus Karyawan  <br/><br/>

                    <div class="form-group row">
			            <label class="col-md-3">Nama</label>
				            <div class="col-md-9">
                            <input type="text" readonly class="form-control" id="nama">
                        </div>
		            </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="{{ asset('js/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
<script src="{{ asset('js/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('js/sweetalert2/dist/sweetalert2.min.css') }}">

<script type="text/javascript">
$('.hapus').on("click",function() {
    var id = $(this).attr('data-id');

    $.ajax({
        url : "{{route('hapus-bonus')}}?id="+id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('#id').val(data.id);
            $('#nama').val(data.nama).change();
            $('#modal-edit').modal('show');
        }
    });
});
</script>
