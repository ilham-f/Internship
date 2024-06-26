<?php

namespace App\Http\Controllers;

use App\Models\Seksi;
use Illuminate\Http\Request;
use App\Models\KebutuhanMagang;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowongans = KebutuhanMagang::all();
        return view('user.home', compact('lowongans'));
    }

    public function seksi()
    {
        $seksis = Seksi::all();
        return view('user.seksi', compact('seksis'));
    }

    public function lowongan()
    {
        $lowongans = KebutuhanMagang::all();
        return view('user.lowongan', compact('lowongans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function evaluasi()
    {
        return view('user.evaluasi');
    }

    /**
     * Modal lowongan
     */
    public function detaillowongan(Request $request)
    {
        $kebutuhan = KebutuhanMagang::find($request->id);
        $html = '
                    <div class="">
                        <label class="mb-1" for="">Tugas</label>
                        <input readonly class="form-control" type="text" name="kebutuhan" value="' . $kebutuhan->kebutuhan . '">

                        <label class="mt-2 mb-1" for="">Kuota</label>
                        <input readonly class="form-control" type="number" name="kuota" value="' . $kebutuhan->kuota . '">

                        <label class="mt-2 mb-1" for="">Deskripsi</label>
                        <br>
                        <textarea readonly class="form-control mb-3" id="detail" name="detail">' . $kebutuhan->detail . '</textarea>
                        <div class="text-end px-3 pb-3">
                            <a href="/daftar/'. $kebutuhan->id .'" class="btn btn-info">Daftar</a>
                        </div>
                    </div>
                ';
        return $html;
    }

    /**
     * form pendaftaran
     */
    public function daftar(Request $request, $id)
    {
        $kebutuhan = KebutuhanMagang::find($id);
        $seksi = $kebutuhan->seksi;
        // dd($seksi);
        return view('user.form-pendaftaran', compact('kebutuhan', 'seksi'));
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
