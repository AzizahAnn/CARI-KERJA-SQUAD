<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lamaran - Own Your Career</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 1rem 2rem; }
        .navbar h1 { font-size: 1.5rem; }
        .container { max-width: 900px; margin: 2rem auto; padding: 0 20px; }
        .card { background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 2px solid #e5e7eb; }
        .title { font-size: 2rem; color: #333; margin-bottom: 0.5rem; }
        .company { color: #666; font-size: 1.2rem; }
        .badge { padding: 8px 20px; border-radius: 20px; font-size: 0.9rem; font-weight: bold; }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-diterima { background: #d1fae5; color: #065f46; }
        .badge-ditolak { background: #fee2e2; color: #991b1b; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .info-item { padding: 1rem; background: #f9fafb; border-radius: 10px; }
        .info-label { color: #666; font-size: 0.9rem; margin-bottom: 0.3rem; }
        .info-value { color: #333; font-weight: 600; }
        .section { margin-bottom: 2rem; }
        .section h3 { color: #333; margin-bottom: 1rem; font-size: 1.3rem; }
        .section p { color: #666; line-height: 1.8; white-space: pre-line; }
        .status-box { padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem; }
        .status-menunggu { background: #fef3c7; border-left: 4px solid #f59e0b; }
        .status-diterima { background: #d1fae5; border-left: 4px solid #10b981; }
        .status-ditolak { background: #fee2e2; border-left: 4px solid #ef4444; }
        .status-box h4 { margin-bottom: 0.5rem; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>📄 Detail Lamaran</h1>
    </nav>

    <div class="container">
        <a href="{{ route('mahasiswa.lamaran.index') }}" style="color: #f59e0b; text-decoration: none; display: inline-block; margin-bottom: 1rem;">← Kembali</a>

        <div class="card">
            <div class="header">
                <div>
                    <h1 class="title">{{ $lamaran->lowongan->posisi }}</h1>
                    <p class="company">🏢 {{ $lamaran->lowongan->perusahaan->nama_perusahaan }}</p>
                </div>
                <span class="badge badge-{{ $lamaran->status }}">
                    @if($lamaran->status == 'menunggu') ⏳ Menunggu
                    @elseif($lamaran->status == 'diterima') ✅ Diterima
                    @else ❌ Ditolak
                    @endif
                </span>
            </div>

            @if($lamaran->status == 'menunggu')
            <div class="status-box status-menunggu">
                <h4 style="color: #92400e;">⏳ Lamaran Sedang Direview</h4>
                <p style="color: #92400e;">Lamaran Anda sedang ditinjau oleh perusahaan. Harap tunggu informasi lebih lanjut.</p>
            </div>
            @elseif($lamaran->status == 'diterima')
            <div class="status-box status-diterima">
                <h4 style="color: #065f46;">🎉 Selamat! Lamaran Anda Diterima</h4>
                <p style="color: #065f46;">Perusahaan akan menghubungi Anda untuk tahap selanjutnya.</p>
            </div>
            @else
            <div class="status-box status-ditolak">
                <h4 style="color: #991b1b;">❌ Lamaran Tidak Diterima</h4>
                <p style="color: #991b1b;">Jangan berkecil hati! Coba lamar ke lowongan lain yang sesuai.</p>
            </div>
            @endif

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">📍 Lokasi</div>
                    <div class="info-value">{{ $lamaran->lowongan->lokasi }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📅 Tanggal Lamar</div>
                    <div class="info-value">{{ $lamaran->tanggal_daftar->format('d M Y H:i') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📄 File CV</div>
                    <div class="info-value">{{ basename($lamaran->jalur_cv) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📌 Tipe</div>
                    <div class="info-value">{{ ucfirst($lamaran->lowongan->tipe) }}</div>
                </div>
            </div>

            <div class="section">
                <h3>📝 Deskripsi Pekerjaan</h3>
                <p>{{ $lamaran->lowongan->deskripsi }}</p>
            </div>

            <div class="section">
                <h3>✅ Persyaratan</h3>
                <p>{{ $lamaran->lowongan->persyaratan }}</p>
            </div>
        </div>
    </div>
</body>
</html>