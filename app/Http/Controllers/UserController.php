<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seksi;
use App\Mail\SdmkEmail;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use App\Models\KebutuhanMagang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function evaluasi(Request $request)
    {
        // dd($request);
        $user = Auth::user();

        $data = $request->validate([
            'pengetahuan' => 'required',
            'keterampilan' => 'required',
            'komunikasi' => 'required',
            'problem_solve' => 'required',
            'bimbingan' => 'required',
            'gambaran_kerja' => 'required',
            'waktu_diskusi' => 'required',
            'pengarahan' => 'required',
            'wifi' => 'required',
            'ruangan' => 'required',
            'saran_pembimbing' => 'required',
            'saran_pelaksanaan' => 'required'
        ]);

        $updated = $user->update($data);

        if ($updated) {
            return back()->with('eval','Terimakasih telah melakukan evaluasi, kami akan terus meningkatkan pelayanan yang ada');
        }
        return back()->with('eval','Terjadi error!, Silakan mengisi kembali form evaluasi!');
    }

    public function profil()
    {
        return view('user.profil');
    }


    /**
     * Update Profil
     */
    public function ubahProfil(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nim' => ['required'],
            'nama' => ['required'],
            'notelp' => ['required'],
            'jenis_kelamin' => ['required'],
            'perguruan_tinggi' => ['required'],
            'fakultas' => ['required'],
            'jurusan' => ['required'],
            'semester' => ['required'],
        ]);

        $updated = $user->update($data);

        if ($updated) {
            return back()->with('success', 'Data profil berhasil disimpan');
        }

        return back()->with('error', 'Data profil gagal disimpan');
    }

    public function kegiatanku()
    {
        $permohonans = Permohonan::where('user_id', Auth::user()->id)->get();
        $user = Auth::user();
        // dd($permohonan);
        return view('user.kegiatanku', compact('permohonans', 'user'));
    }

    /**
     * Display the specified resource.
     */
    public function pendaftaran(Request $request)
    {
        // Validate the uploaded file
        // dd($request);
        $data = $request->validate([
            'kebutuhan_magang_id' => 'required',
            'seksi_id' => 'required',
            'user_id' => 'required',
            'proposal' => 'required|mimes:pdf|max:2048', // Adjust maximum file size as needed
            'surat_pengantar' => 'required|mimes:pdf|max:2048', // Adjust maximum file size as needed
        ]);

        if ($request->file('proposal')) {
            $data['proposal'] = $request->file('proposal')->store('proposals');
        }
        if ($request->file('surat_pengantar')) {
            $data['surat_pengantar'] = $request->file('surat_pengantar')->store('surat_pengantars');
        }

        $created = Permohonan::create($data);
        // dd($created);
        if ($created) {
            $user = User::find($created->user_id);
            $lowongan = KebutuhanMagang::find($created->kebutuhan_magang_id);
            $seksi = Seksi::find($created->seksi_id);
            $email = [
                'nama' => $user->nama,
                'email' => $user->email,
                'notelp' => $user->notelp,
                'tgl_permohonan' => $created->created_at,
                'lowongan' => $lowongan->kebutuhan,
                'seksi' => $seksi->nama_seksi,
            ];

            $sdmks = User::where('role', 'sdmk')->get();
            foreach ($sdmks as $sdmk) {
                Mail::to($sdmk->email)->send(new SdmkEmail($email));
            }

            return redirect('/kegiatanku')->with('alert', 'Pendaftaran berhasil! Mohon menunggu hasil paling lambat 7 x 24 jam');
        } else {
            return back()->with('alert', 'Error, Pendaftaran gagal!');
        }
    }

    public function detailpermohonanku(Request $request)
    {
        $permohonan = Permohonan::find($request->id);
        $html = '
                    <label class="mb-1">Surat Penerimaan Magang</label>
                    <br>
                    <a class="btn btn-outline-dark w-100" target="_blank" href="/storage/'.$permohonan->surat_magang.'">
                        <i class="bi bi-file-earmark-pdf"></i> Lihat Surat
                    </a>

                    <label class="mt-2 mb-1" for="">Pembimbing</label>
                    <input readonly class="form-control" type="text" name="kualifikasi" value="' . $permohonan->user->pembimbing . '">

                    <label class="mt-2 mb-1" for="">Tanggal Mulai</label>
                    <input readonly class="form-control" type="text" name="kualifikasi" value="' . $permohonan->user->tgl_mulai . '">

                    <label class="mt-2 mb-1" for="">Tanggal Selesai</label>
                    <input readonly class="form-control" type="text" name="kualifikasi" value="' . $permohonan->user->tgl_selesai . '">

                    <label class="mt-2 mb-1" for="">Jam Kerja</label>
                    <input readonly class="form-control" type="text" name="kualifikasi" value="08.00 - 16.00">
                ';
        return $html;
    }

    /**
     * Hapus Permohonanku
     */
    public function hapuspermohonanku(Request $request)
    {
        $permohonan = Permohonan::find($request->id);
        if ($permohonan->status == 0) {
            $html = '
                        <input type="hidden" name="id" value="'. $permohonan->id .'">
                        <h5 class="">Apakah anda yakin untuk membatalkan pendaftaran magang?</h5>
                    ';
        } else if ($permohonan->status > 1) {
            $html = '
                        <input type="hidden" name="id" value="'. $permohonan->id .'">
                        <h5 class="">Apakah anda yakin untuk menghapus riwayat pendaftaran magang?</h5>
                    ';
        }
        return $html;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletepermohonanku(Request $request)
    {
        $permohonan = Permohonan::find($request->id);
        $deleted = $permohonan->delete();

        if ($deleted) {
            return back()->with('hapus', 'Pendaftaran magang berhasil dihapus');
        }
        return back()->with('gagalhapus', 'Pendaftaran magang gagal dihapus');
    }
}
