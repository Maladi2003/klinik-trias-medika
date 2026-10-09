<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tiket Antrean - {{ $janji->id }}</title>
    <style>
        body { font-family: sans-serif; padding: 10px; color: #333; font-size: 12px; }
        .header { text-align: center; border-bottom: 2px solid #006c4a; padding-bottom: 10px; margin-bottom: 15px; }
        .title { font-size: 16px; font-weight: bold; color: #006c4a; margin: 0; }
        .sub { font-size: 10px; color: #666; margin-top: 3px; }
        .queue-box { background: #e8f5e9; border: 1px solid #c8e6c9; text-align: center; padding: 15px; margin: 15px 0; border-radius: 8px; }
        .queue-number { font-size: 36px; font-weight: bold; color: #006c4a; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 6px 0; border-bottom: 1px solid #eee; }
        .label { color: #666; width: 40%; }
        .value { font-weight: bold; width: 60%; text-align: right; }
        .qr-container { text-align: center; margin-top: 15px; padding: 10px; border: 1px dashed #006c4a; border-radius: 6px; background-color: #fafafa; }
        .footer { text-align: center; margin-top: 20px; font-size: 9px; color: #888; }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">KLINIK PRATAMA TRIAS MEDIKA</div>
        <div class="sub">Bukti Reservasi Online &amp; Tiket Antrean Poli</div>
    </div>

    @php
        $huruf = strtoupper(substr($janji->layanan->nama_layanan ?? 'A', 0, 1));
        $kodeAntrean = $huruf . '-' . str_pad($janji->no_antrean, 3, '0', STR_PAD_LEFT);
    @endphp

    <div class="queue-box">
        <div style="font-size: 10px; color: #555;">NOMOR ANTREAN</div>
        <div class="queue-number">{{ $kodeAntrean }}</div>
        <div style="font-size: 9px; color: #777;">Tunjukkan bukti ini kepada petugas pendaftaran saat datang</div>
    </div>

    <table>
        <tr>
            <td class="label">Nama Pasien</td>
            <td class="value">{{ $janji->pasien->nama_pasien }}</td>
        </tr>
        <tr>
            <td class="label">No. WhatsApp</td>
            <td class="value">{{ $janji->pasien->no_wa }}</td>
        </tr>
        <tr>
            <td class="label">Poli / Layanan</td>
            <td class="value">{{ $janji->layanan->nama_layanan }}</td>
        </tr>
        <tr>
            <td class="label">Dokter Pemeriksa</td>
            <td class="value">{{ $janji->jadwal->dokter->nama_dokter ?? 'Dokter Jaga' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Berobat</td>
            <td class="value">{{ date('d-m-Y', strtotime($janji->tanggal_berobat)) }}</td>
        </tr>
        <tr>
            <td class="label">Jam Praktik</td>
            <td class="value">{{ date('H:i', strtotime($janji->jadwal->jam_mulai)) }} WIB</td>
        </tr>
        <tr>
            <td class="label">Estimasi Biaya</td>
            <td class="value">Rp {{ number_format($janji->layanan->estimasi_biaya ?? 0, 0, ',', '.') }}</td>
        </tr>
    </table>

    <!-- QR Code Dinamis Verifikasi Antrean untuk PDF -->
    <div class="qr-container">
        <div style="font-size: 9px; font-weight: bold; color: #006c4a; margin-bottom: 4px;">SCAN VERIFIKASI ANTREAN</div>
        <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" width="110" height="110">
        <div style="font-size: 8px; color: #666; margin-top: 4px;">Kode Reservasi: #TR3S-{{ $janji->id }}</div>
    </div>

    <div class="footer">
        Terima kasih telah melakukan pendaftaran online.<br>
        Simpan berkas PDF ini sebagai bukti sah kedatangan di Klinik Trias Medika.
    </div>

</body>
</html>