<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Own Your Career</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
        }
        .navbar {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar h1 {
            font-size: 1.5rem;
        }
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .logout-btn {
            padding: 8px 20px;
            background: rgba(255,255,255,0.2);
            color: white;
            border: 2px solid white;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            background: white;
            color: #3b82f6;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
        }
        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .welcome-card h2 {
            color: #333;
            margin-bottom: 0.5rem;
        }
        .welcome-card p {
            color: #666;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 2rem;
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .stat-card .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .stat-card h3 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .stat-card p {
            color: #666;
        }
        .menu-list {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }
        .menu-list h3 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        .menu-item {
            display: block;
            padding: 15px 20px;
            background: #f3f4f6;
            border-radius: 10px;
            color: #333;
            text-decoration: none;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .menu-item:hover {
            background: #3b82f6;
            color: white;
            transform: translateX(5px);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>👨‍💼 Dashboard Admin</h1>
        <div class="user-info">
            <span>{{ auth()->user()->name }}</span>
            <form action="{{ route('admin.keluar') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 10px; margin-bottom: 20px; border-left: 4px solid #10b981;">
            {{ session('success') }}
        </div>
        @endif

        <div class="welcome-card">
            <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
            <p>Kelola sistem Own Your Career dari sini</p>
        </div>

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

        <div class="menu-list">
            <h3>Menu Admin</h3>
            <a href="{{ route('admin.perusahaan.index') }}" class="menu-item">📋 Verifikasi Perusahaan</a>
            <a href="{{ route('admin.lowongan.index') }}" class="menu-item">✅ Verifikasi Lowongan</a>
            <a href="{{ route('admin.laporan.rekap') }}" class="menu-item">📊 Laporan Rekap Pendaftar</a>
        </div>
    </div>
</body>
</html>