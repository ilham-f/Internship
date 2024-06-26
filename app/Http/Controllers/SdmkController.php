<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Seksi;
use App\Models\Permohonan;
use App\Exports\UsersExport;
use App\Mail\MahasiswaEmail;
use Illuminate\Http\Request;
use App\Models\KebutuhanMagang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SdmkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Grafik Kebutuhan
        $kebutuhanLabels = array();
        $kebutuhans = KebutuhanMagang::groupBy('kebutuhan')
                        ->selectRaw('kebutuhan')
                        ->get();
        foreach ($kebutuhans as $kebutuhan) {
            $kebutuhanLabels[] = $kebutuhan->kebutuhan;
        }
        // dd($kebutuhanLabels);
        $kebutuhanData = array();
        $jumlahKebutuhan = KebutuhanMagang::groupBy('kebutuhan')
                        ->selectRaw('kebutuhan, count(seksi_id) as jumlahSeksi')
                        ->get();
        // dd($jumlahKebutuhan);
        foreach ($jumlahKebutuhan as $kebutuhan) {
            $kebutuhanData[] = $kebutuhan->jumlahSeksi;
        }

        // Grafik Jurusan
        $jurusanLabels = array();
        $jurusans = KebutuhanMagang::groupBy('kualifikasi')
                    ->selectRaw('kualifikasi')
                    ->get();
        foreach ($jurusans as $jurusan) {
            $jurusanLabels[] = $jurusan->kualifikasi;
        }
        // dd($jurusanLabels);
        $jurusanData = array();
        $jumlahKualifikasis = KebutuhanMagang::groupBy('kualifikasi')
            ->selectRaw('kualifikasi, count(kualifikasi) as jumlahKualifikasi')
            ->get();
        foreach ($jumlahKualifikasis as $jumlahKualifikasi) {
            $jurusanData[] = $jumlahKualifikasi->jumlahKualifikasi;
        }
        // dd($jurusanData);

        // Grafik kuota
        $kuotaLabels = array();
        $kuotas = KebutuhanMagang::groupBy('kebutuhan')
                    ->selectRaw('kebutuhan')
                    ->get();
        foreach ($kuotas as $kuota) {
            $kuotaLabels[] = $kuota->kebutuhan;
        }
        // dd($kuotaLabels);
        $kuotaData = array();
        $jumlahKuotas = KebutuhanMagang::groupBy('kebutuhan')
            ->selectRaw('sum(kuota) as jumlahKuota')
            ->get();
        foreach ($jumlahKuotas as $jumlahKuota) {
            $kuotaData[] = $jumlahKuota->jumlahKuota;
        }
        // dd($kuotaData);

        // Grafik Seksi
        $seksiLabels = array();
        $seksis = Seksi::all();
        foreach ($seksis as $seksi) {
            $seksiLabels[] = $seksi->nama_seksi;
        }

        $jumlah = array();
        $seksisWithMahasiswaCount = Seksi::withCount(['user' => function ($query) {
                                        $query->where('role', 'mahasiswa')->where('tgl_selesai','>=',Carbon::now());
                                    }])->get();
        // dd($seksisWithMahasiswaCount);
        foreach ($seksisWithMahasiswaCount as $seksi) {
            $jumlah[] = $seksi->user_count;
        }

        $sisaKuota = array();
        $seksisWithKuota = KebutuhanMagang::with('seksi')
            ->groupBy('seksi_id')
            ->selectRaw('seksi_id, sum(kuota) as sisa_kuota')
            ->get();

        // dd($seksisWithKuota);
        foreach ($seksisWithKuota as $seksi) {
            $sisaKuota[] = $seksi->sisa_kuota;
        }
        // dd($sisaKuota);

        $permohonanbaru = Permohonan::where('status','0')->get();

        return view('sdmk.sdmk', compact('permohonanbaru','kebutuhanLabels','kebutuhanData','jurusanLabels','jurusanData','kuotaLabels','kuotaData','seksiLabels', 'jumlah', 'sisaKuota'));
    }

    public function hasilevaluasi()
    {
        // Grafik pengetahuan
        $pengetahuan = array();
        $pengetahuan1 = User::selectRaw('count( pengetahuan) as pengetahuan1')->where('pengetahuan','1')->first();
        $pengetahuan2 = User::selectRaw('count(pengetahuan) as pengetahuan2')->where('pengetahuan','2')->first();
        $pengetahuan3 = User::selectRaw('count(pengetahuan) as pengetahuan3')->where('pengetahuan','3')->first();
        $pengetahuan4 = User::selectRaw('count(pengetahuan) as pengetahuan4')->where('pengetahuan','4')->first();
        $pengetahuan[0] = $pengetahuan1->pengetahuan1;
        $pengetahuan[1] = $pengetahuan2->pengetahuan2;
        $pengetahuan[2] = $pengetahuan3->pengetahuan3;
        $pengetahuan[3] = $pengetahuan4->pengetahuan4;

        // Grafik keterampilan
        $keterampilan = array();
        $keterampilan1 = User::selectRaw('count(keterampilan) as keterampilan1')->where('keterampilan','1')->first();
        $keterampilan2 = User::selectRaw('count(keterampilan) as keterampilan2')->where('keterampilan','2')->first();
        $keterampilan3 = User::selectRaw('count(keterampilan) as keterampilan3')->where('keterampilan','3')->first();
        $keterampilan4 = User::selectRaw('count(keterampilan) as keterampilan4')->where('keterampilan','4')->first();
        $keterampilan[0] = $keterampilan1->keterampilan1;
        $keterampilan[1] = $keterampilan2->keterampilan2;
        $keterampilan[2] = $keterampilan3->keterampilan3;
        $keterampilan[3] = $keterampilan4->keterampilan4;

        // Grafik komunikasi
        $komunikasi = array();
        $komunikasi1 = User::selectRaw('count(komunikasi) as komunikasi1')->where('komunikasi','1')->first();
        $komunikasi2 = User::selectRaw('count(komunikasi) as komunikasi2')->where('komunikasi','2')->first();
        $komunikasi3 = User::selectRaw('count(komunikasi) as komunikasi3')->where('komunikasi','3')->first();
        $komunikasi4 = User::selectRaw('count(komunikasi) as komunikasi4')->where('komunikasi','4')->first();
        $komunikasi[0] = $komunikasi1->komunikasi1;
        $komunikasi[1] = $komunikasi2->komunikasi2;
        $komunikasi[2] = $komunikasi3->komunikasi3;
        $komunikasi[3] = $komunikasi4->komunikasi4;

        // Grafik problem_solve
        $problem_solve = array();
        $problem_solve1 = User::selectRaw('count(problem_solve) as problem_solve1')->where('problem_solve','1')->first();
        $problem_solve2 = User::selectRaw('count(problem_solve) as problem_solve2')->where('problem_solve','2')->first();
        $problem_solve3 = User::selectRaw('count(problem_solve) as problem_solve3')->where('problem_solve','3')->first();
        $problem_solve4 = User::selectRaw('count(problem_solve) as problem_solve4')->where('problem_solve','4')->first();
        $problem_solve[0] = $problem_solve1->problem_solve1;
        $problem_solve[1] = $problem_solve2->problem_solve2;
        $problem_solve[2] = $problem_solve3->problem_solve3;
        $problem_solve[3] = $problem_solve4->problem_solve4;

        // Grafik bimbingan
        $bimbingan = array();
        $bimbingan1 = User::selectRaw('count(bimbingan) as bimbingan1')->where('bimbingan','1')->first();
        $bimbingan2 = User::selectRaw('count(bimbingan) as bimbingan2')->where('bimbingan','2')->first();
        $bimbingan3 = User::selectRaw('count(bimbingan) as bimbingan3')->where('bimbingan','3')->first();
        $bimbingan4 = User::selectRaw('count(bimbingan) as bimbingan4')->where('bimbingan','4')->first();
        $bimbingan[0] = $bimbingan1->bimbingan1;
        $bimbingan[1] = $bimbingan2->bimbingan2;
        $bimbingan[2] = $bimbingan3->bimbingan3;
        $bimbingan[3] = $bimbingan4->bimbingan4;

        // Grafik gambaran_kerja
        $gambaran_kerja = array();
        $gambaran_kerja1 = User::selectRaw('count(gambaran_kerja) as gambaran_kerja1')->where('gambaran_kerja','1')->first();
        $gambaran_kerja2 = User::selectRaw('count(gambaran_kerja) as gambaran_kerja2')->where('gambaran_kerja','2')->first();
        $gambaran_kerja3 = User::selectRaw('count(gambaran_kerja) as gambaran_kerja3')->where('gambaran_kerja','3')->first();
        $gambaran_kerja4 = User::selectRaw('count(gambaran_kerja) as gambaran_kerja4')->where('gambaran_kerja','4')->first();
        $gambaran_kerja[0] = $gambaran_kerja1->gambaran_kerja1;
        $gambaran_kerja[1] = $gambaran_kerja2->gambaran_kerja2;
        $gambaran_kerja[2] = $gambaran_kerja3->gambaran_kerja3;
        $gambaran_kerja[3] = $gambaran_kerja4->gambaran_kerja4;

        // Grafik waktu_diskusi
        $waktu_diskusi = array();
        $waktu_diskusi1 = User::selectRaw('count(waktu_diskusi) as waktu_diskusi1')->where('waktu_diskusi','1')->first();
        $waktu_diskusi2 = User::selectRaw('count(waktu_diskusi) as waktu_diskusi2')->where('waktu_diskusi','2')->first();
        $waktu_diskusi3 = User::selectRaw('count(waktu_diskusi) as waktu_diskusi3')->where('waktu_diskusi','3')->first();
        $waktu_diskusi4 = User::selectRaw('count(waktu_diskusi) as waktu_diskusi4')->where('waktu_diskusi','4')->first();
        $waktu_diskusi[0] = $waktu_diskusi1->waktu_diskusi1;
        $waktu_diskusi[1] = $waktu_diskusi2->waktu_diskusi2;
        $waktu_diskusi[2] = $waktu_diskusi3->waktu_diskusi3;
        $waktu_diskusi[3] = $waktu_diskusi4->waktu_diskusi4;

        // Grafik pengarahan
        $pengarahan = array();
        $pengarahan1 = User::selectRaw('count(pengarahan) as pengarahan1')->where('pengarahan','1')->first();
        $pengarahan2 = User::selectRaw('count(pengarahan) as pengarahan2')->where('pengarahan','2')->first();
        $pengarahan3 = User::selectRaw('count(pengarahan) as pengarahan3')->where('pengarahan','3')->first();
        $pengarahan4 = User::selectRaw('count(pengarahan) as pengarahan4')->where('pengarahan','4')->first();
        $pengarahan[0] = $pengarahan1->pengarahan1;
        $pengarahan[1] = $pengarahan2->pengarahan2;
        $pengarahan[2] = $pengarahan3->pengarahan3;
        $pengarahan[3] = $pengarahan4->pengarahan4;

        // Grafik wifi
        $wifi = array();
        $wifi1 = User::selectRaw('count(wifi) as wifi1')->where('wifi','1')->first();
        $wifi2 = User::selectRaw('count(wifi) as wifi2')->where('wifi','2')->first();
        $wifi3 = User::selectRaw('count(wifi) as wifi3')->where('wifi','3')->first();
        $wifi4 = User::selectRaw('count(wifi) as wifi4')->where('wifi','4')->first();
        $wifi[0] = $wifi1->wifi1;
        $wifi[1] = $wifi2->wifi2;
        $wifi[2] = $wifi3->wifi3;
        $wifi[3] = $wifi4->wifi4;

        // Grafik ruangan
        $ruangan = array();
        $ruangan1 = User::selectRaw('count(ruangan) as ruangan1')->where('ruangan','1')->first();
        $ruangan2 = User::selectRaw('count(ruangan) as ruangan2')->where('ruangan','2')->first();
        $ruangan3 = User::selectRaw('count(ruangan) as ruangan3')->where('ruangan','3')->first();
        $ruangan4 = User::selectRaw('count(ruangan) as ruangan4')->where('ruangan','4')->first();
        $ruangan[0] = $ruangan1->ruangan1;
        $ruangan[1] = $ruangan2->ruangan2;
        $ruangan[2] = $ruangan3->ruangan3;
        $ruangan[3] = $ruangan4->ruangan4;

        $permohonanbaru = Permohonan::where('status','0')->get();

        $sarans = User::where('saran_pelaksanaan','!=',null)->where('saran_pembimbing','!=',null)->get();
        // dd($sarans);

        return view('sdmk.hasilevaluasi', compact('sarans','permohonanbaru','pengetahuan','keterampilan','komunikasi','problem_solve','bimbingan','gambaran_kerja','waktu_diskusi','pengarahan','wifi','ruangan'));
    }

    public function kebutuhan()
    {
        $permohonanbaru = Permohonan::where('status','0')->get();
        $kebutuhans = KebutuhanMagang::all();
        return view('sdmk.kebutuhan', compact('kebutuhans','permohonanbaru'));
    }

    public function kebutuhanku()
    {
        $permohonanbaru = Permohonan::where('status','0')->get();
        $kebutuhans = KebutuhanMagang::where('seksi_id','14')->get();
        return view('sdmk.kebutuhanku', compact('kebutuhans','permohonanbaru'));
    }

    public function mahasiswa()
    {
        $permohonanbaru = Permohonan::where('status','0')->get();
        $tgl_sekarang = Carbon::now();
        $mahasiswas = User::where('role','mahasiswa')
                            ->where('status','1')
                            ->where('tgl_selesai','>=',$tgl_sekarang)->get();
        // dd($mahasiswas);
        return view('sdmk.mahasiswa', compact('mahasiswas','permohonanbaru'));
    }

    public function mahasiswaku()
    {
        $permohonanbaru = Permohonan::where('status','0')->get();
        $tgl_sekarang = Carbon::now();
        $mahasiswakus = User::where('role','mahasiswa')
                            ->where('status','1')
                            ->where('seksi_id',14)
                            ->where('tgl_selesai','>=',$tgl_sekarang)->get();
        // dd($mahasiswas);
        return view('sdmk.mahasiswaku', compact('mahasiswakus','permohonanbaru'));
    }

    public function detailmahasiswa(Request $request)
    {
        Carbon::setLocale('id');
        $mahasiswa = User::find($request->id);
        $html = '
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">NIM</th>
                                <td width="60%">
                                    ' . $mahasiswa->nim . '
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Nama</th>
                                <td width="60%">
                                    ' . $mahasiswa->nama . '
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Jenis Kelamin</th>
                                <td width="60%">
                                    ' . (($mahasiswa->jenis_kelamin == 1) ? 'Laki-laki' : 'Perempuan') . '
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Perguruan Tinggi</th>
                                <td width="60%">
                                    ' . $mahasiswa->perguruan_tinggi . '
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Program Studi</th>
                                <td width="60%">
                                    ' . $mahasiswa->jurusan . '
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Semester</th>
                                <td width="60%">
                                    ' . $mahasiswa->semester . '
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Penempatan</th>
                                <td width="60%">
                                    ' . $mahasiswa->seksi->nama_seksi . '
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Mulai Magang</th>
                                <td width="60%">
                                    ' . Carbon::parse($mahasiswa->tgl_mulai)->translatedFormat('l, j F Y') . '
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Selesai Magang</th>
                                <td width="60%">
                                    ' . Carbon::parse($mahasiswa->tgl_selesai)->translatedFormat('l, j F Y') . '
                                </td>
                            </tr>
                        </table>
                    </div>
                ';
        return $html;
    }

    public function ubahmahasiswa(Request $request)
    {
        Carbon::setLocale('id');
        $seksis = Seksi::all();
        $mahasiswa = User::find($request->id);
        $html = '
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <input type="hidden" name="id" value="'. $mahasiswa->id .'">
                            <tr>
                                <th width="40%">Penempatan</th>
                                <td width="60%">
                                    <select name="seksi_id" class="form-select">
                ';
                                        foreach ($seksis as $seksi) {
                                            $html .= '
                                                '.(($mahasiswa->seksi->id == $seksi->id) ?
                                                    '<option value="'.$seksi->id.'" selected>'.$seksi->nama_seksi.'</option>' :
                                                    '<option value="'.$seksi->id.'">'.$seksi->nama_seksi.'</option>'
                                                ).'
                                            ';
                                        }

                            $html .= '</select>
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">
                                    Mulai Magang
                                    <br>
                                    ' . Carbon::parse($mahasiswa->tgl_mulai)->translatedFormat('l, j F Y') . '
                                </th>
                                <td width="60%">
                                    <input class="form-control" type="date" name="tgl_mulai" value="'. Carbon::parse($mahasiswa->tgl_mulai) .'">
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">
                                    Selesai Magang
                                    <br>
                                    ' . Carbon::parse($mahasiswa->tgl_selesai)->translatedFormat('l, j F Y') . '
                                </th>
                                <td width="60%">
                                    <input class="form-control" type="date" name="tgl_selesai" value="'. Carbon::parse($mahasiswa->tgl_selesai) .'">
                                </td>
                            </tr>
                        </table>
                    </div>
                ';
        return $html;
    }

    public function hapusmahasiswa(Request $request)
    {
        $mahasiswa = User::find($request->id);
        $html = '
                    <input type="hidden" name="id" value="'. $mahasiswa->id .'">
                    <h5 class="">Apakah anda yakin untuk menonaktifkan mahasiswa dengan nama "<strong>'. $mahasiswa->nama .'</strong>"?</h5>
                ';
        return $html;
    }

    /**
     * Fungsi update data mahasiswa
     */
    public function editmahasiswa(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'seksi_id' => 'required',
        ]);

        if ($request->tgl_mulai != null) {
            $data['tgl_mulai'] = $request->tgl_mulai;
        }
        if ($request->tgl_selesai != null) {
            $data['tgl_selesai'] = $request->tgl_selesai;
        }

        $user = User::find($request->id);
        $updated = $user->update($data);

        if ($updated) {
            return back()->with('ubah', 'Data mahasiswa berhasil diubah');
        }

        return back()->with('gagalubah', 'Data mahasiswa gagal diubah');
    }

    /**
     * Fungsi soft-delete mahasiswa
     */
    public function deletemahasiswa(Request $request)
    {
        $data = $request->validate([
            'status' => 'required',
        ]);

        $user = User::find($request->id);
        $deleted = $user->update($data);

        if ($deleted) {
            return back()->with('hapus', 'Mahasiswa berhasil dinonaktifkan');
        }

        return back()->with('gagalhapus', 'Mahasiswa gagal dinonaktifkan');
    }

    /**
     * Fungsi export tabel mahasiswa ke excel.
     */
    public function exportmahasiswa()
    {
        $tgl_sekarang = Carbon::now();
        $users = User::where('role','mahasiswa')
                        ->where('status','1')
                        ->where('tgl_selesai','>=',$tgl_sekarang)->get(); // Retrieve data from API
        return Excel::download(new UsersExport($users), 'mahasiswa.xlsx');
    }

    /**
     * Fungsi export kebutuhan ke excel.
     */
    public function exportkebutuhan()
    {
        $kebutuhans = KebutuhanMagang::all(); // Retrieve data from API

        return Excel::download(new KebutuhanMagangExport($kebutuhans), 'kebutuhan.xlsx');
    }

    /**
     * Permohonan Page
     */
    public function permohonan()
    {
        $permohonanbaru = Permohonan::where('status','0')->get();
        return view('sdmk.permohonan', compact('permohonanbaru'));
    }

    /**
     * Fungsi update data permohonan
     */
    public function editpermohonan(Request $request)
    {
        // dd($request);
        $dataUser = $request->validate([
            'seksi_id' => 'required',
            'kebutuhan_magang_id' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'status' => 'required',
            'pembimbing' => 'required',
        ]);

        $dataPermohonan = $request->validate([
            'seksi_id' => 'required',
            'kebutuhan_magang_id' => 'required',
            'status' => 'required',
            'surat_magang' => 'mimes:pdf|max:1024',
        ]);

        if ($request->file('surat_magang')) {
            $dataPermohonan['surat_magang'] = $request->file('surat_magang')->store('surat_magangs');
        }

        $user = User::find($request->user_id);
        $user->update($dataUser);

        if ($request->status == 1) {
            $kebutuhan = KebutuhanMagang::find($request->kebutuhan_magang_id);
            $kebutuhan->update([
                'kuota' => $kebutuhan->kuota - 1
            ]);
        }

        $permohonan = Permohonan::find($request->id);
        $updated = $permohonan->update($dataPermohonan);

        if ($updated) {
            if ($user->status != '0') {
                $lowongan = KebutuhanMagang::find($request->kebutuhan_magang_id);
                $seksi = Seksi::find($request->seksi_id);
                if ($user->status == 1) {
                    $status = 'DITERIMA';
                }
                else if ($user->status == 2) {
                    $status = 'DITOLAK';
                }

                $email = [
                    'nama' => $user->nama,
                    'status' => $status,
                    'lowongan' => $lowongan->kebutuhan,
                    'seksi' => $seksi->nama_seksi,
                    'tgl_mulai' => $user->tgl_mulai,
                    'tgl_selesai' => $user->tgl_selesai,
                ];

                Mail::to($user->email)->send(new MahasiswaEmail($email));
            }

            return back()->with('ubah', 'Status permohonan berhasil diubah');
        }

        return back()->with('gagalubah', 'Status permohonan gagal diubah');
    }

    public function ubahpermohonan(Request $request)
    {
        $permohonan = Permohonan::find($request->id);
        $html = '
                    <div class="">
                        <input type="hidden" name="user_id" value="'. $permohonan->user_id .'">
                        <input type="hidden" name="seksi_id" value="'. $permohonan->seksi_id .'">
                        <input type="hidden" name="kebutuhan_magang_id" value="'. $permohonan->kebutuhan_magang_id .'">
                        <input type="hidden" name="id" value="'. $permohonan->id .'">
                        <label class="mb-1" for="">Tanggal Mulai</label>
                        <input class="form-control" type="date" name="tgl_mulai">
                        <br>
                        <label class="mb-1" for="">Tanggal Selesai</label>
                        <input class="form-control" type="date" name="tgl_selesai">
                        <br>
                        <label class="mb-1" for="">Status</label>
                        <select name="status" class="form-select">
                                <option value="0" selected>Diproses</option>
                                <option value="1">Diterima</option>
                                <option value="2">Ditolak</option>
                        </select>
                        <br>
                        <label class="mb-1" for="">Nama Pembimbing (jika diterima)</label>
                        <input class="form-control" type="text" name="pembimbing">
                        <br>
                        <label class="mb-1" for="">Surat Penerimaan (jika diterima)</label>
                        <small style="font-size: 11px" class="text-danger">(PDF Max 1MB)</small>
                        <input class="form-control" type="file" name="surat_magang">
                    </div>
                ';
        return $html;
    }

    /**
     * Fungsi update data kebutuhan
     */
    public function addkebutuhanku(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'seksi_id' => 'required',
            'kebutuhan' => 'required',
            'detail' => 'required',
            'kualifikasi' => 'required',
            'kuota' => 'required',
        ]);

        $created = KebutuhanMagang::create($data);

        if ($created) {
            return back()->with('buat', 'Data kebutuhan berhasil dibuat');
        }

        return back()->with('gagalbuat', 'Data kebutuhan gagal dibuat');
    }

    /**
     * Fungsi update data kebutuhan
     */
    public function editkebutuhanku(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'kebutuhan' => 'required',
            'detail' => 'required',
            'kualifikasi' => 'required',
            'kuota' => 'required',
        ]);

        $kebutuhan = KebutuhanMagang::find($request->id);
        $updated = $kebutuhan->update($data);

        if ($updated) {
            return back()->with('ubah', 'Data kebutuhan berhasil diubah');
        }

        return back()->with('gagalubah', 'Data kebutuhan gagal diubah');
    }

    /**
     * Fungsi delete kebutuhan
     */
    public function deletekebutuhanku(Request $request)
    {
        $kebutuhan = KebutuhanMagang::find($request->id);
        $deleted = $kebutuhan->delete();

        if ($deleted) {
            return back()->with('hapus', 'Data kebutuhan berhasil dihapus');
        }

        return back()->with('gagalhapus', 'Data kebutuhan gagal dihapus');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
