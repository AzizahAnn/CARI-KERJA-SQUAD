<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelamar - Own Your Career</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 1rem 2rem; }
        .navbar h1 { font-size: 1.5rem; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 20px; }
        .card { background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        h2 { color: #333; margin-bottom: 1.5rem; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-left: 4px solid #10b981; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; color: #333; }
        tbody tr:hover { background: #f9fafb; }
        .badge { padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: bold; display: inline-block; }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-diterima { background: #d1fae5; color: #065f46; }
        .badge-ditolak { background: #fee2e2; color: #991b1b; }
        .btn { padding: 6px 15px; border: none; border-radius: 6px; cursor: pointer; font-size: 0.85rem; margin-right: 5px; text-decoration: none; display: inline-block; }
        .btn-download { background: #3b82f6; color: white; }
        .btn-terima { background: #10b981; color: white; }
        .btn-tolak { background: #ef4444; color: white; }
        .empty-state { text-align: center; padding: 2rem; color: #666; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>👥 Daftar Pelamar</h1>
    </nav>

    <div class="container">
        <a href="{{ route('perusahaan.lowongan.index') }}" style="color: #10b981; text-decoration: none; display: inline-block; margin-bottom: 1rem;">← Kembali</a>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <h2>{{ $lowongan->posisi }} - {{ $lowongan->perusahaan->nama_perusahaan }}</h2>
            <p style="color: #666; margin-bottom: 2rem;">Total Pelamar: <strong>{{ $lowongan->pendaftaran->count() }}</strong> orang</p>

            @if($lowongan->pendaftaran->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Tanggal Lamar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowongan->pendaftaran as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->mahasiswa->nama_lengkap }}</td>
                        <td>{{ $item->mahasiswa->nim }}</td>
                        <td>{{ $item->mahasiswa->jurusan }}</td>
                        <td>{{ $item->tanggal_daftar->format('d M Y H:i') }}</td>
                        <td>
                            <span class="badge badge-{{ $item->status }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('perusahaan.pendaftaran.unduh-cv', $item->id) }}" class="btn btn-download">📄 Download CV</a>
                            
                            @if($item->status == 'menunggu')
                            <form action="{{ route('perusahaan.pendaftaran.ubah-status', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="diterima">
                                <button type="submit" class="btn btn-terima">✓ Terima</button>
                            </form>
                            <form action="{{ route('perusahaan.pendaftaran.ubah-status', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="btn btn-tolak">✗ Tolak</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <h3>Belum ada pelamar</h3>
                <p>Lowongan ini belum menerima lamaran</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>