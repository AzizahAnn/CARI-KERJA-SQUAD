<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - Own Your Career</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Palet Warna: #192338 (Oxford Blue), #31487A (YinMn Blue), #8FB3E2 (Jordy Blue), #D9E1F1 (Lavender) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Gradien biru gelap baru */
            background: linear-gradient(135deg, #31487A 0%, #192338 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .register-container {
            background: white;
            border-radius: 15px; /* Sedikit dikecilkan agar lebih modern */
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 0 auto;
        }
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .register-header .icon {
            font-size: 3.5rem; /* Ukuran ikon disesuaikan */
            margin-bottom: 0.5rem;
            color: #31487A; /* Warna ikon YinMn Blue */
        }
        .register-header h2 {
            color: #192338; /* Oxford Blue */
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .register-header p {
            color: #606C7B; /* Warna abu-abu yang lebih tenang */
        }
        .alert {
            padding: 12px 20px;
            border-radius: 8px; /* Disesuaikan */
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        .alert-error {
            background: #fecaca; /* Warna error merah baru */
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            color: #192338; /* Warna label lebih gelap */
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        label span {
            color: #ef4444;
        }
        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px; /* Disesuaikan */
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        textarea {
            min-height: 80px;
            resize: vertical;
        }
        input:focus,
        textarea:focus {
            outline: none;
            border-color: #8FB3E2; /* Jordy Blue untuk fokus */
            box-shadow: 0 0 0 3px rgba(143, 179, 226, 0.4); /* Shadow biru transparan */
        }
        .error-text {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
        .btn {
            width: 100%;
            padding: 14px;
            /* Gradien tombol menggunakan warna palet biru */
            background: linear-gradient(135deg, #8FB3E2 0%, #31487A 100%);
            color: white;
            border: none;
            border-radius: 8px; /* Disesuaikan */
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(49, 72, 122, 0.3); /* Shadow dari YinMn Blue */
            opacity: 0.9;
        }
        .links {
            text-align: center;
            margin-top: 1.5rem;
        }
        .links p, .links a {
            color: #31487A; /* Warna link YinMn Blue */
            text-decoration: none;
            font-weight: 500;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="icon"><i class="fa-solid fa-user-graduate"></i></div>
            <h2>Daftar Mahasiswa</h2>
            <p>Mulai perjalanan kariermu</p>
        </div>

        <?php if(session('error')): ?>
        <div class="alert alert-error">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('mahasiswa.daftar')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap <span>*</span></label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo e(old('nama_lengkap')); ?>" required>
                <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nim">NIM <span>*</span></label>
                    <input type="text" name="nim" id="nim" value="<?php echo e(old('nim')); ?>" required>
                    <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="jurusan">Jurusan <span>*</span></label>
                    <input type="text" name="jurusan" id="jurusan" value="<?php echo e(old('jurusan')); ?>" required>
                    <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email <span>*</span></label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password <span>*</span></label>
                    <input type="password" name="password" id="password" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password <span>*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <label for="no_telp">Nomor Telepon <span>*</span></label>
                <input type="tel" name="no_telp" id="no_telp" value="<?php echo e(old('no_telp')); ?>" placeholder="08xxxxxxxxxx" required>
                <?php $__errorArgs = ['no_telp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat (Opsional)</label>
                <textarea name="alamat" id="alamat" placeholder="Alamat lengkap Anda..."><?php echo e(old('alamat')); ?></textarea>
                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn">Daftar Sekarang</button>
        </form>

        <div class="links">
            <p>Sudah punya akun? <a href="<?php echo e(route('mahasiswa.masuk')); ?>">Masuk di sini</a></p>
            <a href="<?php echo e(route('pilih.peran')); ?>"><i class="fa-solid fa-arrow-left"></i> Kembali ke Pilih Peran</a>
        </div>
    </div>
</body>
</html><?php /**PATH D:\MYLARAVEL\project_saya\resources\views/auth/daftar/mahasiswa.blade.php ENDPATH**/ ?>