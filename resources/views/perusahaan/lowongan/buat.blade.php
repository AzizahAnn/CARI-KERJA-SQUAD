<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Lowongan - Own Your Career</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 1rem 2rem; }
        .navbar h1 { font-size: 1.5rem; }
        .container { max-width: 800px; margin: 2rem auto; padding: 0 20px; }
        .card { background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; color: #333; font-weight: 600; margin-bottom: 0.5rem; }
        label span { color: #ef4444; }
        input, textarea, select { width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; font-family: inherit; }
        textarea { min-height: 120px; resize: vertical; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #10b981; }
        .error-text { color: #ef4444; font-size: 0.85rem; margin-top: 0.5rem; }
        .btn-group { display: flex; gap: 10px; margin-top: 2rem; }
        .btn { padding: 14px 30px; border-radius: 10px; font-size: 1.1rem; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; text-align: center; }
        .btn-primary { background: #10b981; color: white; border: none; }
        .btn-secondary { background: #6b7280; color: white; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>➕ Buat Lowongan Baru</h1>
    </nav>

    <div class="container">
        <div class="card">
            <form action="{{ route('perusahaan.lowongan.simpan') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="posisi">Posisi <span>*</span></label>
                    <input type="text" name="posisi" id="posisi" value="{{ old('posisi') }}" placeholder="Contoh: Backend Developer" required>
                    @error('posisi')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="tipe">Tipe Lowongan <span>*</span></label>
                    <select name="tipe" id="tipe" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="magang" {{ old('tipe') == 'magang' ? 'selected' : '' }}>Magang</option>
                        <option value="kerja" {{ old('tipe') == 'kerja' ? 'selected' : '' }}>Kerja</option>
                    </select>
                    @error('tipe')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi <span>*</span></label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Jakarta Selatan" required>
                    @error('lokasi')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="batas_akhir">Batas Akhir Pendaftaran <span>*</span></label>
                    <input type="date" name="batas_akhir" id="batas_akhir" value="{{ old('batas_akhir') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    @error('batas_akhir')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Pekerjaan <span>*</span></label>
                    <textarea name="deskripsi" id="deskripsi" placeholder="Jelaskan detail pekerjaan..." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="persyaratan">Persyaratan <span>*</span></label>
                    <textarea name="persyaratan" id="persyaratan" placeholder="Tuliskan persyaratan yang dibutuhkan..." required>{{ old('persyaratan') }}</textarea>
                    @error('persyaratan')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Simpan Lowongan</button>
                    <a href="{{ route('perusahaan.lowongan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>