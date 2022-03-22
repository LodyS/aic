<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">Tambah Bonus Pegawai
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
                    @can('add')
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
                    <form method="post" action="{{ url('/simpan-bonus') }}" id="tambah-bonus">{{ @csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-3">Pembayaran Bonus</label>
                            <div class="col-md-7">
                            <input type="text" id="pembayaran" class="form-control input" required>
                        </div>
                    </div>

                    <button class="btn btn-success" type="button" id="add">Tambah</button>

                    <table class="table table-hover" id="tambah_form">
                        <thead>
                            <tr>
                                <td>Nama</td>
                                <td>Bonus</td>
                                <td>Total Bonus</td>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>
                    <button type="submit" align="right" id="simpan" class="btn btn-primary">Simpan</button>
                    @else
                    Anda tidak memiliki akses untuk menambah data bonus pegawai
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

<script type="text/javascript">
$('.input').on('change click keyup input paste',(function (event) {
    $(this).val(function (index, value) {
        return value.replace(/(?!\,)\D/g, "").replace(/(?<=\,,*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
}));

function formatRupiah(number) {
  return number.toString().replace(/(?!\,)\D/g, "").replace(/(?<=\,,*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

var i = 0

$('#add').click(function() {
    i++;

    $('#tambah_form').append('<tr id="row' +i+ '">\n\
    <td><select class="form-control" id="nama-'+i+'" name="pegawai_id[]" required><option>Pilih</option>@foreach($pegawai as $id=>$nama)<option value="{{$id}}">{{$nama}}</option>@endforeach</select></td>\n\
    <td width="20%"><input type="text" id="bonus-' +i+ '" name="persen_bonus[]" class="form-control bonus" required></td>\n\
    <td width="20%"><input type="text" id="total_bonus-' +i+ '" name="total_bonus[]" class="form-control total_bonus" readonly></td>\n\
    <td><button type="button" name="remove" id="' +i+ '" class="btn btn-danger btn_remove">X</button></td></tr>');

    $(document).ready(function(){
        $('#nama-'+i).select2({
            width: '100%'
        });
    });

    $(function () {
        $('#pembayaran', '#bonus-'+i).prop('readonly', true);
            var $tblrows = $("#tambah_form tbody tr");

            $tblrows.each(function (index) {
                var $tblrow = $(this);
                $tblrow.find('#bonus-'+i).on('change keyup', function () {

                var bayar = $('#pembayaran').val();
                var pembayaran = Number(bayar.replace(/[^0-9,-]+/g,""));
                var persen_bonus = Number($tblrow.find('#bonus-'+i).val());
                var total_bonus = pembayaran * persen_bonus /100

                $tblrow.find('#total_bonus-'+i).val(formatRupiah(total_bonus));
                var grandTotal = 0;
                $('.bonus').each(function () {
                    var bonus = Number($(this).val());

                    grandTotal += bonus;
                });
                console.log(grandTotal)

                if (grandTotal >= 101){
                    //alert("Sudah tidak bisa input karena sudah 100 persen");
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Tidak bisa input karena bonus sudah 100 persen dibagikan!',
                    })

                    $('#simpan').prop('disabled', true);
                    $('#add').prop('disabled', true);
                    return false;
                }
            });
        });
    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove(); // Hapus form dinamis
    });

});
</script>
