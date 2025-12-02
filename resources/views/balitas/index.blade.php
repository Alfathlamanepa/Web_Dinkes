<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Balita</title>
    
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

        /* Home/Back Button Container */
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

        /* Main Card Container */
        .index-card {
            background-color: white;
            border-radius: 2rem;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 1200px; /* Lebih lebar untuk tabel */
            margin: 0 auto 50px auto;
            position: relative;
            z-index: 10;
        }

        /* --- SHADOWS --- */
        .custom-outer-shadow {
            box-shadow: 4px 4px 10px -2px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }
        .custom-outer-shadow:active {
            box-shadow: 2px 2px 5px -1px rgba(0, 0, 0, 0.2);
            transform: scale(0.99);
        }

        /* Filter Section Styles (Mirip Gambar) */
        .filter-box {
            background-color: #f3f4f6; /* Gray-100 */
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            margin-bottom: 2rem;
        }

        /* Dropdown Style */
        .custom-dropdown-container {
            position: relative;
        }
        .custom-dropdown-button {
            background-color: #e5e7eb; /* Gray-200, sedikit lebih gelap dari bg filter */
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
        .custom-dropdown-button:hover {
            background-color: #d1d5db;
        }
        .custom-dropdown-options {
            position: absolute;
            top: 110%;
            left: 0;
            width: 100%;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 50;
            display: none;
            max-height: 250px;
            overflow-y: auto;
            padding: 0.5rem;
        }
        .custom-dropdown-options.show { display: block; }
        .custom-dropdown-option {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.1s;
        }
        .custom-dropdown-option:hover { background-color: #f3f4f6; }

        /* Age Status Colors */
        .status-aman { color: #009688; font-weight: 800; }
        .status-warning { color: #eab308; font-weight: 800; }
        .status-danger { color: #ef4444; font-weight: 800; }

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

        /* Responsive */
        @media (max-width: 640px) {
            .header-logos { top: 15px; left: 15px; gap: 10px; }
            .header-logos img { height: 40px; }
            .back-container { top: 15px; right: 15px; }
            .page-title { padding-top: 80px; }
            .page-title h1 { font-size: 2rem; }
            .index-card { padding: 1.5rem; border-radius: 1.5rem; width: 95%; }
            .filter-box { padding: 1.5rem; }
            
            /* Hide Table on Mobile */
            .table-container { display: none; }
            .card-list { display: block; }
        }
        @media (min-width: 641px) {
            .card-list { display: none; }
            .table-container { display: block; }
        }
    </style>
</head>
<body>

    {{-- LOGO HEADER --}}
    <div class="header-logos">
        <img src="{{ asset('images/Logo Batu.png') }}" alt="Logo Kota Batu">
        <img src="{{ asset('images/Germas.png') }}" alt="Logo Germas">
    </div>

    {{-- TOMBOL HOME --}}
    <div class="back-container">
        <a href="{{ url('/') }}" class="bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center transition backdrop-blur-sm border border-white/30 custom-outer-shadow">
            <i class="fas fa-home text-xl"></i>
        </a>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="w-full">
        
        <div class="page-title">
            <h1>DATA BALITA</h1>
        </div>

        <div class="index-card animate-fade-in-up">
            
            {{-- BAGIAN FILTER (Sesuai Gambar) --}}
            <form action="{{ route('balitas.index') }}" method="GET" class="filter-box relative">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Filter Data</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    {{-- Kecamatan --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kecamatan</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="kec" name="kec" value="{{ request('kec') }}">
                            <div class="custom-dropdown-button" id="kec_button">
                                <span id="kec_label">{{ request('kec') ?? 'Semua Kecamatan' }}</span>
                                <i class="fas fa-chevron-down text-gray-500"></i>
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
                        <label class="block text-sm font-bold text-gray-700 mb-2">Puskesmas</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="puskesmas" name="puskesmas" value="{{ request('puskesmas') }}">
                            <div class="custom-dropdown-button" id="puskesmas_button">
                                <span id="puskesmas_label">{{ request('puskesmas') ?? 'Semua Puskesmas' }}</span>
                                <i class="fas fa-chevron-down text-gray-500"></i>
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
                                <span id="desa_kel_label">{{ request('desa_kel') ?? 'Semua Desa/Kelurahan' }}</span>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </div>
                            <div class="custom-dropdown-options" id="desa_kel_options">
                                <div class="custom-dropdown-option" data-value="">Semua Desa/Kelurahan</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Tampilkan (Pojok Kanan Bawah Filter) --}}
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#009688] hover:bg-[#00796b] text-white font-bold py-3 px-8 rounded-full custom-outer-shadow transition transform hover:-translate-y-1">
                        Tampilkan
                    </button>
                </div>
            </form>

            {{-- TOMBOL TAMBAH DATA (Di atas Tabel) --}}
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-700">Daftar Balita</h3>
                <a href="{{ route('balitas.create') }}" class="bg-[#009688] hover:bg-[#00796b] text-white font-bold py-3 px-6 rounded-xl custom-outer-shadow transition flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Data
                </a>
            </div>

            @if ($balitas->isEmpty())
                <div class="text-center py-10 bg-gray-50 rounded-xl border border-gray-200">
                    <i class="fas fa-box-open text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 font-bold">Belum ada data balita yang ditemukan.</p>
                </div>
            @else
                
                {{-- TABEL (DESKTOP) --}}
                <div class="table-container overflow-x-auto rounded-xl border border-gray-200">
                    <table class="min-w-full bg-white">
                        <thead class="bg-[#009688] text-white uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left rounded-tl-xl">Nama Balita</th>
                                <th class="py-3 px-6 text-left">NIK</th>
                                <th class="py-3 px-6 text-center">Tgl Lahir</th>
                                <th class="py-3 px-6 text-center">Umur</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center rounded-tr-xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-medium">
                            @foreach ($balitas as $balita)
                            <tr class="border-b border-gray-200 hover:bg-teal-50 transition" id="balita-{{ $balita->nik_balita }}">
                                <td class="py-3 px-6 text-left whitespace-nowrap font-bold text-gray-800 uppercase">{{ $balita->nama_balita }}</td>
                                <td class="py-3 px-6 text-left">{{ $balita->nik_balita }}</td>
                                <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($balita->tgl_lahir)->format('d-m-Y') }}</td>
                                <td class="py-3 px-6 text-center age-display" data-tgl-lahir="{{ $balita->tgl_lahir }}">
                                    </td>
                                <td class="py-3 px-6 text-center age-status-display" data-tgl-lahir="{{ $balita->tgl_lahir }}">
                                    </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-2">
                                        <a href="{{ route('balitas.show', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center hover:bg-purple-600 hover:text-white transition custom-outer-shadow" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('balitas.edit', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition custom-outer-shadow" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition custom-outer-shadow delete-btn" data-nik="{{ $balita->nik_balita }}" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- CARD LIST (MOBILE) --}}
                <div class="card-list space-y-4">
                    @foreach ($balitas as $balita)
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200 shadow-sm relative" id="balita-card-{{ $balita->nik_balita }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-black text-lg text-gray-800 uppercase">{{ $balita->nama_balita }}</h3>
                                <p class="text-xs text-gray-500 font-bold">NIK: {{ $balita->nik_balita }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                            <div class="bg-white p-2 rounded-lg">
                                <span class="block text-xs text-gray-400">Umur</span>
                                <span class="font-bold text-gray-700 age-display-mobile" data-tgl-lahir="{{ $balita->tgl_lahir }}">...</span>
                            </div>
                            <div class="bg-white p-2 rounded-lg">
                                <span class="block text-xs text-gray-400">Status</span>
                                <span class="font-bold age-status-display-mobile" data-tgl-lahir="{{ $balita->tgl_lahir }}">...</span>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 border-t pt-3">
                            <a href="{{ route('balitas.show', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="px-3 py-2 bg-purple-100 text-purple-700 rounded-lg text-sm font-bold hover:bg-purple-200">Detail</a>
                            <a href="{{ route('balitas.edit', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="px-3 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm font-bold hover:bg-blue-200">Edit</a>
                            <button class="px-3 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-bold hover:bg-red-200 delete-btn" data-nik="{{ $balita->nik_balita }}">Hapus</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                {{-- PAGINATION --}}
                <div class="mt-8">
                    {{ $balitas->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL KONFIRMASI HAPUS --}}
    <div id="deleteModal" class="modal">
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl animate-fade-in-up m-4">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-100 mb-6">
                <i class="fas fa-trash-alt text-red-500 text-4xl"></i>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Hapus Data?</h3>
            <p class="text-gray-500 mb-6 text-sm">Tindakan ini tidak dapat dibatalkan.</p>
            
            <div class="flex flex-col gap-3">
                <form id="delete-form-modal" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="page" value="{{ $balitas->currentPage() }}">
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl custom-outer-shadow transition">
                        Ya, Hapus
                    </button>
                </form>
                <button id="cancel-delete-btn" class="w-full bg-gray-200 text-gray-700 font-bold py-3 rounded-xl hover:bg-gray-300 transition custom-outer-shadow">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Dropdown Logic (Kecamatan, Puskesmas, Desa) ---
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

            const kecButton = document.getElementById('kec_button');
            const puskesmasButton = document.getElementById('puskesmas_button');
            const desaKelButton = document.getElementById('desa_kel_button');

            const kecOptionsDiv = document.getElementById('kec_options');
            const puskesmasOptionsDiv = document.getElementById('puskesmas_options');
            const desaKelOptionsDiv = document.getElementById('desa_kel_options');

            function populateCustomDropdown(optionsDiv, optionsData, placeholder, selectedValue) {
                optionsDiv.innerHTML = `<div class="custom-dropdown-option" data-value="">${placeholder}</div>`;
                optionsData.forEach(option => {
                    optionsDiv.innerHTML += `<div class="custom-dropdown-option" data-value="${option}">${option}</div>`;
                });
            }

            function addDropdownListeners(button, optionsDiv, hiddenInput, labelSpan, placeholder, dataMap) {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Close others
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
                            populateCustomDropdown(puskesmasOptionsDiv, puskesmasOptionsData, 'Semua Puskesmas', '');
                            document.getElementById('puskesmas').value = '';
                            document.getElementById('puskesmas_label').textContent = 'Semua Puskesmas';
                            
                            populateCustomDropdown(desaKelOptionsDiv, [], 'Semua Desa/Kelurahan', '');
                            document.getElementById('desa_kel').value = '';
                            document.getElementById('desa_kel_label').textContent = 'Semua Desa/Kelurahan';
                        } else if (hiddenInput.id === 'puskesmas') {
                            const kecValue = document.getElementById('kec').value;
                            const puskesmasValue = hiddenInput.value;
                            const desaKelOptionsData = (kecValue && puskesmasValue && dataMap[kecValue] && dataMap[kecValue][puskesmasValue]) ? Object.keys(dataMap[kecValue][puskesmasValue]) : [];
                            populateCustomDropdown(desaKelOptionsDiv, desaKelOptionsData, 'Semua Desa/Kelurahan', '');
                            document.getElementById('desa_kel').value = '';
                            document.getElementById('desa_kel_label').textContent = 'Semua Desa/Kelurahan';
                        }
                    }
                });
            }
            
            // Close dropdowns when clicking outside
            window.addEventListener('click', function() {
                document.querySelectorAll('.custom-dropdown-options').forEach(el => el.classList.remove('show'));
            });

            // Init Dropdowns
            const kecOptionsData = Object.keys(dataLokasi);
            populateCustomDropdown(kecOptionsDiv, kecOptionsData, 'Semua Kecamatan', '{{ request('kec') }}');
            addDropdownListeners(kecButton, kecOptionsDiv, kecSelect, document.getElementById('kec_label'), 'Semua Kecamatan', dataLokasi);

            if ('{{ request('kec') }}') {
                const puskesmasOptionsData = Object.keys(dataLokasi['{{ request('kec') }}']);
                populateCustomDropdown(puskesmasOptionsDiv, puskesmasOptionsData, 'Semua Puskesmas', '{{ request('puskesmas') }}');
                addDropdownListeners(puskesmasButton, puskesmasOptionsDiv, puskesmasSelect, document.getElementById('puskesmas_label'), 'Semua Puskesmas', dataLokasi);
                
                if ('{{ request('puskesmas') }}') {
                    const desaKelOptionsData = Object.keys(dataLokasi['{{ request('kec') }}']['{{ request('puskesmas') }}']);
                    populateCustomDropdown(desaKelOptionsDiv, desaKelOptionsData, 'Semua Desa/Kelurahan', '{{ request('desa_kel') }}');
                    addDropdownListeners(desaKelButton, desaKelOptionsDiv, desaKelSelect, document.getElementById('desa_kel_label'), 'Semua Desa/Kelurahan', dataLokasi);
                }
            } else {
                addDropdownListeners(puskesmasButton, puskesmasOptionsDiv, puskesmasSelect, document.getElementById('puskesmas_label'), 'Semua Puskesmas', dataLokasi);
                addDropdownListeners(desaKelButton, desaKelOptionsDiv, desaKelSelect, document.getElementById('desa_kel_label'), 'Semua Desa/Kelurahan', dataLokasi);
            }
            
            // --- Logic Umur & Status (Konsisten dengan Show) ---
            const ageStatusDisplayElements = document.querySelectorAll('.age-status-display, .age-status-display-mobile');
            const ageDisplayElements = document.querySelectorAll('.age-display, .age-display-mobile');

            function calculateMetrics(element, isStatus) {
                const tanggalLahir = element.dataset.tglLahir;
                if (!tanggalLahir) {
                    element.textContent = '-';
                    return;
                }
                const birthDate = new Date(tanggalLahir);
                const today = new Date();
                
                let birthYear = birthDate.getFullYear();
                let birthMonth = birthDate.getMonth();
                let birthDay = birthDate.getDate();

                let currentYear = today.getFullYear();
                let currentMonth = today.getMonth();
                let currentDay = today.getDate();

                // Hitung total bulan
                let totalMonths = (currentYear - birthYear) * 12 + (currentMonth - birthMonth);
                if (currentDay < birthDay) {
                    totalMonths--;
                }

                if (isStatus) {
                    // Logic Status
                    if (totalMonths >= 60) {
                        element.textContent = 'Lewat Batas';
                        element.classList.add('status-danger');
                    } else if (totalMonths >= 58) {
                        element.textContent = 'Mendekati';
                        element.classList.add('status-warning');
                    } else {
                        element.textContent = 'Aman';
                        element.classList.add('status-aman');
                    }
                } else {
                    // Logic Display Umur (Bulan, Hari)
                    let diffDays = currentDay - birthDay;
                    if (diffDays < 0) {
                        let daysInLastMonth = new Date(currentYear, currentMonth, 0).getDate();
                        diffDays = daysInLastMonth + diffDays;
                    }
                    element.textContent = `${totalMonths} Bln, ${diffDays} Hr`;
                }
            }

            ageDisplayElements.forEach(el => calculateMetrics(el, false));
            ageStatusDisplayElements.forEach(el => calculateMetrics(el, true));
            
            // --- Modal Hapus ---
            const deleteModal = document.getElementById('deleteModal');
            const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
            const deleteFormModal = document.getElementById('delete-form-modal');
            const deleteButtons = document.querySelectorAll('.delete-btn');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nik = this.getAttribute('data-nik');
                    const url = `{{ url('balitas') }}/${nik}`;
                    deleteFormModal.action = url;
                    deleteModal.style.display = 'flex';
                });
            });

            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.style.display = 'none';
            });

            window.onclick = function(event) {
                if (event.target == deleteModal) {
                    deleteModal.style.display = 'none';
                }
            };
        });
    </script>
</body>
</html>