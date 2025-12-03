<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Lowongan - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 1.5rem; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 20px; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-left: 4px solid #10b981; }
        .card { background: white; border-radius: 15px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .card-header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem; }
        .card-title { font-size: 1.5rem; color: #333; margin-bottom: 0.5rem; }
        .company-name { color: #666; font-size: 1rem; }
        .badge { padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: bold; }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-aktif { background: #d1fae5; color: #065f46; }
        .badge-nonaktif { background: #fee2e2; color: #991b1b; }
        .card-info { color: #666; margin-bottom: 0.5rem; }
        .btn { padding: 8px 20px; border: none; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: bold; margin-right: 10px; text-decoration: none; display: inline-block; }
        .btn-detail { background: #3b82f6; color: white; }
        .btn-success { background: #10b981; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .empty-state { text-align: center; padding: 3rem; color: #666; background: white; border-radius: 15px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>📋 Verifikasi Lowongan</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.perusahaan.index') }}">Perusahaan</a>
            <a href="{{ route('admin.lowongan.index') }}">Lowongan</a>
            <a href="{{ route('admin.laporan.rekap') }}">Laporan</a>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <h2 style="margin-bottom: 1.5rem;">Daftar Lowongan ({{ $lowongan->count() }})</h2>

        @if($lowongan->count() > 0)
            @foreach($lowongan as $item)
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">{{ $item->posisi }}</h3>
                        <p class="company-name">🏢 {{ $item->perusahaan->nama_perusahaan }}</p>
                    </div>
                    <span class="badge badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                </div>
                
                <p class="card-info">📍 {{ $item->lokasi }}</p>
                <p class="card-info">📅 Batas: {{ $item->batas_akhir->format('d M Y') }}</p>
                <p class="card-info">🗓️ Dibuat: {{ $item->created_at->format('d M Y H:i') }}</p>
                
                <div style="margin-top: 1rem;">
                    <a href="{{ route('admin.lowongan.detail', $item->id) }}" class="btn btn-detail">Detail</a>
                    
                    @if($item->status == 'menunggu')
                    <form action="{{ route('admin.lowongan.setujui', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">✓ Setujui</button>
                    </form>
                    <form action="{{ route('admin.lowongan.tolak', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin tolak lowongan ini?')">
                        @csrf
                        <button type="submit" class="btn btn-danger">✗ Tolak</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <h3>Belum ada lowongan</h3>
                <p>Lowongan dari perusahaan akan muncul di sini</p>
            </div>
        @endif
    </div>
</body>
</html>