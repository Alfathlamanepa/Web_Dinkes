<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Balita - Verifikasi Data</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- FontAwesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* --- GAYA KONSISTEN DENGAN EDIT PAGE --- */
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            position: relative;
            background: linear-gradient(-45deg, #008080, #4BCFCA, #87D9D6, #99E600);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            padding: 1rem;
        }

        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        
        /* Header Logos */
        .header-logos {
            position: absolute;
            top: 25px;
            left: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 20;
        }
        .header-logos img {
            height: 80px;
            width: auto;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        /* Back Button Container */
        .back-container {
            position: absolute;
            top: 25px;
            right: 25px;
            z-index: 20;
        }

        /* Main Content */
        .main-content {
            text-align: center;
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 600px;
            padding: 0 20px;
        }
        
        .main-content h1 {
            font-size: 3rem;
            font-weight: 900;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Card Styles */
        .search-card {
            background-color: white;
            border-radius: 2rem;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            text-align: left;
            min-height: 300px;
            display: flex;
            flex-direction: column;
        }

        /* --- SHADOW STYLES (KONSISTEN) --- */

        /* 1. INNER SHADOW (TENGGELAM) - Untuk Input & Data Fields */
        .custom-inner-shadow {
            background-color: #e5e7eb;
            border: none;
            box-shadow: inset 0px 4px 6px 0px rgba(0, 0, 0, 0.15); /* Shadow lebih halus mirip edit page */
            color: #374151;
            font-weight: bold;
            font-size: 1.1rem; /* Sedikit disesuaikan */
        }
        
        /* Khusus untuk input form agar ada interaksi */
        input.custom-inner-shadow:focus {
             box-shadow: inset 0px 4px 6px 0px rgba(0, 0, 0, 0.1), 0 0 0 2px #008080;
             outline: none;
             background-color: #f3f4f6;
        }
        input.custom-inner-shadow::placeholder {
            color: #9ca3af;
            font-size: 1rem;
            text-align: left;
            font-weight: normal;
        }

        /* 2. OUTER SHADOW (TIMBUL) - Untuk Semua Tombol */
        .custom-outer-shadow {
            box-shadow: 6px 6px 15px -3px rgba(0, 0, 0, 0.3);
            transition: all 0.2s ease;
        }
        .custom-outer-shadow:active {
            box-shadow: 2px 2px 5px -1px rgba(0, 0, 0, 0.3);
            transform: scale(0.98);
        }

        /* Instruction Text Alignment */
        .instruction-container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: left;
            text-align: left;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .header-logos { top: 15px; left: 15px; gap: 10px; }
            .header-logos img { height: 40px; }
            .back-container { top: 15px; right: 15px; }
            .main-content { padding-top: 60px; }
            .main-content h1 { font-size: 2rem; margin-bottom: 1.5rem; }
            .search-card { padding: 1.5rem; border-radius: 1.5rem; }
        }
    </style>
</head>
<body>
    
    {{-- LOGO HEADER --}}
    <div class="header-logos">
        <img src="{{ asset('images/Logo Batu.png') }}" alt="Logo Kota Batu">
        <img src="{{ asset('images/Germas.png') }}" alt="Logo Germas">
    </div>

    {{-- TOMBOL KEMBALI (Updated Style) --}}
    <div class="back-container">
        <a href="{{ url('/') }}" class="bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center transition backdrop-blur-sm border border-white/30 custom-outer-shadow">
            <i class="fas fa-arrow-left text-xl"></i> 
        </a>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="main-content">
        
        <h1>CARI BALITA</h1>

        <div class="search-card relative">
            
            {{-- FORM PENCARIAN --}}
            <form action="{{ route('balitas.search') }}" method="GET">
                <div class="flex gap-4 mb-4 items-center">
                    
                    {{-- INPUT FIELD (Inner Shadow) --}}
                    <input type="text" id="nik_input" name="nik_balita" 
                        placeholder="" 
                        class="custom-inner-shadow w-full rounded-[2rem] px-6 py-4 transition text-center" 
                        value="{{ request('nik_balita') }}">
                    
                    {{-- TOMBOL CARI (Outer Shadow) --}}
                    <button type="submit" class="bg-[#009688] hover:bg-[#00796b] text-white font-black px-8 py-4 rounded-[2rem] custom-outer-shadow flex items-center justify-center uppercase tracking-wider text-lg">
                        CARI
                    </button>

                </div>
            </form>

            {{-- INSTRUKSI AWAL --}}
            @if(!$balita)
            <div class="instruction-container">
                <p class="text-gray-400 font-bold text-lg leading-relaxed">
                    Silahkan masukkan NIK<br>Balita untuk memulai<br>pencarian
                </p>
            </div>
            @endif

            {{-- HASIL PENCARIAN --}}
            @if(request('nik_balita') && $balita)
                <div class="mt-2 animate-fade-in-up">
                    <h2 class="text-center font-bold text-gray-700 mb-2 text-lg">Hasil Pencarian</h2>
                    
                    {{-- KARTU HASIL --}}
                    <div class="border-2 border-green-500 rounded-3xl p-5 shadow-sm relative">
                        
                        {{-- Header --}}
                        <div class="flex items-center gap-4 mb-5">
                            <div class="bg-[#009688] text-white rounded-full min-w-[3rem] h-12 w-12 flex items-center justify-center text-xl shadow-md">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h3 class="text-2xl font-black text-gray-800 uppercase truncate">{{ $balita->nama_balita }}</h3>
                                <p class="text-sm text-gray-500 font-bold">NIK:{{ $balita->nik_balita }}</p>
                            </div>
                        </div>

                        {{-- Data Grid (Menggunakan Inner Shadow) --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                            {{-- Nama Ortu --}}
                            <div class="custom-inner-shadow rounded-xl p-3 flex flex-col justify-center text-left">
                                <span class="font-bold text-gray-500 text-xs mb-1">Nama Ortu:</span>
                                <span class="font-bold text-gray-800 uppercase text-sm">{{ $balita->nama_ortu }}</span>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="custom-inner-shadow rounded-xl p-3 flex flex-col justify-center text-left">
                                <span class="font-bold text-gray-500 text-xs mb-1">Tanggal Lahir:</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $balita->tgl_lahir }}</span>
                            </div>

                            {{-- Alamat --}}
                            <div class="custom-inner-shadow rounded-xl p-3 sm:col-span-2 flex flex-col justify-center text-left">
                                <span class="font-bold text-gray-500 text-xs mb-1">Alamat:</span>
                                <span class="font-bold text-gray-800 uppercase text-sm">{{ $balita->provinsi }}, {{ $balita->kab_kota }}, {{ $balita->kec }}, {{ $balita->desa_kel }}</span>
                            </div>
                        </div>

                        {{-- Tombol Aksi (Menggunakan Outer Shadow) --}}
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('balitas.show', ['balita' => $balita->nik_balita, 'from' => 'search']) }}" class="bg-[#009688] hover:bg-[#00796b] text-white font-bold text-xs sm:text-sm py-2 px-4 rounded-xl custom-outer-shadow transition transform hover:-translate-y-1">
                                Lihat Detail
                            </a>
                            <a href="{{ route('balitas.edit', $balita->nik_balita) }}" class="bg-[#009688] hover:bg-[#00796b] text-white font-bold text-xs sm:text-sm py-2 px-4 rounded-xl custom-outer-shadow transition transform hover:-translate-y-1">
                                Edit Data Balita
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- MODAL NOT FOUND --}}
    <div id="notFoundModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all w-full max-w-sm p-6">
                    <div class="text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 mb-4">
                            <i class="fas fa-times text-red-500 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 mb-2">Data Tidak Ditemukan</h3>
                        <p class="text-gray-500 text-sm mb-6">
                            NIK yang Anda masukkan tidak terdaftar dalam sistem.
                        </p>
                        <div class="flex flex-col gap-3">
                            {{-- Tombol Modal (Outer Shadow) --}}
                            <a href="{{ route('balitas.create') }}" class="w-full bg-teal-600 text-white font-bold py-3 rounded-xl custom-outer-shadow hover:bg-teal-700 transition text-center">
                                <i class="fas fa-plus mr-2"></i> Tambah Data Baru
                            </a>
                            <button class="close-btn w-full bg-gray-100 text-gray-700 font-bold py-3 rounded-xl custom-outer-shadow hover:bg-gray-200 transition">
                                Coba Cari Lagi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nikInput = document.getElementById('nik_input');
            const notFoundModal = document.getElementById('notFoundModal');
            const closeBtn = document.querySelector('.close-btn');
    
            // Hanya angka
            if (nikInput) {
                nikInput.addEventListener('input', function(event) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }

            // Logic Modal Not Found
            @if(request('nik_balita') && !$balita)
                notFoundModal.classList.remove('hidden');
            @endif

            // Close Modal Logic
            if (closeBtn) {
                closeBtn.onclick = function() {
                    notFoundModal.classList.add('hidden');
                    if(nikInput) {
                        nikInput.value = ''; 
                        nikInput.focus();
                    }
                }
            }
    
            // Klik backdrop tutup modal
            window.onclick = function(event) {
                if (event.target.classList.contains('backdrop-blur-sm')) {
                    notFoundModal.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>