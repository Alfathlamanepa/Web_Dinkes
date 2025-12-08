<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Usia Balita</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- FontAwesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* --- GAYA KONSISTEN (Sama dengan index.blade.php) --- */
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

        /* Page Title */
        .page-title {
            text-align: center;
            padding-top: 120px;
            margin-bottom: 2rem;
            position: relative;
            z-index: 10;
        }
        .page-title h1 {
            font-size: 3rem;
            font-weight: 900;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.1;
        }

        /* Main Card */
        .index-card {
            background-color: white;
            border-radius: 2rem;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 1000px; /* Sedikit lebih kecil dari index tabel agar fokus */
            margin: 0 auto 50px auto;
            position: relative;
            z-index: 10;
        }

        /* Shadows */
        .custom-outer-shadow {
            box-shadow: 4px 4px 10px -2px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }
        .custom-outer-shadow:active {
            box-shadow: 2px 2px 5px -1px rgba(0, 0, 0, 0.2);
            transform: scale(0.99);
        }

        /* Filter Box */
        .filter-box {
            background-color: #f3f4f6;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            margin-bottom: 2rem;
        }

        /* Custom Dropdown */
        .custom-dropdown-container { position: relative; }
        .custom-dropdown-button {
            background-color: #e5e7eb;
            border-radius: 1rem;
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            color: #374151;
            transition: background 0.2s;
        }
        .custom-dropdown-button:hover { background-color: #d1d5db; }
        .custom-dropdown-options {
            position: absolute;
            top: 110%; left: 0; width: 100%;
            background: white; border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 50; display: none;
            max-height: 250px; overflow-y: auto;
            padding: 0.5rem;
        }
        .custom-dropdown-options.show { display: block; }
        .custom-dropdown-option {
            padding: 0.5rem 1rem; border-radius: 0.5rem;
            cursor: pointer; transition: background 0.1s;
        }
        .custom-dropdown-option:hover { background-color: #f3f4f6; }

        /* Responsive */
        @media (max-width: 640px) {
            .header-logos { top: 15px; left: 15px; gap: 10px; }
            .header-logos img { height: 40px; }
            .back-container { top: 15px; right: 15px; }
            .page-title { padding-top: 80px; }
            .page-title h1 { font-size: 2rem; }
            .index-card { padding: 1.5rem; border-radius: 1.5rem; width: 95%; }
            .filter-box { padding: 1.25rem; }
        }
    </style>
</head>
<body>

    {{-- HEADER LOGOS --}}
    <div class="header-logos">
        <img src="{{ asset('images/Logo Batu.png') }}" alt="Logo Kota Batu">
        <img src="{{ asset('images/Germas.png') }}" alt="Logo Germas">
    </div>

    {{-- TOMBOL KEMBALI --}}
    <div class="back-container">
        <a href="{{ url('/') }}" class="bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center transition backdrop-blur-sm border border-white/30 custom-outer-shadow">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
    </div>

    {{-- KONTEN --}}
    <div class="w-full">
        
        <div class="page-title">
            <h1>STATUS USIA BALITA</h1>
        </div>

        <div class="index-card animate-fade-in-up">
            
            {{-- FILTER SECTION (Diambil dari index.blade.php) --}}
            <form action="{{ route('balitas.status') }}" method="GET" class="filter-box relative">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Filter Data</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
                    {{-- Kecamatan --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kecamatan</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="kec" name="kec" value="{{ request('kec') }}">
                            <div class="custom-dropdown-button" id="kec_button">
                                <span id="kec_label" class="truncate">{{ request('kec') ?? 'Semua Kecamatan' }}</span>
                                <i class="fas fa-chevron-down text-gray-500 ml-2"></i>
                            </div>
                            <div class="custom-dropdown-options" id="kec_options">
                                <div class="custom-dropdown-option" data-value="">Semua Kecamatan</div>
                            </div>
                        </div>
                    </div>

                    {{-- Puskesmas --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Puskesmas</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="puskesmas" name="puskesmas" value="{{ request('puskesmas') }}">
                            <div class="custom-dropdown-button" id="puskesmas_button">
                                <span id="puskesmas_label" class="truncate">{{ request('puskesmas') ?? 'Semua Puskesmas' }}</span>
                                <i class="fas fa-chevron-down text-gray-500 ml-2"></i>
                            </div>
                            <div class="custom-dropdown-options" id="puskesmas_options">
                                <div class="custom-dropdown-option" data-value="">Semua Puskesmas</div>
                            </div>
                        </div>
                    </div>

                    {{-- Desa/Kel --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Desa/Kel</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="desa_kel" name="desa_kel" value="{{ request('desa_kel') }}">
                            <div class="custom-dropdown-button" id="desa_kel_button">
                                <span id="desa_kel_label" class="truncate">{{ request('desa_kel') ?? 'Semua Desa/Kel' }}</span>
                                <i class="fas fa-chevron-down text-gray-500 ml-2"></i>
                            </div>
                            <div class="custom-dropdown-options" id="desa_kel_options">
                                <div class="custom-dropdown-option" data-value="">Semua Desa/Kel</div>
                            </div>
                        </div>
                    </div>

                    {{-- Posyandu --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Posyandu</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="posyandu" name="posyandu" value="{{ request('posyandu') }}">
                            <div class="custom-dropdown-button" id="posyandu_button">
                                <span id="posyandu_label" class="truncate">{{ request('posyandu') ?? 'Semua Posyandu' }}</span>
                                <i class="fas fa-chevron-down text-gray-500 ml-2"></i>
                            </div>
                            <div class="custom-dropdown-options" id="posyandu_options">
                                <div class="custom-dropdown-option" data-value="">Semua Posyandu</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Tampilkan --}}
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#009688] hover:bg-[#00796b] text-white font-bold py-3 px-8 rounded-full custom-outer-shadow transition transform hover:-translate-y-1 w-full sm:w-auto">
                        <i class="fas fa-filter mr-2"></i> Tampilkan
                    </button>
                </div>
            </form>

            {{-- CONTENT: STATUS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                
                {{-- Card Aman --}}
                <a href="{{ route('balitas.status.show', ['status' => 'aman', 'kec' => request('kec'), 'puskesmas' => request('puskesmas'), 'desa_kel' => request('desa_kel'), 'posyandu' => request('posyandu')]) }}" class="group block">
                    <div class="relative overflow-hidden bg-white border-2 border-green-500 rounded-2xl p-6 transition-all duration-300 transform group-hover:scale-105 group-hover:shadow-xl custom-outer-shadow">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-500 rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                        
                        <div class="flex items-center justify-between relative z-10">
                            <div>
                                <h2 class="text-2xl font-black text-gray-800 mb-1">BAYI SEHAT</h2>
                                <p class="text-green-600 font-bold bg-green-100 px-3 py-1 rounded-full inline-block text-sm">Aman</p>
                                <p class="text-gray-500 text-sm mt-2 font-medium">Usia < 58 bulan</p>
                            </div>
                            <div class="w-16 h-16 rounded-2xl bg-green-500 flex items-center justify-center text-white shadow-lg group-hover:bg-green-600 transition-colors">
                                <span class="text-2xl font-bold">{{ $aman }}</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                            <span class="text-green-600 font-bold text-sm flex items-center group-hover:underline">
                                Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                            </span>
                        </div>
                    </div>
                </a>

                {{-- Card Mendekati --}}
                <a href="{{ route('balitas.status.show', ['status' => 'mendekati', 'kec' => request('kec'), 'puskesmas' => request('puskesmas'), 'desa_kel' => request('desa_kel'), 'posyandu' => request('posyandu')]) }}" class="group block">
                    <div class="relative overflow-hidden bg-white border-2 border-yellow-400 rounded-2xl p-6 transition-all duration-300 transform group-hover:scale-105 group-hover:shadow-xl custom-outer-shadow">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-yellow-400 rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                        
                        <div class="flex items-center justify-between relative z-10">
                            <div>
                                <h2 class="text-2xl font-black text-gray-800 mb-1">HAMPIR BATAS</h2>
                                <p class="text-yellow-600 font-bold bg-yellow-100 px-3 py-1 rounded-full inline-block text-sm">Mendekati</p>
                                <p class="text-gray-500 text-sm mt-2 font-medium">Usia 58 - 59 bulan</p>
                            </div>
                            <div class="w-16 h-16 rounded-2xl bg-yellow-400 flex items-center justify-center text-white shadow-lg group-hover:bg-yellow-500 transition-colors">
                                <span class="text-2xl font-bold">{{ $mendekati }}</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                            <span class="text-yellow-600 font-bold text-sm flex items-center group-hover:underline">
                                Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            
            @if($aman === 0 && $mendekati === 0 && $lewat === 0)
                <div class="text-center py-10 mt-6 bg-gray-50 rounded-xl border border-gray-200">
                    <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 font-bold">Tidak ada data balita yang ditemukan dengan filter ini.</p>
                </div>
            @endif

        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- DATA LOKASI LENGKAP (Sama seperti index.blade.php) ---
            const dataLokasi = {
                "BATU": {
                    "BATU": {
                        "SONGGOKERTO": ["ARUMDALU 1", "ARUMDALU 2", "ANGGREK", "KENANGA", "TERATAI", "MAWAR 1", "MAWAR 2", "FLAMBOYAN"],
                        "PESANGGRAHAN": ["KELENGKENG 1", "KELENGKENG 2", "MAWAR", "ANGGREK", "GLADIOL", "SERUNI", "ELBRA", "BOUGENVILLE", "FLAMBOYAN", "LELY", "MELATI", "CEMPAKA", "TERATAI"],
                        "ORO-ORO OMBO": ["MELATI 1", "MELATI 2", "MELATI 3", "MELATI 4", "MELATI 5", "MELATI 6", "MELATI 7", "MELATI 8"],
                        "SUMBEREJO": ["ANGGREK 1", "ANGGREK 2", "ANGGREK 3", "ANGGREK 4", "ANGGREK 5", "ANGGREK 6"],
                        "NGAGLIK": ["AZZALEA 1", "AZZALEA 2", "AZZALEA 3", "AZZALEA 4", "AZZALEA 5", "AZZALEA 6", "AZZALEA 7", "AZZALEA 8", "AZZALEA 9", "AZZALEA 10", "AZZALEA 11", "AZZALEA 12", "AZZALEA 13", "AZZALEA 14", "AZZALEA 15"]
                    },
                    "SISIR": {
                        "SIDOMULYO": ["DAHLIA 1", "DAHLIA 2", "DAHLIA 3", "DAHLIA 4", "NUSA INDAH 1", "NUSA INDAH 2", "MAWAR 1", "MAWAR 2"],
                        "SISIR": ["ANGGREK BULAN 1", "ANGGREK BULAN 2", "ANGGREK BULAN 3", "ANGGREK BULAN 4", "ANGGREK BULAN 5", "ANGGREK BULAN 6", "ANGGREK BULAN 7", "ANGGREK BULAN 8", "ANGGREK BULAN 9", "ANGGREK BULAN 10", "ANGGREK BULAN 11", "ANGGREK BULAN 12", "ANGGREK BULAN 13", "ANGGREK BULAN 14", "ANGGREK BULAN 15", "ANGGREK BULAN 16", "ANGGREK BULAN 17", "ANGGREK BULAN 18", "ANGGREK BULAN 19", "ANGGREK BULAN 20", "ANGGREK BULAN 21", "ANGGREK BULAN 22"],
                        "TEMAS": ["NUSA INDAH", "NUSA INDAH 1", "NUSA INDAH 2", "NUSA INDAH 3", "NUSA INDAH 4", "NUSA INDAH 5", "NUSA INDAH 6", "NUSA INDAH 7", "NUSA INDAH 8", "NUSA INDAH 9"]
                    },
                    "BEJI": {
                        "BEJI": ["MAWAR MERAH", "MELATI 1", "MELATI 2", "MELATI 3", "DAHLIA", "KENANGA", "ANGGREK"],
                        "PENDEM": ["ANGGREK", "MELATI", "KENANGA 1", "KENANGA 2", "MAWAR", "KEMUNING", "BOUGENVILLE"],
                        "TORONGREJO": ["MAWAR PUTIH 1", "MAWAR PUTIH 2", "MAWAR KUNING", "MAWAR MERAH"]
                    }
                },
                "JUNREJO": {
                    "BEJI": {
                        "MOJOREJO": ["MAWAR", "MELATI", "ANGGREK", "DAHLIA", "MATAHARI", "FLAMBOYAN", "NUSA INDAH", "SAKURA"]
                    },
                    "JUNREJO": {
                        "TLEKUNG": ["MELATI", "ASALIA", "ANGGREK", "DAHLIA", "SAKURA"],
                        "JUNREJO": ["DAHLIA", "ANYELIR", "NUSA INDAH", "MATAHARI", "TERATAI", "CEMPAKA", "MAWAR", "MELATI", "KENANGA", "ANGGREK"],
                        "DADAPREJO": ["ANGGREK 1", "ANGGREK 2", "CEMPAKA", "DAHLIA", "TERATAI", "KEMUNING"]
                    }
                },
                "BUMIAJI": {
                    "BUMIAJI": {
                        "PUNTEN": ["MAWAR", "TERATAI", "MELATI", "ANGGREK", "ASALIA", "DAHLIA", "KENANGA"],
                        "BULUKERTO": ["MELATI", "KENANGA", "ANGGREK 1", "ANGGREK 2"],
                        "SUMBERGONDO": ["MANALAGI 1", "MANALAGI 2", "MANALAGI 3"],
                        "SUMBER BRANTAS": ["PEPAYA 1", "PEPAYA 2", "PEPAYA 3", "PEPAYA 4", "PEPAYA 5"],
                        "BUMIAJI": ["MAWAR 1", "MAWAR 2", "MAWAR 3", "MAWAR 4"],
                        "PANDAREJO": ["MELATI", "DAHLIA", "ANGGREK", "MAWAR"],
                        "GUNUNGSARI": ["ANYELIR 1", "ANYELIR 2", "ANYELIR 3", "ANYELIR 4", "ANYELIR 5", "ANYELIR 6", "ANYELIR 7", "ANYELIR 8", "ANYELIR 9"],
                        "TULUNGREJO": ["MANGGIS", "ANGGUR", "APEL", "JERUK", "SALAK", "DURIAN", "MANGGA", "LECY", "STRAWBERY 5", "STRAWBERY 6", "STRAWBERY 7", "STRAWBERY 8"],
                        "GIRIPURNO": ["ANGGREK", "MELATI PUTIH", "MELATI", "MAWAR", "FLAMBOYAN", "DAHLIA"]
                    }
                }
            };

            const kecSelect = document.getElementById('kec');
            const puskesmasSelect = document.getElementById('puskesmas');
            const desaKelSelect = document.getElementById('desa_kel');
            const posyanduSelect = document.getElementById('posyandu');

            const kecButton = document.getElementById('kec_button');
            const puskesmasButton = document.getElementById('puskesmas_button');
            const desaKelButton = document.getElementById('desa_kel_button');
            const posyanduButton = document.getElementById('posyandu_button');

            const kecOptionsDiv = document.getElementById('kec_options');
            const puskesmasOptionsDiv = document.getElementById('puskesmas_options');
            const desaKelOptionsDiv = document.getElementById('desa_kel_options');
            const posyanduOptionsDiv = document.getElementById('posyandu_options');

            function populateCustomDropdown(optionsDiv, optionsData, placeholder) {
                optionsDiv.innerHTML = `<div class="custom-dropdown-option" data-value="">${placeholder}</div>`;
                optionsData.forEach(option => {
                    optionsDiv.innerHTML += `<div class="custom-dropdown-option" data-value="${option}">${option}</div>`;
                });
            }

            function addDropdownListeners(button, optionsDiv, hiddenInput, labelSpan, placeholder, dataMap) {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    document.querySelectorAll('.custom-dropdown-options').forEach(el => {
                        if(el !== optionsDiv) el.classList.remove('show');
                    });
                    optionsDiv.classList.toggle('show');
                });

                optionsDiv.addEventListener('click', function(e) {
                    if (e.target.classList.contains('custom-dropdown-option')) {
                        const value = e.target.getAttribute('data-value');
                        const text = e.target.textContent;
                        hiddenInput.value = value;
                        labelSpan.textContent = text;
                        optionsDiv.classList.remove('show');
                        
                        // Cascade Logic
                        if (hiddenInput.id === 'kec') {
                            const kecValue = hiddenInput.value;
                            const puskesmasOptionsData = kecValue ? Object.keys(dataMap[kecValue]) : [];
                            populateCustomDropdown(puskesmasOptionsDiv, puskesmasOptionsData, 'Semua Puskesmas');
                            resetDropdown('puskesmas', 'Semua Puskesmas');
                            resetDropdown('desa_kel', 'Semua Desa/Kel');
                            resetDropdown('posyandu', 'Semua Posyandu');
                            
                        } else if (hiddenInput.id === 'puskesmas') {
                            const kecValue = document.getElementById('kec').value;
                            const puskesmasValue = hiddenInput.value;
                            const desaKelOptionsData = (kecValue && puskesmasValue && dataMap[kecValue] && dataMap[kecValue][puskesmasValue]) ? Object.keys(dataMap[kecValue][puskesmasValue]) : [];
                            populateCustomDropdown(desaKelOptionsDiv, desaKelOptionsData, 'Semua Desa/Kel');
                            resetDropdown('desa_kel', 'Semua Desa/Kel');
                            resetDropdown('posyandu', 'Semua Posyandu');
                            
                        } else if (hiddenInput.id === 'desa_kel') {
                             const kecValue = document.getElementById('kec').value;
                             const puskesmasValue = document.getElementById('puskesmas').value;
                             const desaValue = hiddenInput.value;
                             const posyanduOptionsData = (kecValue && puskesmasValue && desaValue && dataMap[kecValue][puskesmasValue][desaValue]) ? dataMap[kecValue][puskesmasValue][desaValue] : [];
                             populateCustomDropdown(posyanduOptionsDiv, posyanduOptionsData, 'Semua Posyandu');
                             resetDropdown('posyandu', 'Semua Posyandu');
                        }
                    }
                });
            }
            
            function resetDropdown(id, placeholder) {
                 document.getElementById(id).value = '';
                 document.getElementById(id + '_label').textContent = placeholder;
            }

            window.addEventListener('click', function() {
                document.querySelectorAll('.custom-dropdown-options').forEach(el => el.classList.remove('show'));
            });

            // Init Dropdowns
            const kecOptionsData = Object.keys(dataLokasi);
            populateCustomDropdown(kecOptionsDiv, kecOptionsData, 'Semua Kecamatan');
            addDropdownListeners(kecButton, kecOptionsDiv, kecSelect, document.getElementById('kec_label'), 'Semua Kecamatan', dataLokasi);
            
            // Re-populate if has request value (Logic Pemulihan State setelah submit)
            if ('{{ request('kec') }}') {
                const pkData = Object.keys(dataLokasi['{{ request('kec') }}']);
                populateCustomDropdown(puskesmasOptionsDiv, pkData, 'Semua Puskesmas');
                addDropdownListeners(puskesmasButton, puskesmasOptionsDiv, puskesmasSelect, document.getElementById('puskesmas_label'), 'Semua Puskesmas', dataLokasi);
                
                if ('{{ request('puskesmas') }}') {
                    const dkData = Object.keys(dataLokasi['{{ request('kec') }}']['{{ request('puskesmas') }}']);
                    populateCustomDropdown(desaKelOptionsDiv, dkData, 'Semua Desa/Kel');
                    addDropdownListeners(desaKelButton, desaKelOptionsDiv, desaKelSelect, document.getElementById('desa_kel_label'), 'Semua Desa/Kel', dataLokasi);
                    
                    if ('{{ request('desa_kel') }}') {
                         const posData = dataLokasi['{{ request('kec') }}']['{{ request('puskesmas') }}']['{{ request('desa_kel') }}'];
                         populateCustomDropdown(posyanduOptionsDiv, posData, 'Semua Posyandu');
                         addDropdownListeners(posyanduButton, posyanduOptionsDiv, posyanduSelect, document.getElementById('posyandu_label'), 'Semua Posyandu', dataLokasi);
                    }
                }
            } else {
                // Attach listeners even if empty
                addDropdownListeners(puskesmasButton, puskesmasOptionsDiv, puskesmasSelect, document.getElementById('puskesmas_label'), 'Semua Puskesmas', dataLokasi);
                addDropdownListeners(desaKelButton, desaKelOptionsDiv, desaKelSelect, document.getElementById('desa_kel_label'), 'Semua Desa/Kel', dataLokasi);
                addDropdownListeners(posyanduButton, posyanduOptionsDiv, posyanduSelect, document.getElementById('posyandu_label'), 'Semua Posyandu', dataLokasi);
            }
        });
    </script>
</body>
</html>