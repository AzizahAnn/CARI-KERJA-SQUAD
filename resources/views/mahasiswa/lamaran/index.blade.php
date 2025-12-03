<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Lamaran - Own Your Career</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
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
        .badge-diterima { background: #d1fae5; color: #065f46; }
        .badge-ditolak { background: #fee2e2; color: #991b1b; }
        .card-info { color: #666; margin-bottom: 0.5rem; }
        .btn-detail { display: inline-block; margin-top: 1rem; padding: 10px 25px; background: #f59e0b; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; }
        .empty-state { text-align: center; padding: 3rem; color: #666; background: white; border-radius: 15px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>📋 Riwayat Lamaran</h1>
        <div>
            <a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
            <a href="{{ route('mahasiswa.lowongan.index') }}">Cari Lowongan</a>
            <a href="{{ route('mahasiswa.lamaran.index') }}">Lamaran Saya</a>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <h2 style="margin-bottom: 1.5rem;">Lamaran Saya ({{ $lamaran->count() }})</h2>

        @if($lamaran->count() > 0)
            @foreach($lamaran as $item)
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">{{ $item->lowongan->posisi }}</h3>
                        <p class="company-name">🏢 {{ $item->lowongan->perusahaan->nama_perusahaan }}</p>
                    </div>
                    <span class="badge badge-{{ $item->status }}">
                        @if($item->status == 'menunggu') ⏳ Menunggu
                        @elseif($item->status == 'diterima') ✅ Diterima
                        @else ❌ Ditolak
                        @endif
                    </span>
                </div>
                
                <p class="card-info">📍 {{ $item->lowongan->lokasi }}</p>
                <p class="card-info">📅 Dilamar: {{ $item->tanggal_daftar->format('d M Y H:i') }}</p>
                <p class="card-info">📄 CV: {{ basename($item->jalur_cv) }}</p>
                
                <a href="{{ route('mahasiswa.lamaran.detail', $item->id) }}" class="btn-detail">Lihat Detail</a>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <h3>Belum ada lamaran</h3>
                <p><a href="{{ route('mahasiswa.lowongan.index') }}" style="color: #f59e0b;">Cari lowongan</a> dan kirim lamaran pertama Anda</p>
            </div>
        @endif
    </div>
</body>
</html>