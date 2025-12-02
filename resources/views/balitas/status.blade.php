<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Usia Balita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #4bcfca; 
        }

        /* --- STYLES UNTUK MENIRU TAMPILAN APLIKASI DI GAMBAR --- */
        .app-container {
            width: 100%;
            max-width: 450px; 
            min-height: 100vh;
            /* Gradien Green-Teal-Cyan yang menyerupai gambar */
            background: linear-gradient(-45deg, #99E600, #87D9D6, #4BCFCA, #008080);
            background-size: 100% 200%;
            background-position: top;
            position: relative;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 0;
            /* REVISI: Tambahkan padding-bottom agar tombol Home yang tidak fixed tetap terlihat */
            padding-bottom: 30px; 
        }

        /* HEADER */
        .header-section {
            padding: 40px 20px 20px 20px; 
            position: relative;
        }
        
        /* LOGO HEADER (KIRI ATAS) */
        .header-icon-left {
            position: absolute;
            top: 25px; 
            left: 20px; 
            color: white;
            z-index: 20;
            display: flex; 
            align-items: center;
            gap: 5px;
        }
        
        /* TOMBOL KEMBALI (KANAN ATAS) */
        .header-icon-right {
            position: absolute;
            top: 25px; 
            right: 20px; 
            z-index: 20;
        }
        
        /* Aturan untuk gambar di dalam header-icon-left */
        .header-icon-left img {
            height: 40px; 
            width: auto;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        .header-content {
            padding-top: 20px;
            padding-bottom: 20px;
            text-align: center;
            color: white;
            font-size: 2rem;
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        /* FILTER CARD */
        .filter-card {
            background-color: white;
            border-radius: 1.5rem; 
            margin: 0 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        /* Dropdown Input Kapsul */
        .pill-dropdown-button {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 9999px; /* Kapsul */
            border: 1px solid #d1d5db;
            background-color: white;
            cursor: pointer;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
            font-size: 0.875rem; /* text-sm */
        }
        
        .pill-dropdown-button:hover {
            border-color: #4BCFCA;
        }

        .custom-dropdown-options {
            position: absolute;
            width: 100%;
            z-index: 10;
            background-color: white;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-height: 180px;
            overflow-y: auto;
            top: 100%;
            left: 0;
            display: none; 
            margin-top: 4px;
        }

        .custom-dropdown-options.show {
            display: block;
        }
        
        .custom-dropdown-option {
            padding: 0.5rem 1rem;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 0.875rem;
        }
        
        .custom-dropdown-option:hover {
            background-color: #f0f0f0;
        }
        
        /* Tombol Tampilkan */
        .btn-filter {
            background-color: #4BCFCA;
            color: white;
            font-weight: 700;
            border-radius: 9999px; /* Kapsul */
            padding: 0.5rem 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s;
        }

        /* RESULT CARDS */
        .result-card {
            padding: 1.25rem;
            border-radius: 1rem;
            border-width: 2px;
            transition: all 0.3s ease-in-out;
            margin-bottom: 1rem;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card-green {
            border-color: #10B981; /* green-500 */
        }

        .card-yellow {
            border-color: #FBBF24; /* yellow-400 */
        }

        .card-red {
            border-color: #EF4444; /* red-500 */
        }
        
        .result-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1F2937;
        }

        /* FOOTER HOME BUTTON - Diubah dari fixed ke static/flow */
        .footer-home {
            /* Hapus position: fixed, bottom, left, transform */
            z-index: 30;
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 0.5rem 0;
            margin-top: 1rem; /* Tambahkan margin atas agar tidak menempel kartu terakhir */
        }

        /* Gaya Tombol Home: Persegi Panjang Kecil */
        .home-button {
            background-color: white;
            padding: 0.5rem 1rem; 
            border-radius: 0.5rem; 
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            font-size: 1.5rem;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center">

    <div class="app-container">
        
        {{-- LOGO HEADER (KIRI ATAS) --}}
        <div class="header-icon-left">
            <img src="{{ asset('images/Logo Batu.png') }}" alt="Logo Kota Batu">
            <img src="{{ asset('images/Germas.png') }}" alt="Logo Germas">
        </div>
        
        {{-- TOMBOL KEMBALI (KANAN ATAS) --}}
        <div class="header-icon-right">
            <a href="{{ url('/') }}" class="bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center transition backdrop-blur-sm border border-white/30 custom-outer-shadow">
                <i class="fas fa-arrow-left text-xl"></i> 
            </a>
        </div>
        
        <div class="header-section">
            <h1 class="header-content">
                STATUS USIA
                <br>
                BALITA
            </h1>
        </div>

        {{-- FILTER CARD --}}
        <div class="filter-card relative z-10 -mt-8">
            <h2 class="text-base font-semibold text-gray-800 mb-4">Filter Data</h2>
            
            <form action="{{ route('balitas.status') }}" method="GET">
                <div class="grid grid-cols-3 gap-2">
                    {{-- Kecamatan --}}
                    <div>
                        <label for="kec" class="block text-xs font-medium text-gray-500 mb-1">Kecamatan</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="kec_val" name="kec" value="{{ request('kec') }}">
                            <div class="pill-dropdown-button" id="kec_button">
                                <span id="kec_label" class="truncate">{{ request('kec') ?? 'Semua Kecamatan' }}</span>
                                <i class="fas fa-chevron-down text-xs ml-1"></i>
                            </div>
                            <div class="custom-dropdown-options" id="kec_options">
                                <div class="custom-dropdown-option" data-value="">Semua Kecamatan</div>
                                <div class="custom-dropdown-option" data-value="BATU">BATU</div>
                                <div class="custom-dropdown-option" data-value="JUNREJO">JUNREJO</div>
                                <div class="custom-dropdown-option" data-value="BUMIAJI">BUMIAJI</div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Puskesmas --}}
                    <div>
                        <label for="puskesmas" class="block text-xs font-medium text-gray-500 mb-1">Puskesmas</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="puskesmas_val" name="puskesmas" value="{{ request('puskesmas') }}">
                            <div class="pill-dropdown-button" id="puskesmas_button">
                                <span id="puskesmas_label" class="truncate">{{ request('puskesmas') ?? 'Semua Puskesmas' }}</span>
                                <i class="fas fa-chevron-down text-xs ml-1"></i>
                            </div>
                            <div class="custom-dropdown-options" id="puskesmas_options">
                                <div class="custom-dropdown-option" data-value="">Semua Puskesmas</div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Desa/Kel --}}
                    <div>
                        <label for="desa_kel" class="block text-xs font-medium text-gray-500 mb-1">Desa/Kel</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="desa_kel_val" name="desa_kel" value="{{ request('desa_kel') }}">
                            <div class="pill-dropdown-button" id="desa_kel_button">
                                <span id="desa_kel_label" class="truncate">{{ request('desa_kel') ?? 'Semua Desa/Kelurahan' }}</span>
                                <i class="fas fa-chevron-down text-xs ml-1"></i>
                            </div>
                            <div class="custom-dropdown-options" id="desa_kel_options">
                                <div class="custom-dropdown-option" data-value="">Semua Desa/Kelurahan</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Tampilkan --}}
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="inline-flex items-center text-xs font-bold btn-filter">
                        <i class="fas fa-eye mr-2"></i> Tampilkan
                    </button>
                </div>
            </form>
        </div>

        {{-- RESULT CARDS --}}
        <div class="p-4 mt-6 space-y-4">
            {{-- Kartu 1: Usia bayi dalam batas aman (Bayi Sehat) --}}
            <a href="{{ route('balitas.status.show', ['status' => 'aman', 'kec' => request('kec'), 'puskesmas' => request('puskesmas'), 'desa_kel' => request('desa_kel')]) }}" class="block">
                <div class="result-card card-green">
                    <h2 class="result-title">Usia bayi dalam batas aman</h2>
                    <p class="text-sm text-gray-500 mt-1">USIA < 56 BULAN</p>
                    <div class="mt-2 text-right text-xs font-bold text-green-600">Total: {{ $aman }}</div>
                </div>
            </a>

            {{-- Kartu 2: Usia bayi diambang batas aman (Bayi Hampir Batas) --}}
            <a href="{{ route('balitas.status.show', ['status' => 'mendekati', 'kec' => request('kec'), 'puskesmas' => request('puskesmas'), 'desa_kel' => request('desa_kel')]) }}" class="block">
                <div class="result-card card-yellow">
                    <h2 class="result-title">Usia bayi diambang batas aman</h2>
                    <p class="text-sm text-gray-500 mt-1">USIA < 56 BULAN</p>
                    <div class="mt-2 text-right text-xs font-bold text-yellow-600">Total: {{ $mendekati }}</div>
                </div>
            </a>
            
            {{-- Kartu 3: Usia bayi melewati batas pengawasan (Bayi Lewat Batas) --}}
            <a href="{{ route('balitas.status.show', ['status' => 'lewat', 'kec' => request('kec'), 'puskesmas' => request('puskesmas'), 'desa_kel' => request('desa_kel')]) }}" class="block">
                <div class="result-card card-red">
                    <h2 class="result-title">Usia bayi melewati batas pengawasan</h2>
                    <p class="text-sm text-gray-500 mt-1">USIA < 56 BULAN</p>
                    <div class="mt-2 text-right text-xs font-bold text-red-600">Total: {{ $lewat ?? 0 }}</div>
                </div>
            </a>
            
            {{-- Pesan Tidak Ada Data (dipertahankan) --}}
            @if($aman === 0 && $mendekati === 0 && ($lewat ?? 0) === 0)
                <div class="text-center text-gray-500 font-semibold pt-4">Tidak ada data balita.</div>
            @endif
        </div>
        
        {{-- FOOTER HOME BUTTON - Dipindahkan ke dalam flow konten --}}
        <div class="footer-home">
            <a href="{{ url('/') }}" class="home-button text-teal-600 hover:text-teal-800 transition-colors duration-200">
                <i class="fas fa-home text-xl"></i>
            </a>
        </div>
        
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data untuk dropdown filter (TIDAK BERUBAH)
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

            const kecSelect = document.getElementById('kec_val');
            const kecButton = document.getElementById('kec_button');
            const kecOptions = document.getElementById('kec_options');
            const kecLabel = document.getElementById('kec_label');
            
            const puskesmasSelect = document.getElementById('puskesmas_val');
            const puskesmasButton = document.getElementById('puskesmas_button');
            const puskesmasOptions = document.getElementById('puskesmas_options');
            const puskesmasLabel = document.getElementById('puskesmas_label');

            const desaKelSelect = document.getElementById('desa_kel_val');
            const desaKelButton = document.getElementById('desa_kel_button');
            const desaKelOptions = document.getElementById('desa_kel_options');
            const desaKelLabel = document.getElementById('desa_kel_label');

            // Fungsi untuk mengisi custom dropdown
            function populateCustomDropdown(container, optionsData, placeholder, selectedValue) {
                const optionsDiv = container.querySelector('.custom-dropdown-options');
                const buttonSpan = container.querySelector('span');

                optionsDiv.innerHTML = `<div class="custom-dropdown-option" data-value="">${placeholder}</div>`;
                optionsData.forEach(option => {
                    optionsDiv.innerHTML += `<div class="custom-dropdown-option" data-value="${option}">${option}</div>`;
                });

                if (selectedValue && selectedValue !== '') {
                    buttonSpan.textContent = selectedValue;
                } else {
                    buttonSpan.textContent = placeholder;
                }
            }
            
            // Fungsi untuk menambahkan listener pada custom dropdown
            function addDropdownListeners(button, optionsDiv, hiddenInput, labelSpan, placeholder, dataMap) {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Tutup dropdown lain sebelum membuka ini
                    document.querySelectorAll('.custom-dropdown-options.show').forEach(openDiv => {
                        if (openDiv !== optionsDiv) {
                            openDiv.classList.remove('show');
                        }
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
                        
                        if (hiddenInput.id === 'kec_val') {
                            const kecValue = hiddenInput.value;
                            const puskesmasOptionsData = kecValue ? Object.keys(dataMap[kecValue]) : [];
                            populateCustomDropdown(document.getElementById('puskesmas_button').parentElement, puskesmasOptionsData, 'Semua Puskesmas', '');
                            puskesmasSelect.value = '';
                            
                            populateCustomDropdown(document.getElementById('desa_kel_button').parentElement, [], 'Semua Desa/Kelurahan', '');
                            desaKelSelect.value = '';
                        } else if (hiddenInput.id === 'puskesmas_val') {
                            const kecValue = kecSelect.value;
                            const puskesmasValue = hiddenInput.value;
                            const desaKelOptionsData = (kecValue && puskesmasValue && dataMap[kecValue] && dataMap[kecValue][puskesmasValue]) ? Object.keys(dataMap[kecValue][puskesmasValue]) : [];
                            populateCustomDropdown(document.getElementById('desa_kel_button').parentElement, desaKelOptionsData, 'Semua Desa/Kelurahan', '');
                            desaKelSelect.value = '';
                        }
                    }
                });

                window.addEventListener('click', function() {
                    optionsDiv.classList.remove('show');
                });
            }

            // Inisialisasi Dropdown
            const kecOptionsData = Object.keys(dataLokasi);
            const initialKecValue = kecSelect.value;
            populateCustomDropdown(kecButton.parentElement, kecOptionsData, 'Semua Kecamatan', initialKecValue);
            addDropdownListeners(kecButton, kecOptions, kecSelect, kecLabel, 'Semua Kecamatan', dataLokasi);

            if (initialKecValue) {
                const puskesmasOptionsData = Object.keys(dataLokasi[initialKecValue]);
                const initialPuskesmasValue = puskesmasSelect.value;
                populateCustomDropdown(puskesmasButton.parentElement, puskesmasOptionsData, 'Semua Puskesmas', initialPuskesmasValue);
                addDropdownListeners(puskesmasButton, puskesmasOptions, puskesmasSelect, puskesmasLabel, 'Semua Puskesmas', dataLokasi);

                if (initialPuskesmasValue) {
                    const desaKelOptionsData = Object.keys(dataLokasi[initialKecValue][initialPuskesmasValue]);
                    const initialDesaKelValue = desaKelSelect.value;
                    populateCustomDropdown(desaKelButton.parentElement, desaKelOptionsData, 'Semua Desa/Kelurahan', initialDesaKelValue);
                    addDropdownListeners(desaKelButton, desaKelOptions, desaKelSelect, desaKelLabel, 'Semua Desa/Kelurahan', dataLokasi);
                } else {
                     addDropdownListeners(desaKelButton, desaKelOptions, desaKelSelect, desaKelLabel, 'Semua Desa/Kelurahan', dataLokasi);
                }
            } else {
                addDropdownListeners(puskesmasButton, puskesmasOptions, puskesmasSelect, puskesmasLabel, 'Semua Puskesmas', dataLokasi);
                addDropdownListeners(desaKelButton, desaKelOptions, desaKelSelect, desaKelLabel, 'Semua Desa/Kelurahan', dataLokasi);
            }
        });
    </script>
</body>
</html>