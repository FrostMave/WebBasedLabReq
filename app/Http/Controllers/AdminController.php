<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App \ {
    Sample,
    Persetujuan,
    Biaya,
    Hasil,
    Penerimaan,
    Feedback,
    Pertanyaan,
    Saran
};
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $samples = Sample::get();
        $data = array(
            'ditolak' => 0,
            'pembayaran' => 0,
            'pengujian' => 0,
            'laporan' => 0,
            'selesai' => 0,
            'persetujuan' => 0,
        );
        foreach ($samples as $s) {
            $cek = $this->check($s);
            if ($cek == 'Ditolak') {
                $data['ditolak'] += 1;
            } elseif ($cek == 'Pembayaran') {
                $data['pembayaran'] += 1;
            } elseif ($cek == 'Pengujian') {
                $data['pengujian'] += 1;
            } elseif ($cek == 'Pembuatan Laporan') {
                $data['laporan'] += 1;
            } elseif ($cek == 'Selesai') {
                $data['selesai'] += 1;
            } elseif ($cek == 'Persetujuan') {
                $data['persetujuan'] += 1;
            }
        }

        return view('dashboard', [
            'samples' => $samples,
            'data' => $data
        ]);
    }
    public function persetujuan()
    {
        $samples = Sample::get();
        $samples = $samples->keyBy('id');

        foreach ($samples as $sample) {
            if ($this->check($sample) != 'Persetujuan') {
                $samples->pull($sample->id);
            }
        }

        return view('admin.status.persetujuan', [
            'samples' => $samples,
        ]);
    }
    public function pembayaran()
    {
        $samples = Sample::get();
        $samples = $samples->keyBy('id');

        foreach ($samples as $sample) {
            if ($this->check($sample) != 'Pembayaran') {
                $samples->pull($sample->id);
            }
        }

        return view('admin.status.pembayaran', [
            'samples' => $samples,
        ]);
    }
    public function pengujian()
    {
        $samples = Sample::get();
        $samples = $samples->keyBy('id');

        foreach ($samples as $sample) {
            if ($this->check($sample) != 'Pengujian') {
                $samples->pull($sample->id);
            }
        }

        return view('admin.status.pengujian', [
            'samples' => $samples,
        ]);
    }
    public function laporan()
    {
        $samples = Sample::get();
        $samples = $samples->keyBy('id');

        foreach ($samples as $sample) {
            if ($this->check($sample) != 'Pembuatan Laporan') {
                $samples->pull($sample->id);
            }
        }

        return view('admin.status.laporan', [
            'samples' => $samples,
        ]);
    }
    public function selesai()
    {

        $samples = Sample::latest()->get();
        $samples = $samples->keyBy('id');

        foreach ($samples as $sample) {
            if ($this->check($sample) != 'Selesai') {
                $samples->pull($sample->id);
            }
        }

        return view('admin.status.selesai', [
            'samples' => $samples,
        ]);
    }
    public function semua()
    {
        $samples = Sample::latest()->get();
        $samples = $samples->keyBy('id');

        foreach ($samples as $sample) {
            $samples->find($sample->id)->setAttribute('stat', $this->check($sample));
        }

        return view('admin.status.semua', [
            'samples' => $samples,
        ]);
    }

    public function showSample($id)
    {
        $sample = Sample::find($id);
        $tahap = $this->check($sample);
        return view('admin/detail_sample', [
            'sample' => $sample,
            'tahap' => $tahap
        ]);
    }
    public function check($sample)
    {
        $proses = '';
        if (isset($sample->persetujuan) && $sample->persetujuan->status_persetujuan == 'ditolak') {
            $proses = 'Ditolak';
        } elseif (isset($sample->persetujuan) && isset($sample->biaya) && $sample->biaya->status_pembayaran == 'belum dibayar') {
            $proses = 'Pembayaran';
        } elseif (isset($sample->biaya) && $sample->biaya->status_pembayaran == 'dibayar' && !isset($sample->hasil)) {
            $proses = 'Pengujian';
        } elseif (isset($sample->hasil)) {
            if (!isset($sample->hasil->laporan)) {
                $proses = 'Pembuatan Laporan';
            } else {
                $proses = 'Selesai';
            }
        } else {
            $proses = 'Persetujuan';
        }
        return $proses;
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'persetujuan' => ['required'],
        ]);
        if ($request->persetujuan == 'diterima') {
            $this->validate($request, [
                'biaya' => ['required'],
            ]);
            Persetujuan::create([
                'sample_id' => $request->sample_id,
                'status_persetujuan' => $request->persetujuan
            ]);
            Biaya::create([
                'sample_id' => $request->sample_id,
                'biaya' => $request->biaya,
                'status_pembayaran' => 'belum dibayar',
            ]);
        } elseif ($request->persetujuan == 'ditolak') {
            $this->validate($request, [
                'keterangan' => ['required'],
            ]);
            Persetujuan::create([
                'sample_id' => $request->sample_id,
                'status_persetujuan' => $request->persetujuan,
                'keterangan' => $request->keterangan
            ]);
        }
        return redirect()->back();
    }
    public function updatePembayaran(Request $request)
    {
        Biaya::find($request->id)->update([
            'status_pembayaran' => $request->status
        ]);
        return redirect()->back();
    }
    public function insertHasil(Request $request)
    {
        if ($request->laporan == 'belum') {
            Hasil::create([
                'sample_id' => $request->sample_id,
                'status_laporan' => $request->laporan,
            ]);
        } else {
            $this->validate($request, [
                'file_laporan' => 'required|mimes:pdf'
            ]);


            $time = Carbon::now()->timestamp;
            $laporan = $request->file('file_laporan');

            $laporanUrl = $laporan->storeAs("files/laporan", "laporan_{$request->sample_id}_{$time}.{$laporan->extension()}");
            Hasil::create([
                'sample_id' => $request->sample_id,
                'status_laporan' => $request->laporan,
                'laporan' => $laporanUrl
            ]);
        }
        return redirect()->back();
    }
    public function updateHasil(Request $request)
    {
        $this->validate($request, [
            'file_laporan' => 'required|mimes:pdf'
        ]);

        $time = Carbon::now()->timestamp;
        $laporan = $request->file('file_laporan');

        $laporanUrl = $laporan->storeAs("files/laporan", "laporan_{$request->id}_{$time}.{$laporan->extension()}");
        Sample::find($request->id)->hasil->update([
            'status_laporan' => 'dikirim',
            'laporan' => $laporanUrl
        ]);
        return redirect()->back();
    }
    public function showPenerimaan($id)
    {
        $sample = Sample::find($id);
        return view('admin.penerimaan', [
            'sample' => $sample,
        ]);
    }
    public function insertPenerimaan(Request $request)
    {
        $request->validate([
            'kab' => 'required',
            'kec' => 'required',
            'desa' => 'required',
            'tgl_terima' => 'required',
        ]);
        $sample = Sample::find($request->nomor);
        if (isset($sample->lokasi)) {
            $lokasi = $request->desa . '|' . $request->kec . '|' . $request->kab;
            $sample->update(['lokasi' => $lokasi]);
        }
        Penerimaan::create([
            'sample_id' => $request->nomor,
            'tanggal_terima' => $request->tgl_terima,
            'status_penerimaan_sample' => 'diterima'
        ]);
        return redirect()->route('show', ['id' => $request->nomor]);
    }
    public function feedbackStatistik()
    {
        $feedback = Feedback::get();
        $total = DB::table('feedback')->distinct('sample_id')->count();
        $tanya = Pertanyaan::all();

        return view('admin.feedback.feedback', [
            'feedback' => $feedback,
            'total' => $total,
            'tanya' => $tanya
        ]);
    }
    public function feedbackDetail($id)
    {
        $tanya = Pertanyaan::find($id);
        $feedback = Feedback::where('pertanyaan_id', $id)->get();

        return view('admin.feedback.keterangan', [
            'tanya' => $tanya,
            'feedback' => $feedback
        ]);
    }
    public function feedbackSaran()
    {
        $saran = Saran::latest()->get();

        return view('admin.feedback.saran', ['saran' => $saran]);
    }
    public function downloadLaporan($id)
    {
        $sample = Sample::find($id);
        $path = asset('storage/' . $sample->hasil->laporan);
        return Storage::download($path);
    }
}
