<style>

label {
  width: 300px;
  font-weight: bold;
  display: inline-block;
  margin-top: 20px;
}

label span {
  font-size: 1rem;
}

label.error {
    color: red;
    font-size: 1rem;
    display: block;
    margin-top: 5px;
}

input.error, textarea.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header"><h3 align="center">Update Bonus Pegawai</h3><hr/>
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
                    @can('modify')
                    <div class="card-header">
                    @include('flash-message')
                    <ul>
                        @foreach ($errors->all() as $error)

                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $error }}</strong>
                        </div>

                        @endforeach
                    </ul>
                    <form method="post" action="{{ url('/update-bonus') }}" id="edit-bonus">{{ @csrf_field() }}
                    <input type="hidden" name="id" value="{{ optional($data)->id }}">

                    <div class="form-group row">
                        <label class="col-md-3">Total Bonus</label>
                            <div class="col-md-7">
                            <input type="text" name="total_bonus" id="total_bonus" value="{{ optional($data)->total_bonus }}" class="form-control input">
                        </div>
                    </div>


                    <button type="submit" align="right" id="simpan" class="btn btn-primary">Simpan</button>
                    @else
                    Anda tidak memiliki akses untuk edit/modif data bonus pegawai
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


<script type="text/javascript">
$('.input').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\,)\D/g, "").replace(/(?<=\,,*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
}));

$(document).ready(function() {
    $("#edit-bonus").validate({
        rules: {
            total_bonus : {
                required: true,
            },
        },
        messages : {
            total_bonus: {
                required: "Total Bonus wajib diisi"
            }
        }
    });
});
</script>
