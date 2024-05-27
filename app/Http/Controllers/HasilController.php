<?php

namespace App\Http\Controllers;

use App\Models\Proses;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use App\Models\BiayaPemesanan;
use App\Models\BiayaPenyimpanan;

class HasilController extends Controller
{
    public function index($id)
    {
        $proses = Proses::find($id);
        // $proses->oi = $proses->oi;
        // $lt = $proses->lt;
        // $stok = $proses->stok;
        $dataBahanBaku = BahanBaku::where('tahun',$proses->tahun)->get();
        $total_X = $dataBahanBaku->sum('pemakaian');
        $s = $dataBahanBaku->sum('pembelian');
        $Xbar = $dataBahanBaku->avg('pemakaian');
        $h = BiayaPenyimpanan::sum('pertahun');
        $total_penyimpanan_perbulan = BiayaPenyimpanan::sum('perbulan');
        $total_pemesanan = BiayaPemesanan::sum('jumlah');

        $tahun = 2023;

        $xMin = array();
        $xMinPow = array();
        foreach ($dataBahanBaku as $row) {
            array_push($xMin, $row->pemakaian - $Xbar);
            array_push($xMinPow, pow($row->pemakaian - $Xbar, 2));
        }

        $total_powXbarMin = array_sum($xMinPow);

        $D = $total_X;;
        $K = $total_pemesanan;
        // sigma_d
        $countData = count($dataBahanBaku);
        $sigma_d = number_format(sqrt(number_format($total_powXbarMin, 3) / $countData), 3);
        // Foi
        $dOiLt = number_format($Xbar, 2) * ($proses->oi + $proses->lt);
        $zSigma = number_format(1.65 * $sigma_d * number_format(sqrt($proses->oi + $proses->lt), 3), 3);
        $foi = $dOiLt + $zSigma - $proses->stok;
        //Besar Biaya Perunit C
        $c = $h / $D;

        //Q_Optimal
        $Dp = $D * $K * 2;
        $sqrtQOptimal = $Dp / $c;
        $qOptimal_1 = sqrt($sqrtQOptimal);
        $qOptimal = ($qOptimal_1 / 30) * 4;
        //Menentukan Permintaan Harian
        $ss = $sigma_d * 1.65;
        $d = $D / 260;
        $orderPoint = $d * 7 + $ss;


        //persediaan harian
        $S = $s / 260;
        //POQ
        $poq = sqrt((2 * $D * $K) / ($h * (1 - $d / $S)));
        //N
        $N = $D / $poq;
        //cq
        $cq = ($D * $K) / $poq + (($h * $poq) / 2) * (1 - $d / $S);

        return view('pages.hasil.index', [
            'title' => 'Hasil',
            'Xbar' => $Xbar,
            'data' => $dataBahanBaku,
            'oi' => $proses->oi,
            'lt' => $proses->lt,
            'stok' => $proses->stok,
            'D' => $total_X,
            'total_xbarMin' => array_sum($xMin),
            'total_powXbarMin' => $total_powXbarMin,
            's' => $s,

            'tahun' => $tahun,
            'h' => $h,
            'penyimpanan_perbulan' => $total_penyimpanan_perbulan,
            'K' => $total_pemesanan,
            'countData' => $countData,
            'sigma_d' => $sigma_d,
            'dOiLt' => $dOiLt,
            'zSigma' => $zSigma,
            'foi' => $foi,
            'c' => $c,
            'Dp' => $Dp,
            'sqrtQOptimal' => $sqrtQOptimal,
            'qOptimal_1' => $qOptimal_1,
            'qOptimal' => $qOptimal,
            'ss' => $ss,
            'd' => $d,
            'orderPoint' => $orderPoint,
            'S'=>$S,
            'poq' => $poq,
            'N' => $N,
            'cq' => $cq,
        ]);
    }

    public function input()
    {
        $dataTahun = BahanBaku::distinct('tahun')->pluck('tahun')->toArray();

        return view('pages.hasil.input', [
            'title' => 'Hasil',
            'dataTahun' => $dataTahun,
            'data' => Proses::all(),
        ]);
    }

    public function store(Request $request)
    {
        Proses::create([
            'oi' => $request->oi,
            'lt' => $request->lt,
            'stok' => $request->stok,
            'tahun' => $request->tahun,
        ]);

        return redirect()->back()->with(['success' => 'Data Bahan Baku Telah Ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $pembelian = $request->pembelian;
        $pemakaian = $request->pemakaian;
        $sisa = $pembelian - $pemakaian;

        $data = BahanBaku::find($id);

        $data->update([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'pembelian' => $pembelian,
            'pemakaian' => $pemakaian,
            'sisa' => $sisa
        ]);

        return redirect()->back()->with(['update' => 'Data Bahan Baku Telah Berhasil Diupdate']);
    }

    public function destroy($id)
    {
        $pupuk = BahanBaku::find($id);
        $pupuk->delete();
        return back()->with(['delete' => 'Data Bahan Baku Telah Berhasil Hapus']);
    }
}
