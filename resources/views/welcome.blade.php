<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('{{ asset('images/kesehatan.jpg') }}');
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden; 
            animation: zoom-in-out 20s infinite;
        }
        
        @keyframes zoom-in-out {
            0% { background-size: 100% 100%; }
            50% { background-size: 110% 110%; }
            100% { background-size: 100% 100%; }
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, rgba(180, 234, 234, 0.5), rgba(80, 173, 168, 0.5), rgba(75, 232, 224, 0.5), rgba(19, 169, 169, 0.5));
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            z-index: -1;
        }
        
        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .header-logos {
            position: absolute;
            top: 25px;
            left: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-logos img {
            height: 80px;
            width: auto;
        }

        .main-content {
            text-align: center;
            color: #333;
            /* MENAMBAH PADDING ATAS AGAR TURUN DARI LOGO */
            padding-top: 50px; 
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .main-content h1 {
            /* MENGECILKAN FONT SEDIKIT AGAR TIDAK TERLALU MENDESAK */
            font-size: 4.5rem; 
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            line-height: 1.2;
        }

        .main-content h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 2rem;
        }

        .menu-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        /* CSS KHUSUS UNTUK TOMBOL DOWNLOAD AGAR DI TENGAH */
        .menu-options .menu-item:nth-child(5) {
            grid-column: 1 / span 2; 
            max-width: 250px; 
            margin: 0 auto; 
        }

        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease-in-out;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            color: #333;
        }

        .menu-item:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .menu-icon {
            width: 70px;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            background-color: #20b2aa;
            border-radius: 50%;
        }

        /* Warna khusus untuk Download Data */
        .menu-options .menu-item:nth-child(5) .menu-icon {
            background-color: #20b2aa; /* Warna Hijau Muda */
        }
        
        .menu-icon i {
            color: #fff;
            font-size: 35px;
        }
        
        /* Media Query untuk Perangkat Mobile */
        @media (max-width: 640px) {
            .header-logos {
                top: 15px;
                left: 15px;
                gap: 10px;
            }

            .header-logos img {
                height: 50px;
            }

            .main-content {
                padding-left: 10px;
                padding-right: 10px;
                /* PADDING ATAS UNTUK MOBILE */
                padding-top: 80px; 
            }

            .main-content h1 {
                font-size: 6vw;
            }

            .main-content h2 {
                font-size: 3vw;
                margin-bottom: 1rem;
            }

            .menu-options {
                grid-template-columns: 1fr;
                gap: 15px;
                max-width: 300px;
            }
            /* Hilangkan centering khusus di mobile */
            .menu-options .menu-item:nth-child(5) {
                grid-column: 1 / span 1;
                max-width: none;
                margin: 0;
            }


            .menu-item {
                padding: 12px;
            }

            .menu-icon {
                width: 50px;
                height: 50px;
            }
            
            .menu-icon i {
                font-size: 25px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <div class="header-logos">
        <img src="{{ asset('images/Logo Batu.png') }}" alt="Logo Kota Batu" class="logo-kota-batu">
        <img src="{{ asset('images/Germas.png') }}" alt="Logo Germas" class="logo-germas">
    </div>

    <div class="main-content">
        <h1>VERIFIKASI DATA BALITA</h1>
        <h2>DINKES</h2>
        <div class="menu-options">
            <a href="{{ route('balitas.search') }}" class="menu-item">
                <div class="menu-icon">
                    <i class="fas fa-search"></i>
                </div>
                <span>Cari Balita</span>
            </a>
            <a href="{{ route('balitas.index') }}" class="menu-item">
                <div class="menu-icon">
                    <i class="fas fa-list-ul"></i>
                </div>
                <span>Tampilkan Data</span>
            </a>
            <a href="{{ route('balitas.create') }}" class="menu-item">
                <div class="menu-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <span>Tambah Balita</span>
            </a>
            <a href="{{ route('balitas.status') }}" class="menu-item">
                <div class="menu-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <span>Status Balita</span>
            </a>
            {{-- TOMBOL DOWNLOAD DIBUAT SATU BARIS PENUH DAN DI TENGAH --}}
            <a href="{{ route('balitas.download.filter') }}" class="menu-item">
                <div class="menu-icon">
                    <i class="fas fa-file-download"></i>
                </div>
                <span>Download Data</span>
            </a>
        </div>
    </div>
</body>
</html>