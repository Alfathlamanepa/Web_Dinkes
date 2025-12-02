<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Balita - {{ $balita->nama_balita }}</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- FontAwesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* --- GAYA KONSISTEN (Background, Font, Shadows) --- */
        body {
            font-family: 'Inter', sans-serif;
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

        /* Page Title (PERBAIKAN POSISI) */
        .page-title {
            text-align: center;
            padding-top: 120px; /* Tambahkan padding agar turun dibawah logo */
            margin-bottom: 2rem;
            position: relative;
            z-index: 10;
        }
        .page-title h1 {
            font-size: 2.5rem;
            font-weight: 900;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.1;
        }

        /* Main Card Container */
        .detail-card {
            background-color: white;
            border-radius: 2rem;
            padding: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 800px;
            position: relative;
            z-index: 10;
            margin: 0 auto 50px auto; /* Margin auto agar tengah, hapus margin-top: 100px */
        }

        /* --- CUSTOM SHADOWS --- */
        /* Outer Shadow (Timbul - untuk tombol) */
        .custom-outer-shadow {
            box-shadow: 4px 4px 10px -2px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }
        .custom-outer-shadow:active {
            box-shadow: 2px 2px 5px -1px rgba(0, 0, 0, 0.2);
            transform: scale(0.99);
        }

        /* Inner Shadow (Tenggelam - untuk data capsule) */
        .data-capsule {
            background-color: #e5e7eb; /* Warna abu-abu terang seperti input */
            border-radius: 0.75rem; /* Rounded-xl */
            padding: 0.75rem 1rem;
            box-shadow: inset 0px 3px 5px 0px rgba(0, 0, 0, 0.1); 
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .data-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6b7280; /* Gray-500 */
            margin-bottom: 0.1rem;
            text-transform: uppercase;
        }
        
        .data-value {
            font-size: 1rem;
            font-weight: 800;
            color: #1f2937; /* Gray-800 */
        }

        /* Sub-cards (Umur & Lokasi) */
        .sub-card {
            background-color: #f9fafb; /* Gray-50 */
            border-radius: 1.5rem;
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
        }

        /* Responsive Mobile */
        @media (max-width: 640px) {
            .header-logos { top: 15px; left: 15px; gap: 10px; }
            .header-logos img { height: 40px; }
            .back-container { top: 15px; right: 15px; }
            
            /* Padding khusus mobile agar pas di bawah logo kecil */
            .page-title { padding-top: 80px; } 
            .page-title h1 { font-size: 1.8rem; }
            
            .detail-card { padding: 1.5rem; border-radius: 1.5rem; width: 95%; }
        }
    </style>
</head>
<body>

    {{-- LOGO HEADER (Kiri Atas) --}}
    <div class="header-logos">
        <img src="{{ asset('images/Logo Batu.png') }}" alt="Logo Kota Batu">
        <img src="{{ asset('images/Germas.png') }}" alt="Logo Germas">
    </div>

    {{-- TOMBOL KEMBALI (Kanan Atas) --}}
    <div class="back-container">
        <a href="{{ request()->query('from') == 'search' ? route('balitas.search', ['nik_balita' => $balita->nik_balita]) : route('balitas.index', ['page' => request()->query('page')]) }}" 
           class="bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center transition backdrop-blur-sm border border-white/30 custom-outer-shadow">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="w-full">
        
        <div class="page-title">
            <h1>DETAIL DATA<br>BALITA</h1>
        </div>

        @if ($balita)
        <div class="detail-card animate-fade-in-up">
            
            {{-- BAGIAN 1: IDENTITAS UTAMA (Gaya Kapsul Tenggelam) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                {{-- NIK Balita --}}
                <div class="data-capsule">
                    <span class="data-label">NIK Balita :</span>
                    <span class="data-value break-all">{{ $balita->nik_balita }}</span>
                </div>
                {{-- Nama Balita --}}
                <div class="data-capsule">
                    <span class="data-label">Nama Balita :</span>
                    <span class="data-value uppercase">{{ $balita->nama_balita }}</span>
                </div>
                {{-- Jenis Kelamin --}}
                 <div class="data-capsule">
                    <span class="data-label">Jenis Kelamin :</span>
                    <span class="data-value">{{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
                {{-- Tanggal Lahir --}}
                <div class="data-capsule">
                    <span class="data-label">Tanggal Lahir :</span>
                    <span class="data-value">{{ \Carbon\Carbon::parse($balita->tgl_lahir)->format('d F Y') }}</span>
                </div>
                 {{-- Nama Ortu --}}
                 <div class="data-capsule">
                    <span class="data-label">Nama Ortu :</span>
                    <span class="data-value uppercase">{{ $balita->nama_ortu }}</span>
                </div>
                {{-- NIK Ortu --}}
                <div class="data-capsule">
                    <span class="data-label">NIK Ortu :</span>
                    <span class="data-value break-all">{{ $balita->nik_ortu ?? '-' }}</span>
                </div>
                 {{-- No HP Ortu --}}
                 <div class="data-capsule">
                    <span class="data-label">No. HP Ortu :</span>
                    <span class="data-value">{{ $balita->hp_ortu ?? '-' }}</span>
                </div>
                {{-- Nomor KK --}}
                <div class="data-capsule">
                    <span class="data-label">Nomor KK :</span>
                    <span class="data-value break-all">{{ $balita->nomor_kk ?? '-' }}</span>
                </div>
            </div>

            {{-- INFO TERAKHIR DIEDIT --}}
            <div class="data-capsule mb-6 text-center py-2">
                <span class="text-xs font-bold text-gray-500">
                    Terakhir Diedit : {{ $balita->updated_at ? $balita->updated_at->format('d-m-Y H:i:s') : '-' }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {{-- BAGIAN 2: UMUR BALITA --}}
                <div class="sub-card">
                    <h3 class="font-black text-gray-700 text-lg mb-3 flex items-center">
                        <i class="fas fa-calendar-alt mr-2 text-[#009688]"></i> Umur Balita
                    </h3>
                    
                    {{-- Banner Umur --}}
                    <div id="umur-badge" class="rounded-full py-3 px-4 text-center custom-outer-shadow mb-3 transition-colors duration-500">
                        <span id="realtime-umur" data-tgl-lahir="{{ $balita->tgl_lahir }}" class="text-white font-black text-xl">
                            <i class="fas fa-spinner fa-spin animate-pulse text-sm"></i> Menghitung...
                        </span>
                    </div>
                    
                    {{-- Status Umur --}}
                    <p id="age-status" class="text-center text-sm font-bold">
                        Status...
                    </p>
                </div>

                {{-- BAGIAN 3: LOKASI --}}
                <div class="sub-card">
                    <h3 class="font-black text-gray-700 text-lg mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-[#009688]"></i> Lokasi
                    </h3>
                    <div class="space-y-2 text-sm font-bold text-gray-600">
                        <p><span class="text-gray-400 w-24 inline-block">RT/RW:</span> {{ $balita->rt ?? '-' }}/{{ $balita->rw ?? '-' }}</p>
                        <p><span class="text-gray-400 w-24 inline-block">Desa/Kel:</span> {{ $balita->desa_kel }}</p>
                        <p><span class="text-gray-400 w-24 inline-block">Kecamatan:</span> {{ $balita->kec }}</p>
                        <p><span class="text-gray-400 w-24 inline-block">Puskesmas:</span> {{ $balita->puskesmas }}</p>
                        <p><span class="text-gray-400 w-24 inline-block">Posyandu:</span> {{ $balita->posyandu }}</p>
                        <p><span class="text-gray-400 w-24 inline-block">Kab/Kota:</span> {{ $balita->kab_kota }}</p>
                        <p><span class="text-gray-400 w-24 inline-block">Provinsi:</span> {{ $balita->provinsi }}</p>
                    </div>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-200">
                <a href="{{ route('balitas.edit', ['balita' => $balita->nik_balita, 'from' => request('from'), 'page' => request('page')]) }}" 
                   class="flex-1 bg-[#009688] hover:bg-[#00796b] text-white font-black py-3 px-4 rounded-xl custom-outer-shadow transition text-center flex items-center justify-center uppercase tracking-wider text-sm sm:text-base">
                    <i class="fas fa-edit mr-2"></i> Edit Data
                </a>
                
                <button type="button" id="delete-button" 
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white font-black py-3 px-4 rounded-xl custom-outer-shadow transition text-center flex items-center justify-center uppercase tracking-wider text-sm sm:text-base">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Data
                </button>
            </div>

        </div>
        @else
            <div class="detail-card text-center py-10">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-5xl mb-4"></i>
                <h2 class="text-2xl font-bold text-gray-700">Data tidak ditemukan</h2>
            </div>
        @endif
    </div>

    {{-- MODAL HAPUS --}}
    <div id="deleteModal" class="modal">
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl animate-fade-in-up m-4">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-100 mb-6">
                <i class="fas fa-trash-alt text-red-500 text-4xl"></i>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Hapus Data Balita?</h3>
            <p class="text-gray-500 mb-6 text-sm">
                Anda yakin ingin menghapus data balita <strong>{{ $balita->nama_balita }}</strong>? Tindakan ini tidak dapat dibatalkan.
            </p>
            
            <div class="flex flex-col gap-3">
                <form id="delete-form-modal" method="POST" action="{{ route('balitas.destroy', $balita->nik_balita) }}" class="w-full">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="page" value="{{ request('page') }}">
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl custom-outer-shadow transition">
                        Ya, Hapus Permanen
                    </button>
                </form>
                <button id="cancel-delete-btn" class="w-full bg-gray-200 text-gray-700 font-bold py-3 rounded-xl hover:bg-gray-300 transition custom-outer-shadow">
                    Batal
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT (LOGIKA STATUS & UMUR) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Elemen HTML ---
            const realtimeUmurElement = document.getElementById('realtime-umur');
            const ageStatusElement = document.getElementById('age-status');
            const umurBadge = document.getElementById('umur-badge'); 
            
            // Pengecekan elemen
            if (realtimeUmurElement && ageStatusElement && umurBadge) {
                const tglLahir = realtimeUmurElement.getAttribute('data-tgl-lahir');
                const birthDate = new Date(tglLahir);
                
                if (!isNaN(birthDate.getTime())) {
                    const calculateAge = () => {
                        const today = new Date();
                        
                        // 1. Hitung Selisih
                        let birthYear = birthDate.getFullYear();
                        let birthMonth = birthDate.getMonth();
                        let birthDay = birthDate.getDate();

                        let currentYear = today.getFullYear();
                        let currentMonth = today.getMonth();
                        let currentDay = today.getDate();

                        let totalMonths = (currentYear - birthYear) * 12 + (currentMonth - birthMonth);

                        if (currentDay < birthDay) {
                            totalMonths--;
                        }

                        let diffDays = currentDay - birthDay;
                        if (diffDays < 0) {
                            let daysInLastMonth = new Date(currentYear, currentMonth, 0).getDate();
                            diffDays = daysInLastMonth + diffDays;
                        }
                        
                        // 2. Tampilkan Teks
                        realtimeUmurElement.innerHTML = `${totalMonths} Bulan, ${diffDays} Hari`;
            
                        // 3. Logika Warna (Reset)
                        umurBadge.className = 'rounded-full py-3 px-4 text-center custom-outer-shadow mb-3 transition-colors duration-500';
                        ageStatusElement.className = 'text-center text-sm font-bold';

                        // --- ATURAN ---
                        if (totalMonths >= 60) {
                            // LEWAT BATAS (>= 60) -> MERAH
                            umurBadge.classList.add('bg-red-500');
                            ageStatusElement.textContent = 'Usia balita sudah lewat dari batas aman (≥ 60 bulan).';
                            ageStatusElement.classList.add('text-red-600');

                        } else if (totalMonths >= 58) { 
                            // HAMPIR BATAS (58-59) -> KUNING
                            umurBadge.classList.add('bg-yellow-400'); 
                            ageStatusElement.textContent = 'Hati-hati! Usia balita mendekati batas aman (58-59 bulan).';
                            ageStatusElement.classList.add('text-yellow-600');

                        } else {
                            // AMAN (< 58) -> HIJAU TEAL
                            umurBadge.classList.add('bg-[#4BCFCA]');
                            ageStatusElement.textContent = 'Usia Balita masih dalam batas aman.';
                            ageStatusElement.classList.add('text-[#009688]');
                        }
                    };
                    
                    calculateAge();
                } else {
                    realtimeUmurElement.innerHTML = 'Tanggal Lahir Invalid';
                }
            }

            // --- Modal Hapus ---
            const deleteModal = document.getElementById('deleteModal');
            const deleteButton = document.getElementById('delete-button');
            const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
            
            if (deleteButton && deleteModal && cancelDeleteBtn) {
                deleteButton.addEventListener('click', function() { deleteModal.style.display = 'flex'; });
                cancelDeleteBtn.addEventListener('click', function() { deleteModal.style.display = 'none'; });
                window.onclick = function(event) {
                    if (event.target == deleteModal) { deleteModal.style.display = 'none'; }
                };
            }
        });
    </script>
</body>
</html>