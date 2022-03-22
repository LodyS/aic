<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header"><h3 align="center">Detail Bonus Pegawai</h3><hr/>
                    <div align="right">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ url('home')}}" class="dropdown-item">Home</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
                    @can('view detail')
                    <div class="card-header">

                    <div class="form-group row">
                        <label class="col-md-3">Nama</label>
                            <div class="col-md-7">
                            <input type="text" value="{{ optional($data)->nama }} " class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3">Jabatan</label>
                            <div class="col-md-7">
                            <input type="text" value="{{ optional($data)->jabatan }} " class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3">Persen Bonus</label>
                            <div class="col-md-7">
                            <input type="text" value="{{ optional($data)->persen_bonus }} %" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3">Total Bonus</label>
                            <div class="col-md-7">
                            <input type="text" value="Rp. {{ number_format(optional($data)->total_bonus) }}" class="form-control" readonly>
                        </div>
                    </div>

                    @else
                    Anda tidak memiliki akses melihat data detail
                    @endcan

                </div>
            </div>
        </div>
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
