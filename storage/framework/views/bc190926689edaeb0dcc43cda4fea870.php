<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Own Your Career - Beranda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Palet Warna: #192338 (Oxford Blue), #31487A (YinMn Blue), #8FB3E2 (Jordy Blue) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Gradien biru gelap konsisten */
            background: linear-gradient(135deg, #31487A 0%, #192338 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            text-align: center;
            color: white;
            padding: 40px;
            max-width: 800px;
        }
        h1 {
            font-size: 3.8rem;
            margin-bottom: 1rem;
            font-weight: 800;
            text-shadow: 0 4px 10px rgba(0,0,0,0.5); /* Shadow yang lebih dalam */
            letter-spacing: 1px;
        }
        h1 i {
            /* Ikon Fa-Solid Fa-Wrench (Mengganti crosshairs ke wrench/briefcase agar lebih relevan ke career) */
            margin-right: 15px;
            color: #8FB3E2; /* Jordy Blue untuk ikon */
            transition: color 0.3s;
        }
        p {
            font-size: 1.4rem;
            margin-bottom: 3rem;
            opacity: 0.9;
            font-weight: 300;
        }
        .btn {
            display: inline-block;
            padding: 15px 45px;
            background: #8FB3E2; /* Jordy Blue untuk tombol */
            color: #192338; /* Oxford Blue untuk teks tombol */
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.25rem;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            text-transform: uppercase;
        }
        .btn:hover {
            transform: translateY(-5px);
            background: white; /* Putih pada hover agar kontras */
            color: #31487A;
            box-shadow: 0 18px 40px rgba(0,0,0,0.5);
        }
        .btn i {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fa-solid fa-briefcase"></i> Own Your Career</h1>
        <p>Platform Lowongan Magang & Kerja untuk Mahasiswa</p>
        <a href="<?php echo e(route('pilih.peran')); ?>" class="btn">
            Masuk Sekarang <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</body>
</html><?php /**PATH D:\MYLARAVEL\project_saya\resources\views/beranda.blade.php ENDPATH**/ ?>