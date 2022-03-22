<?php

namespace App\Http\Controllers;
use App\Pegawai;
use App\Bonus;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\BonusRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $array = [];
        $query = Pegawai::join('bonus', 'bonus.pegawai_id', 'pegawai.id')->get(['bonus.id', 'nama', 'total_bonus', 'tanggal_lahir']);

        $data = $query->map(function($items){
            $array['id'] = $items->id;
            $array['total_bonus'] = 'Rp '.number_format($items->total_bonus,2,",",".");
            $array['nama'] = $items->nama;

            return $array;
        });

        return view('home', compact('data'));
    }

    public function create ()
    {
        $pegawai = Pegawai::whereNotIn('id', Bonus::select('pegawai_id'))->pluck('nama', 'id');
        return view('tambah-bonus', compact('pegawai'));
    }

    public function store (BonusRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            for ($i=0; $i<count($data['total_bonus']); $i++)
            {
                $total_bonus = str_replace('.', '', $data['total_bonus'][$i]);

                $insert = array (
                    'pegawai_id'=>$data['pegawai_id'][$i],
                    'persen_bonus'=>$data['persen_bonus'][$i],
                    'total_bonus'=>$total_bonus,);

                Bonus::create($insert);
            }
            DB::commit();
            return redirect('/home')->with('success', 'Data Berhasil disimpan');
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return back()->withError('Gagal simpan data');
        }
    }

    public function detail ($id)
    {
        $data = Bonus::select('pegawai.nama', 'total_bonus', 'persen_bonus', 'jabatan')
        ->leftJoin('pegawai', 'pegawai.id', 'bonus.pegawai_id')
        ->where('bonus.id', $id)
        ->first();

        return view('detail', compact('data'));
    }

    public function edit($id)
    {
        $data = Bonus::findOrFail($id);

        return view('edit', compact('data'));
    }

    public function update (Request $request)
    {
        DB::beginTransaction();

        try {
            $total_bonus = str_replace('.', '', $request->total_bonus);

            Bonus::find($request->id)->update(['total_bonus'=>$total_bonus]);
            DB::commit();
            return redirect('/home')->with('success', 'Data update disimpan');
        } catch (\Illuminate\Database\QueryException $e){
            DB::rollback();
            return back()->withError('Gagal update data');
        }
    }

    public function hapus (Request $request)
    {
        $data = Bonus::select('pegawai.nama', 'bonus.id')->leftJoin('pegawai', 'pegawai.id', 'bonus.pegawai_id')->where('bonus.id', $request->id)->first();

        echo json_encode($data);
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            Bonus::find($request->id)->delete();
            DB::commit();
            return redirect('home')->with('success', 'Data dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            DB::rollback();
            return back()->withError('Gagal hapus data');
        }
    }
}
