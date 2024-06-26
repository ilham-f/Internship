<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Hasil Seleksi Magang</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">

<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
    <h2 style="text-align: center; color: #333;">Pemberitahuan Hasil Seleksi Magang</h2>
    <p>Kepada {{ $email['nama'] }},</p>

    @if ($email['status'] == 'DITERIMA')
        <p>Setelah pertimbangan yang cermat, kami memutuskan bahwa Anda telah <strong>{{ $email['status'] }}</strong> sebagai Mahasiswa Magang di Dinas Kesehatan Provinsi Jawa Timur.</p>
    @else
        <p>Setelah pertimbangan yang cermat, kami memutuskan bahwa Anda telah <strong>{{ $email['status'] }}</strong> sebagai Mahasiswa Magang di Dinas Kesehatan Provinsi Jawa Timur.</p>
    @endif

    @php
        Carbon\Carbon::setLocale('id')
    @endphp
    
    @if ($email['status'] == 'DITERIMA')
        <table style="width: 100%;">
            <tr>
                <td style="font-weight: bold; width: 30%;"><strong>Tugas</strong></td>
                <td>:</td>
                <td>{{ $email['lowongan'] }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 30%;"><strong>Seksi</strong></td>
                <td>:</td>
                <td>{{ $email['seksi'] }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 30%;"><strong>Tanggal Mulai</strong></td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($email['tgl_mulai'])->translatedFormat('l, j F Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 30%;"><strong>Tanggal Selesai</strong></td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($email['tgl_selesai'])->translatedFormat('l, j F Y') }}</td>
            </tr>
        </table>
    @endif

    @if ($email['status'] == 'DITERIMA')
        <p>Kami akan menghubungi Anda segera untuk memberikan informasi lebih lanjut mengenai jadwal dan proses magang. Silakan siapkan diri Anda untuk bergabung dengan tim kami!</p>

        <p>Terima kasih atas minat dan partisipasi Anda. Selamat bergabung!</p>
    @else
        <p>Kami menghargai waktu dan usaha yang Anda berikan untuk melamar posisi ini. Mohon jangan ragu untuk melihat posisi-posisi lain yang mungkin tersedia di [Nama Perusahaan].</p>

        <p>Terima kasih atas minat dan partisipasi Anda. Kami mengucapkan yang terbaik untuk masa depan Anda.</p>
    @endif
</div>

</body>
</html>
