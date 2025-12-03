<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 1rem 2rem; }
        .navbar h1 { font-size: 1.5rem; }
        .container { max-width: 900px; margin: 2rem auto; padding: 0 20px; }
        .card { background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 2px solid #e5e7eb; }
        .title { font-size: 2rem; color: #333; margin-bottom: 0.5rem; }
        .company { color: #666; font-size: 1.2rem; }
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
        .btn { padding: 12px 25px; border: none; border-radius: 10px; cursor: pointer; font-size: 1rem; font-weight: bold; margin-right: 10px; }
        .btn-success { background: #10b981; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-secondary { background: #6b7280; color: white; text-decoration: none; display: inline-block; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-left: 4px solid #10b981; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>📄 Detail Lowongan</h1>
    </nav>

    <div class="container">
        <a href="{{ route('admin.lowongan.index') }}" style="color: #3b82f6; text-decoration: none; display: inline-block; margin-bottom: 1rem;">← Kembali</a>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="header">
                <div>
                    <h1 class="title">{{ $lowongan->posisi }}</h1>
                    <p class="company">🏢 {{ $lowongan->perusahaan->nama_perusahaan }}</p>
                </div>
                <span class="badge badge-{{ $lowongan->status }}">{{ ucfirst($lowongan->status) }}</span>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">📍 Lokasi</div>
                    <div class="info-value">{{ $lowongan->lokasi }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📅 Batas Akhir</div>
                    <div class="info-value">{{ $lowongan->batas_akhir->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📌 Tipe</div>
                    <div class="info-value">{{ ucfirst($lowongan->tipe) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">🗓️ Dibuat</div>
                    <div class="info-value">{{ $lowongan->created_at->format('d M Y H:i') }}</div>
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

            @if($lowongan->status == 'menunggu')
            <div style="margin-top: 2rem;">
                <form action="{{ route('admin.lowongan.setujui', $lowongan->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">✓ Setujui Lowongan</button>
                </form>
                <form action="{{ route('admin.lowongan.tolak', $lowongan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin tolak lowongan ini?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">✗ Tolak Lowongan</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</body>
</html>