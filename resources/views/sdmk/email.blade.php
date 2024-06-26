<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Magang Baru</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">

<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
    <h2 style="text-align: center; color: #333;">Permohonan Magang Baru</h2>
    <p>Kepada SDMK,</p>

    <p>Kami ingin memberitahukan bahwa ada pemohon baru untuk posisi <strong>{{ $email['lowongan'] }}</strong> di Seksi {{ $email['seksi'] }}. Berikut ini detailnya:</p>
    @php
        Carbon\Carbon::setLocale('id')
    @endphp

    <table style="width: 100%;">
        <tr>
            <td style="font-weight: bold; width: 30%;"><strong>Nama</strong></td>
            <td>:</td>
            <td>{{ $email['nama'] }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; width: 30%;"><strong>Email</strong></td>
            <td>:</td>
            <td>{{ $email['email'] }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; width: 30%;"><strong>No. Telepon</strong></td>
            <td>:</td>
            <td>{{ $email['notelp'] }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; width: 30%;"><strong>Tanggal Permohonan</strong></td>
            <td>:</td>
            <td>{{ Carbon\Carbon::parse($email['tgl_permohonan'])->translatedFormat('l, j F Y') }}</td>
        </tr>
    </table>
    {{-- <ul>
        <li><strong>Nama: </strong>{{ $email['nama'] }}</li>
        <li><strong>Email: </strong>{{ $email['email'] }}</li>
        <li><strong>Nomor Telepon: </strong>{{ $email['notelp'] }}</li>
        <li><strong>Tanggal Permohonan: </strong>{{ Carbon\Carbon::parse($email['tgl_permohonan'])->translatedFormat('l, j F Y') }}</li>
    </ul> --}}

    <p>Untuk melihat detail pemohon dan informasi lebih lanjut, silakan login ke akun Anda dan akses bagian Permohonan. Mohon segera tinjau profil pemohon tersebut dan lanjutkan proses seleksi sesuai dengan prosedur yang telah ditetapkan.</p>

    <p>Terima kasih atas perhatian dan kerjasama Anda.</p>
</div>

</body>
</html>
