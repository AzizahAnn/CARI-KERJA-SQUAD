<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Lowongan - Own Your Career</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 1.5rem; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 20px; }
        .search-box { background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 2rem; }
        .search-form { display: grid; grid-template-columns: 1fr 200px 150px; gap: 15px; }
        .search-form input, .search-form select { padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; }
        .search-form button { padding: 12px; background: #f59e0b; color: white; border: none; border-radius: 10px; font-weight: bold; cursor: pointer; }
        .search-form button:hover { background: #d97706; }
        .card { background: white; border-radius: 15px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; transition: all 0.3s ease; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.15); }
        .card-header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem; }
        .card-title { font-size: 1.5rem; color: #333; margin-bottom: 0.5rem; }
        .company-name { color: #666; font-size: 1rem; }
        .badge { padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: bold; }
        .badge-magang { background: #dbeafe; color: #1e40af; }
        .badge-kerja { background: #fef3c7; color: #92400e; }
        .card-info { color: #666; margin-bottom: 0.5rem; }
        .btn-detail { display: inline-block; margin-top: 1rem; padding: 10px 25px; background: #f59e0b; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; }
        .btn-detail:hover { background: #d97706; }
        .empty-state { text-align: center; padding: 3rem; color: #666; background: white; border-radius: 15px; }
        @media (max-width: 768px) {
            .search-form { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🔍 Cari Lowongan</h1>
        <div>
            <a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
            <a href="{{ route('mahasiswa.lowongan.index') }}">Cari Lowongan</a>
            <a href="{{ route('mahasiswa.lamaran.index') }}">Lamaran Saya</a>
        </div>
    </nav>

    <div class="container">
        <div class="search-box">
            <form action="{{ route('mahasiswa.lowongan.index') }}" method="GET" class="search-form">
                <input type="text" name="cari" placeholder="Cari posisi atau lokasi..." value="{{ request('cari') }}">
                <select name="tipe">
                    <option value="">Semua Tipe</option>
                    <option value="magang" {{ request('tipe') == 'magang' ? 'selected' : '' }}>Magang</option>
                    <option value="kerja" {{ request('tipe') == 'kerja' ? 'selected' : '' }}>Kerja</option>
                </select>
                <button type="submit">🔍 Cari</button>
            </form>
        </div>

        <h2 style="margin-bottom: 1.5rem;">Lowongan Tersedia ({{ $lowongan->count() }})</h2>

        @if($lowongan->count() > 0)
            @foreach($lowongan as $item)
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">{{ $item->posisi }}</h3>
                        <p class="company-name">🏢 {{ $item->perusahaan->nama_perusahaan }}</p>
                    </div>
                    <span class="badge badge-{{ $item->tipe }}">{{ ucfirst($item->tipe) }}</span>
                </div>
                
                <p class="card-info">📍 {{ $item->lokasi }}</p>
                <p class="card-info">📅 Batas: {{ $item->batas_akhir->format('d M Y') }}</p>
                <p class="card-info">{{ Str::limit($item->deskripsi, 150) }}</p>
                
                <a href="{{ route('mahasiswa.lowongan.detail', $item->id) }}" class="btn-detail">Lihat Detail & Lamar</a>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <h3>Tidak ada lowongan ditemukan</h3>
                <p>Coba ubah kata kunci pencarian Anda</p>
            </div>
        @endif
    </div>
</body>
</html>