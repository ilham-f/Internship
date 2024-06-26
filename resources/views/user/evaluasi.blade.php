@extends('layouts.user')

@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 100px">
    @if (Auth::user()->pengetahuan)
        <div class="card p-3">
            <h4 class="text-center">Terima kasih atas saran dan masukan Anda, kami akan terus mengevaluasi dan meningkatkan proses pelaksanaan magang di Dinas Kesehatan Provinsi Jawa Timur</h4>
        </div>
    @else
        <form action="/evaluasi" method="post">
            @csrf
            {{-- Pengetahuan --}}
            <div class="py-4 rounded border shadow-sm">
                <div class="text-center mb-4 fw-bold">
                    Melakukan Magang di Dinas Kesehatan Provinsi Jawa Timur mendapatkan pengetahuan yang diharapkan
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="pengetahuan" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="pengetahuan" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="pengetahuan" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="pengetahuan" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- keterampilan --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Melakukan Magang di Dinas Kesehatan Provinsi Jawa Timur menambah keterampilan baru
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="keterampilan" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="keterampilan" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="keterampilan" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="keterampilan" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- komunikasi --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Melakukan Magang di Dinas Kesehatan Provinsi Jawa Timur menambah kemampuan berkomunikasi/public speaking.
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="komunikasi" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="komunikasi" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="komunikasi" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="komunikasi" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- problem solving --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Melakukan Magang di Dinas Kesehatan Provinsi Jawa Timur menambah kemampuan pemecahan masalah/problem solving
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="problem_solve" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="problem_solve" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="problem_solve" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="problem_solve" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- bimbingan --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Pembimbing lapangan memiliki pengetahuan yang memadai dalam melakukan bimbingan
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="bimbingan" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="bimbingan" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="bimbingan" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="bimbingan" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- gambaran --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Pembimbing lapangan mampu memberikan gambaran praktik kerja sesuai tugas pokok dan fungsi Dinas Kesehatan Provinsi Jawa Timur
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="gambaran_kerja" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="gambaran_kerja" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="gambaran_kerja" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="gambaran_kerja" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- diskusi --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Pembimbing lapangan memiliki waktu yang cukup untuk berdiskusi
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="waktu_diskusi" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="waktu_diskusi" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="waktu_diskusi" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="waktu_diskusi" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- kompetensi --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Pembimbing lapangan mampu mengarahkan kegiatan magang sesuai capaian kompetensi mahasiswa
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="pengarahan" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="pengarahan" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="pengarahan" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="pengarahan" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- Wifi --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Wifi sangat mendukung pelaksanaan magang
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="wifi" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="wifi" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="wifi" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="wifi" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- ruangan --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Mahasiswa difasilitasi ruangan yang memadai untuk melaksanakan magang
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="">
                        Setuju
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="ruangan" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="ruangan" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="ruangan" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input shadow-sm" type="radio" name="ruangan" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                    </div>
                    <div class="">
                        Tidak Setuju
                    </div>
                </div>
            </div>
            {{-- Saran Pembimbing --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Saran untuk Pembimbing Lapangan
                </div>
                <div class="d-flex justify-content-center">
                    <textarea name="saran_pembimbing" class="form-control shadow-sm" style="height: 100px; width: 60%"></textarea>
                </div>
            </div>
            {{-- Saran Pelaksanaan --}}
            <div class="py-4 rounded border shadow-sm mt-4">
                <div class="text-center mb-4 fw-bold">
                    Saran untuk Pelaksanaan Magang
                </div>
                <div class="d-flex justify-content-center">
                    <textarea name="saran_pelaksanaan" class="form-control shadow-sm" style="height: 100px; width: 60%"></textarea>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-outline-dark">Submit</button>
            </div>
        </form>
    @endif
</div>
@endsection
