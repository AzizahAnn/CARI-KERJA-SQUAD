<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan - Own Your Career</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 1rem 2rem; }
        .navbar h1 { font-size: 1.5rem; }
        .container { max-width: 900px; margin: 2rem auto; padding: 0 20px; }
        .card { background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 2px solid #e5e7eb; }
        .title { font-size: 2rem; color: #333; margin-bottom: 0.5rem; }
        .company { color: #666; font-size: 1.2rem; margin-bottom: 1rem; }
        .badge { padding: 8px 20px; border-radius: 20px; font-size: 0.9rem; font-weight: bold; }
        .badge-magang { background: #dbeafe; color: #1e40af; }
        .badge-kerja { background: #fef3c7; color: #92400e; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .info-item { padding: 1rem; background: #f9fafb; border-radius: 10px; }
        .info-label { color: #666; font-size: 0.9rem; margin-bottom: 0.3rem; }
        .info-value { color: #333; font-weight: 600; }
        .section { margin-bottom: 2rem; }
        .section h3 { color: #333; margin-bottom: 1rem; font-size: 1.3rem; }
        .section p { color: #666; line-height: 1.8; white-space: pre-line; }
        .alert { padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        .alert-error { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }
        .alert-info { background: #fef3c7; color: #92400e; border-left: 4px solid #f59e0b; }
        .upload-section { background: #fffbeb; padding: 2rem; border-radius: 15px; border: 2px dashed #f59e0b; }
        .upload-section h3 { color: #92400e; margin-bottom: 1rem; }
        .file-input { margin: 1rem 0; }
        .file-label { display: block; padding: 12px; background: white; border: 2px solid #e5e7eb; border-radius: 10px; cursor: pointer; text-align: center; }
        .file-label:hover { border-color: #f59e0b; }
        .btn { padding: 14px 30px; border-radius: 10px; font-size: 1.1rem; font-weight: bold; cursor: pointer; border: none; }
        .btn-primary { background: #f59e0b; color: white; width: 100%; }
        .btn-primary:hover { background: #d97706; }
        .error-text { color: #ef4444; font-size: 0.9rem; margin-top: 0.5rem; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>📄 Detail Lowongan</h1>
    </nav>

    <div class="container">
        <a href="{{ route('mahasiswa.lowongan.index') }}" style="color: #f59e0b; text-decoration: none; display: inline-block; margin-bottom: 1rem;">← Kembali ke Daftar Lowongan</a>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($sudahDaftar)
        <div class="alert alert-info">
            ✅ Anda sudah mendaftar di lowongan ini. Cek status di <a href="{{ route('mahasiswa.lamaran.index') }}" style="color: #92400e; font-weight: bold;">Riwayat Lamaran</a>
        </div>
        @endif

        <div class="card">
            <div class="header">
                <div>
                    <h1 class="title">{{ $lowongan->posisi }}</h1>
                    <p class="company">🏢 {{ $lowongan->perusahaan->nama_perusahaan }}</p>
                </div>
                <span class="badge badge-{{ $lowongan->tipe }}">{{ ucfirst($lowongan->tipe) }}</span>
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
            </div>

            <div class="section">
                <h3>📝 Deskripsi Pekerjaan</h3>
                <p>{{ $lowongan->deskripsi }}</p>
            </div>

            <div class="section">
                <h3>✅ Persyaratan</h3>
                <p>{{ $lowongan->persyaratan }}</p>
            </div>
        </div>

        @if(!$sudahDaftar)
        <div class="card">
            <div class="upload-section">
                <h3>📤 Upload CV dan Lamar Sekarang</h3>
                <p style="color: #92400e; margin-bottom: 1.5rem;">File CV harus berformat PDF dengan ukuran maksimal 2MB</p>
                
                <form action="{{ route('mahasiswa.lowongan.daftar', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="file-input">
                        <label for="cv" class="file-label">
                            <span id="file-name">📎 Klik untuk pilih file CV (PDF)</span>
                        </label>
                        <input type="file" name="cv" id="cv" accept=".pdf" required style="display: none;">
                        @error('cv')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim Lamaran</button>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('cv').addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || '📎 Klik untuk pilih file CV (PDF)';
                document.getElementById('file-name').textContent = '📎 ' + fileName;
            });
        </script>
        @endif
    </div>
</body>
</html>