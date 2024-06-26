<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Seksi;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\KebutuhanMagang;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Grafik Kebutuhan
        $user = Auth::user();
        $kebutuhanLabels = array();
        $kebutuhans = KebutuhanMagang::where('seksi_id','=',$user->seksi_id)->get();
        foreach ($kebutuhans as $kebutuhan) {
            $kebutuhanLabels[] = $kebutuhan->kebutuhan;
        }
        // dd($kebutuhanLabels);

        $jumlah = array();
        // Fetch kebutuhan magang IDs for the current user's seksi
        $kebutuhanMagangIds = KebutuhanMagang::where('seksi_id', $user->seksi_id)->pluck('id');
        // Iterate through each kebutuhan magang ID
        foreach ($kebutuhanMagangIds as $kebutuhanMagangId) {
            // Count users with role 'mahasiswa' for the current kebutuhan magang ID
            $userCount = User::where('seksi_id', $user->seksi_id)
                            ->where('role', 'mahasiswa')
                            ->where('kebutuhan_magang_id', $kebutuhanMagangId)
                            ->count();

            // Store the count in the array with the kebutuhan magang ID as key
            $jumlah[] = $userCount;
        }
        // dd($jumlah);

        $sisaKuota = array();
        foreach ($kebutuhanMagangIds as $kebutuhanMagangId) {
            $kebutuhan = KebutuhanMagang::where('id', $kebutuhanMagangId)->first();
            $sisaKuota[] = $kebutuhan->kuota;
        }
        // dd($sisaKuota);

        return view('admin.admin', compact('kebutuhanLabels','jumlah','sisaKuota'));
    }

    public function kebutuhan()
    {
        $kebutuhans = KebutuhanMagang::where('seksi_id', Auth::user()->seksi_id)->get();

        return view('admin.kebutuhan', compact('kebutuhans'));
    }

    /**
     * Fungsi export kebutuhan ke excel.
     */
    public function exportkebutuhan()
    {
        $kebutuhans = KebutuhanMagang::where('seksi_id', Auth::user()->seksi_id)->get(); // Retrieve data from API

        return Excel::download(new KebutuhanMagangExport($kebutuhans), 'kebutuhan.xlsx');
    }

    public function mahasiswa()
    {
        $tgl_sekarang = Carbon::now();
        $mahasiswas = User::where('role','=','mahasiswa')
                            ->where('status','=','1')
                            ->where('seksi_id','=', Auth::user()->seksi_id)
                            ->where(function ($query) use ($tgl_sekarang) {
                                $query->orWhere('tgl_selesai','>=',$tgl_sekarang)
                                      ->orWhereNull('tgl_selesai');
                            })->get();
        // dd($mahasiswas);
        return view('admin.mahasiswa', compact('mahasiswas'));
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
                                <th width="40%">NIM</th>
                                <td width="60%">
                                    <input class="form-control" type="text" name="nim" value="' . $mahasiswa->nim . '">
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Nama</th>
                                <td width="60%">
                                    <input class="form-control" type="text" name="nama" value="' . $mahasiswa->nama . '">
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Jenis Kelamin</th>
                                <td width="60%">
                                    <select name="jenis_kelamin" class="form-select">
                                    ' . (($mahasiswa->jenis_kelamin == 1) ?
                                        '<option value="1" selected>Laki-laki</option>
                                         <option value="2">Perempuan</option>' :
                                        '<option value="1">Laki-laki</option>
                                         <option value="2" selected>Perempuan</option>')
                                    . '
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Perguruan Tinggi</th>
                                <td width="60%">
                                    <input class="form-control" type="text" name="perguruan_tinggi" value="' . $mahasiswa->perguruan_tinggi . '">
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Program Studi</th>
                                <td width="60%">
                                    <input class="form-control" type="text" name="jurusan" value="' . $mahasiswa->jurusan . '">
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Semester</th>
                                <td width="60%">
                                    <input class="form-control" type="text" name="semester" value="' . $mahasiswa->semester . '">
                                </td>
                            </tr>
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
                                    <input class="form-control" type="date" name="tgl_mulai" value="">
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">
                                    Selesai Magang
                                    <br>
                                    ' . Carbon::parse($mahasiswa->tgl_selesai)->translatedFormat('l, j F Y') . '
                                </th>
                                <td width="60%">
                                    <input class="form-control" type="date" name="tgl_selesai" value="">
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
            'nim' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'perguruan_tinggi' => 'required',
            'jurusan' => 'required',
            'semester' => 'required',
            'seksi_id' => 'required',
        ]);

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

    public function detailkebutuhan(Request $request)
    {
        $kebutuhan = KebutuhanMagang::find($request->id);
        $html = '
                    <div class="">
                        <label class="mb-1" for="">Seksi</label>
                        <input readonly class="form-control" type="text" name="kebutuhan" value="' . $kebutuhan->seksi->nama_seksi . '">

                        <label class="mb-1 mt-2" for="">Kebutuhan</label>
                        <input readonly class="form-control" type="text" name="kebutuhan" value="' . $kebutuhan->kebutuhan . '">

                        <label class="mt-2 mb-1" for="">Kualifikasi Pendidikan</label>
                        <input readonly class="form-control" type="text" name="kualifikasi" value="' . $kebutuhan->kualifikasi . '">

                        <label class="mt-2 mb-1" for="">Deskripsi</label>
                        <br>
                        <textarea readonly class="form-control" name="detail">' . $kebutuhan->detail . '</textarea>
                    </div>
                ';
        return $html;
    }

    public function ubahkebutuhan(Request $request)
    {
        $kebutuhan = KebutuhanMagang::find($request->id);
        $html = '
                    <div class="">
                        <input type="hidden" name="id" value="'. $kebutuhan->id .'">
                        <input type="hidden" name="seksi_id" value="'. Auth::user()->seksi_id .'">

                        <label class="mb-1" for="">Kebutuhan</label>
                        <input class="form-control" type="text" name="kebutuhan" value="' . $kebutuhan->kebutuhan . '">

                        <label class="mt-2 mb-1" for="">Kualifikasi Pendidikan</label>
                        <input class="form-control" type="text" name="kualifikasi" value="' . $kebutuhan->kualifikasi . '">

                        <label class="mt-2 mb-1" for="">Kuota</label>
                        <input class="form-control" type="number" name="kuota" value="' . $kebutuhan->kuota . '">

                        <label class="mt-2 mb-1" for="">Deskripsi</label>
                        <br>
                        <textarea class="form-control mb-3" id="detail" name="detail">' . $kebutuhan->detail . '</textarea>
                    </div>
                ';
        return $html;
    }

    public function hapuskebutuhan(Request $request)
    {
        $kebutuhan = KebutuhanMagang::find($request->id);
        $html = '
                    <input type="hidden" name="id" value="'. $kebutuhan->id .'">
                    <h5 class="">Apakah anda yakin untuk menghapus kebutuhan "<strong>'. $kebutuhan->kebutuhan .'</strong>"?</h5>
                ';
        return $html;
    }

    /**
     * Fungsi update data kebutuhan
     */
    public function addkebutuhan(Request $request)
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
    public function editkebutuhan(Request $request)
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
    public function deletekebutuhan(Request $request)
    {
        $kebutuhan = KebutuhanMagang::find($request->id);
        $deleted = $kebutuhan->delete();

        if ($deleted) {
            return back()->with('hapus', 'Data kebutuhan berhasil dihapus');
        }

        return back()->with('gagalhapus', 'Data kebutuhan gagal dihapus');
    }

    /**
     * Fungsi export ke excel.
     */
    public function exportmahasiswa()
    {
        $tgl_sekarang = Carbon::now();
        $users = User::where('role','=','mahasiswa')
                        ->where('status','=','1')
                        ->where(function ($query) use ($tgl_sekarang) {
                            $query->orWhere('tgl_selesai','>=',$tgl_sekarang)
                                ->orWhereNull('tgl_selesai');
                        })->get(); // Retrieve data from API
        return Excel::download(new UsersExport($users), 'mahasiswa.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
