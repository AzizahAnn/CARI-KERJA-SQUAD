<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Peran - Own Your Career</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 3rem;
            font-size: 2.5rem;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
        }
        .card-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .card h2 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }
        .card p {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .admin { border-top: 5px solid #3b82f6; }
        .perusahaan { border-top: 5px solid #10b981; }
        .mahasiswa { border-top: 5px solid #f59e0b; }
        
        .back-btn {
            display: block;
            text-align: center;
            color: white;
            text-decoration: none;
            margin-top: 2rem;
            opacity: 0.8;
        }
        .back-btn:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Masuk Sebagai</h1>
        
        <div class="card-container">
            <!-- ADMIN -->
            <div class="card admin">
                <div class="card-icon">👨‍💼</div>
                <h2>Admin</h2>
                <p>Kelola sistem, verifikasi perusahaan dan lowongan</p>
                <a href="{{ route('admin.masuk') }}" class="btn">Masuk Admin</a>
            </div>
            
            <!-- PERUSAHAAN -->
            <div class="card perusahaan">
                <div class="card-icon">🏢</div>
                <h2>Perusahaan</h2>
                <p>Posting lowongan dan lihat pelamar</p>
                <a href="{{ route('perusahaan.masuk') }}" class="btn">Masuk Perusahaan</a>
                <br><br>
                <a href="{{ route('perusahaan.daftar') }}" style="color: #10b981; text-decoration: none; font-size: 0.9rem;">Belum punya akun? Daftar</a>
            </div>
            
            <!-- MAHASISWA -->
            <div class="card mahasiswa">
                <div class="card-icon">🎓</div>
                <h2>Mahasiswa</h2>
                <p>Cari lowongan dan kirim lamaran</p>
                <a href="{{ route('mahasiswa.masuk') }}" class="btn">Masuk Mahasiswa</a>
                <br><br>
                <a href="{{ route('mahasiswa.daftar') }}" style="color: #f59e0b; text-decoration: none; font-size: 0.9rem;">Belum punya akun? Daftar</a>
            </div>
        </div>
        
        <a href="{{ route('beranda') }}" class="back-btn">← Kembali ke Beranda</a>
    </div>
</body>
</html>