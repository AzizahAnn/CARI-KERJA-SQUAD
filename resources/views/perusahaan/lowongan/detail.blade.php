<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan - Own Your Career</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 1rem 2rem; }
        .navbar h1 { font-size: 1.5rem; }
        .container { max-width: 900px; margin: 2rem auto; padding: 0 20px; }
        .card { background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 2px solid #e5e7eb; }
        .title { font-size: 2rem; color: #333; margin-bottom: 0.5rem; }
        .badge { padding: 8px 20px; border-radius: 20px; font-size: 0.9rem; font-weight: bold; }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-aktif { background: #d1fae5; color: #065f46; }
        .badge-nonaktif { background: #fee2e2; color: #991b1b; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .info-item { padding: 1rem; background: #f9fafb; border-radius: 10px; }
        .info-label { color: #666; font-size: 0.9rem; margin-bottom: 0.3rem; }
        .info-value { color: #333; font-weight: 600; }
        .section { margin-bottom: 2rem; }
        .section h3 { color: #333; margin-bottom: 1rem; font-size: 1.3rem; }
        .section p { color: #666; line-height: 1.8; white-space: pre-line; }
        .btn-group { display: flex; gap: 10px; margin-top: 2rem; }
        .btn { padding: 12px 25px; border-radius: 10px; text-decoration: none; font-weight: bold; display: inline-block; text-align: center; }
        .btn-primary { background: #10b981; color: white; }
        .btn-secondary { background: #8b5cf6; color: white; }
        .btn-back { background: #6b7280; color: white; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-left: 4px solid #10b981; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>📄 Detail Lowongan</h1>
    </nav>

    <div class="container">
        <a href="{{ route('perusahaan.lowongan.index') }}" style="color: #10b981; text-decoration: none; display: inline-block; margin-bottom: 1rem;">← Kembali</a>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="header">
                <div>
                    <h1 class="title">{{ $lowongan->posisi }}</h1>
                    <p style="color: #666;">Dibuat: {{ $lowongan->created_at->format('d M Y H:i') }}</p>
                </div>
                <span class="badge badge-{{ $lowongan->status }}">
                    @if($lowongan->status == 'menunggu') ⏳ Menunggu Verifikasi
                    @elseif($lowongan->status == 'aktif') ✅ Aktif
                    @else ❌ Nonaktif
                    @endif
                </span>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">📌 Tipe</div>
                    <div class="info-value">{{ ucfirst($lowongan->tipe) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📍 Lokasi</div>
                    <div class="info-value">{{ $lowongan->lokasi }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📅 Batas Akhir</div>
                    <div class="info-value">{{ $lowongan->batas_akhir->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">👥 Jumlah Pelamar</div>
                    <div class="info-value">{{ $lowongan->pendaftaran->count() }} orang</div>
                </div>
            </div>

            <div class="section">
                <h3>📝 Deskripsi Pekerjaan</h3>
                <p>{{ $lowongan->deskripsi }}</p>
            </div>

            <div class="section">
                <h3>✅ Persyaratan</h3>
                <p>{{ $lowongan->persyaratan }}</p>
            </div>

            <div class="btn-group">
                <a href="{{ route('perusahaan.lowongan.pelamar', $lowongan->id) }}" class="btn btn-primary">👥 Lihat Pelamar ({{ $lowongan->pendaftaran->count() }})</a>
                <a href="{{ route('perusahaan.lowongan.ubah', $lowongan->id) }}" class="btn btn-secondary">✏️ Edit Lowongan</a>
            </div>
        </div>
    </div>
</body>
</html>