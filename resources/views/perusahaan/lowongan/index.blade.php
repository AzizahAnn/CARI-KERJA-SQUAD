<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lowongan - Own Your Career</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 1.5rem; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 20px; }
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .btn-primary { padding: 12px 30px; background: #10b981; color: white; text-decoration: none; border-radius: 10px; font-weight: bold; display: inline-block; }
        .btn-primary:hover { background: #059669; }
        .alert { padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        .card { background: white; border-radius: 15px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .card-header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem; }
        .card-title { font-size: 1.5rem; color: #333; }
        .badge { padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: bold; }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-aktif { background: #d1fae5; color: #065f46; }
        .badge-nonaktif { background: #fee2e2; color: #991b1b; }
        .badge-tipe { background: #e0e7ff; color: #3730a3; margin-left: 10px; }
        .card-info { color: #666; margin-bottom: 0.5rem; }
        .card-actions { margin-top: 1rem; display: flex; gap: 10px; flex-wrap: wrap; }
        .btn { padding: 8px 20px; border-radius: 8px; text-decoration: none; display: inline-block; font-size: 0.9rem; }
        .btn-detail { background: #3b82f6; color: white; }
        .btn-pelamar { background: #f59e0b; color: white; }
        .btn-edit { background: #8b5cf6; color: white; }
        .btn-delete { background: #ef4444; color: white; border: none; cursor: pointer; }
        .empty-state { text-align: center; padding: 3rem; color: #666; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🏢 Daftar Lowongan</h1>
        <div>
            <a href="{{ route('perusahaan.dashboard') }}">Dashboard</a>
            <a href="{{ route('perusahaan.lowongan.index') }}">Lowongan</a>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="header-section">
            <h2>Lowongan Saya</h2>
            <a href="{{ route('perusahaan.lowongan.buat') }}" class="btn-primary">+ Buat Lowongan Baru</a>
        </div>

        @if($lowongan->count() > 0)
            @foreach($lowongan as $item)
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">{{ $item->posisi }}</h3>
                        <span class="badge badge-{{ $item->status }}">
                            @if($item->status == 'menunggu') ⏳ Menunggu Verifikasi
                            @elseif($item->status == 'aktif') ✅ Aktif
                            @else ❌ Nonaktif
                            @endif
                        </span>
                        <span class="badge badge-tipe">{{ ucfirst($item->tipe) }}</span>
                    </div>
                </div>
                
                <p class="card-info">📍 {{ $item->lokasi }}</p>
                <p class="card-info">📅 Batas: {{ $item->batas_akhir->format('d M Y') }}</p>
                <p class="card-info">👥 Pelamar: {{ $item->pendaftaran->count() }} orang</p>
                
                <div class="card-actions">
                    <a href="{{ route('perusahaan.lowongan.detail', $item->id) }}" class="btn btn-detail">Detail</a>
                    <a href="{{ route('perusahaan.lowongan.pelamar', $item->id) }}" class="btn btn-pelamar">Lihat Pelamar</a>
                    <a href="{{ route('perusahaan.lowongan.ubah', $item->id) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('perusahaan.lowongan.hapus', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus lowongan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <h3>Belum ada lowongan</h3>
                <p>Buat lowongan pertama Anda untuk mulai menerima pelamar</p>
            </div>
        @endif
    </div>
</body>
</html>