<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App \ {
    Sample,
    JenisPengujian,
    Pelanggan,
    Pertanyaan,
    Jawaban,
    Feedback,
    Saran
};
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SampleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function statusPengajuan()
    {
        $user = Auth::user();
        // $samples = Sample::where('user_id', $user->id)->latest()->paginate(5);
        $samples = Sample::where('user_id', $user->id)->latest()->get();

        foreach ($samples as $sample) {
            $samples->find($sample->id)->setAttribute('stat', $this->check($sample));
        }

        return view(
            'users/status',
            [
                // 'samples_other' => $samples_other,
                'samples' => $samples,
                'user' => $user,
            ]
        );
    }
    public function show($id)
    {
        $sample = Sample::find($id);
        $sample->setAttribute('stat', $this->check($sample));
        return view('users/detail_sample', ['sample' => $sample]);
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
    public function add()
    {
        $user = Auth::user();
        $jenis = JenisPengujian::get();
        return view('users/tambah_sample', [
            'user' => $user,
            'jenis' => $jenis,
        ]);
    }
    public function save(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'jumlah_contoh' => ['required'],
            'status_contoh' => ['required', 'min:6']
        ]);

        if (!isset($user->pelanggan)) {
            Pelanggan::create([
                'user_id' => $user->id,
                'telepon' => $request->telepon,
            ]);
        }

        Sample::create([
            'user_id' =>  $user->id,
            'jenis_pengujian_id' => $request->jenis,
            'jumlah_contoh' => $request->jumlah_contoh,
            'status_contoh' => $request->status_contoh,
        ]);
        return redirect('/status');
    }
    public function kirimContoh($id)
    {
        $sample = Sample::find($id);
        return view('users.kirim_contoh', ['sample' => $sample]);
    }
    public function updatePengiriman($id, Request $request)
    {
        $this->validate($request, [
            'tanggal_pengiriman' => ['required', 'date'],
            'desa' => ['required'],
            'kec' => ['required'],
            'kab' => ['required'],
        ]);
        $lokasi = $request->desa . '|' . $request->kec . '|' . $request->kab;
        Sample::find($id)->update([
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'lokasi' => $lokasi
        ]);

        return redirect()->route('show_sample', $id);
    }
    public function deleteSample(Sample $sample)
    {
        $sample->delete();

        return redirect()->route('status');
    }
    public function editSample(Sample $sample)
    {
        $jenis = JenisPengujian::all();
        return view('users/edit_sample', [
            'sample' => $sample,
            'jenis' => $jenis
        ]);
    }
    public function updateSample(Request $request)
    {
        $this->validate($request, [
            'telepon' => 'required',
            'jenis' => 'required',
            'jumlah_contoh' => ['required'],
            'status_contoh' => 'required'

        ]);
        if ($request->status_contoh == 'datang') {
            $tgl = NULL;
        } elseif (isset($request->tgl_kirim)) {
            $tgl = $request->tgl_kirim;
        } else {
            $tgl = NULL;
        }
        Sample::find($request->id)->update([
            'jenis_pengujian_id' => $request->jenis,
            'jumlah_contoh' => $request->jumlah_contoh,
            'status_contoh' => $request->status_contoh,
            'tanggal_pengiriman' => $tgl,
        ]);

        return redirect()->route('show_sample', ['id' => $request->id]);
    }
    public function feedback($id)
    {
        $sample = Sample::find($id);
        $pertanyaan = Pertanyaan::get();
        $jawaban = Jawaban::get();

        return view('users.feedback', [
            'sample' => $sample,
            'pertanyaan' => $pertanyaan,
            'jawaban' => $jawaban
        ]);
    }
    public function saveFeedback($id, Request $request)
    {
        $request->validate([
            'jawab1' => 'required',
            'jawab2' => 'required',
            'jawab3' => 'required',
            'jawab4' => 'required',
            'jawab5' => 'required',
            'jawab6' => 'required',
            'jawab7' => 'required',
            'jawab8' => 'required',
        ]);
        $data = [
            [
                'sample_id' => $id,
                'pertanyaan_id' => 1,
                'jawaban_id' => $request->jawab1,
                'keterangan' => $request->keterangan1
            ],
            [
                'sample_id' => $id,
                'pertanyaan_id' => 2,
                'jawaban_id' => $request->jawab2,
                'keterangan' => $request->keterangan2
            ],
            [
                'sample_id' => $id,
                'pertanyaan_id' => 3,
                'jawaban_id' => $request->jawab3,
                'keterangan' => $request->keterangan3
            ],
            [
                'sample_id' => $id,
                'pertanyaan_id' => 4,
                'jawaban_id' => $request->jawab4,
                'keterangan' => $request->keterangan4
            ],
            [
                'sample_id' => $id,
                'pertanyaan_id' => 5,
                'jawaban_id' => $request->jawab5,
                'keterangan' => $request->keterangan5
            ],
            [
                'sample_id' => $id,
                'pertanyaan_id' => 6,
                'jawaban_id' => $request->jawab6,
                'keterangan' => $request->keterangan6
            ],
            [
                'sample_id' => $id,
                'pertanyaan_id' => 7,
                'jawaban_id' => $request->jawab7,
                'keterangan' => $request->keterangan7
            ],
            [
                'sample_id' => $id,
                'pertanyaan_id' => 8,
                'jawaban_id' => $request->jawab8,
                'keterangan' => $request->keterangan8
            ]

        ];

        $sample = Sample::find($id)->feedback()->createMany($data);

        if (isset($request->saran)) {
            Saran::create([
                'sample_id' => $id,
                'saran' => $request->saran
            ]);
        }
        return redirect()->route('status');
    }

    public function uploadBukti($id, Request $request)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:jpg,png,jpeg|max:1024'
        ]);

        $sample = Sample::find($id);
        $time = Carbon::now()->timestamp;
        $bukti = $request->file('bukti');

        $buktiUrl = $bukti->storeAs("images/pembayaran", "bukti_{$id}_{$time}.{$bukti->extension()}");

        $sample->biaya->update([
            'bukti' => $buktiUrl
        ]);

        return back();
    }
}
