<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekap - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 1.5rem; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 20px; }
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 2rem; }
        .stat-card { background: white; border-radius: 15px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
        .stat-card .icon { font-size: 3rem; margin-bottom: 1rem; }
        .stat-card h3 { color: #333; font-size: 2rem; margin-bottom: 0.5rem; }
        .stat-card p { color: #666; }
        .card { background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        h2 { color: #333; margin-bottom: 1.5rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; color: #333; }
        .badge { padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: bold; }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-diterima { background: #d1fae5; color: #065f46; }
        .badge-ditolak { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>📊 Laporan Rekap Pendaftar</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.perusahaan.index') }}">Perusahaan</a>
            <a href="{{ route('admin.lowongan.index') }}">Lowongan</a>
            <a href="{{ route('admin.laporan.rekap') }}">Laporan</a>
        </div>
    </nav>

    <div class="container">
        <h2>Statistik Keseluruhan</h2>
        
        <div class="card-grid">
            <div class="stat-card">
                <div class="icon">🏢</div>
                <h3>{{ $totalPerusahaan }}</h3>
                <p>Total Perusahaan</p>
            </div>
            <div class="stat-card">
                <div class="icon">🎓</div>
                <h3>{{ $totalMahasiswa }}</h3>
                <p>Total Mahasiswa</p>
            </div>
            <div class="stat-card">
                <div class="icon">💼</div>
                <h3>{{ $totalLowongan }}</h3>
                <p>Total Lowongan</p>
            </div>
            <div class="stat-card">
                <div class="icon">📄</div>
                <h3>{{ $totalPendaftaran }}</h3>
                <p>Total Lamaran</p>
            </div>
        </div>

        <div class="card">
            <h2>Rekap Lamaran per Status</h2>
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekapStatus as $item)
                    <tr>
                        <td>
                            <span class="badge badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $totalPendaftaran > 0 ? round(($item->jumlah / $totalPendaftaran) * 100, 1) : 0 }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2>Daftar Pelamar per Lowongan</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Posisi</th>
                        <th>Perusahaan</th>
                        <th>Jumlah Pelamar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowonganDenganPelamar as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->posisi }}</td>
                        <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                        <td><strong>{{ $item->pendaftaran_count }} orang</strong></td>
                        <td>
                            <span class="badge badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>