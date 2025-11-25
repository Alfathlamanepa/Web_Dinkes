<!DOCTYPE html>
<html>
<head>
    <title>Data Balita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(-45deg, #008080, #4BCFCA, #87D9D6, #99E600);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            padding: 2rem;
        }

        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        .age-status-within {
            color: #22c55e;
            font-weight: bold;
        }
        .age-status-over {
            color: #ef4444;
            font-weight: bold;
        }
        .age-status-approaching {
            color: #f59e0b;
            font-weight: bold;
        }

        /* Penyesuaian untuk header */
        .header-container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 100%;
            margin-bottom: 2rem;
        }

        .header-title {
            text-align: center;
            font-size: 2.25rem;
            font-weight: 700;
            color: #1a202c;
        }

        .home-button {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background-color: #008080;
            color: white;
            padding: 0.75rem;
            border-radius: 9999px;
            transition: transform 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .home-button:hover {
            transform: translateY(-50%) scale(1.1);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 90%;
            max-width: 400px;
            text-align: center;
            animation-name: animatetop;
            animation-duration: 0.4s;
        }
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }
        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Perbaikan untuk Tampilan Mobile */
        .card-list {
            display: none;
        }
        .table-responsive {
            overflow-x: auto;
        }
        
        .custom-dropdown-container {
            position: relative;
            width: 100%;
        }
        
        .custom-dropdown-button {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            border: 2px solid #d1d5db;
            background-color: white;
            cursor: pointer;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease-in-out;
        }
        
        .custom-dropdown-button:hover {
            border-color: #008080;
        }
        
        .custom-dropdown-options {
            position: absolute;
            width: 100%;
            z-index: 10;
            background-color: white;
            border-radius: 0.75rem;
            border: 2px solid #d1d5db;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
            top: 100%; /* Posisi di bawah tombol */
            left: 0;
            display: none; /* Sembunyikan secara default */
        }

        .custom-dropdown-options.show {
            display: block; /* Tampilkan ketika active */
        }
        
        .custom-dropdown-option {
            padding: 0.5rem 1rem;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .custom-dropdown-option:hover {
            background-color: #f0f0f0;
        }
        
        .hidden-native-select {
            display: none;
        }

        @media (max-width: 640px) {
            body {
                padding: 1rem;
            }

            .header-title {
                font-size: 1.5rem;
            }

            .header-container {
                margin-bottom: 1rem;
            }

            .home-button {
                padding: 0.5rem;
                right: 5px;
            }

            .overflow-x-auto {
                display: none; /* Sembunyikan tabel di mobile */
            }

            .card-list {
                display: block; /* Tampilkan card list di mobile */
            }

            .card {
                background-color: white;
                border-radius: 0.75rem;
                padding: 1rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 1rem;
            }
            .card p {
                font-size: 0.9rem;
            }
            .card .action-buttons {
                margin-top: 1rem;
            }
            
            #filter-form .grid {
                display: block;
            }
            #filter-form .grid > div {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body class="p-8">
    <div class="max-w-7xl mx-auto space-y-8">
        <div class="header-container">
            <h1 class="header-title">Data Balita</h1>
            <a href="{{ url('/') }}" class="home-button" title="Kembali ke Beranda">
                <i class="fas fa-home"></i>
            </a>
        </div>
        
        <div class="bg-white p-8 rounded-xl shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Informasi Balita</h2>
                <button id="filter-toggle" class="bg-teal-600 text-white font-semibold px-6 py-3 rounded-full hover:bg-teal-700 transition-colors duration-200">
                    <i class="fas fa-filter mr-2"></i> Filter Data
                </button>
            </div>
            
            <form id="filter-form" action="{{ route('balitas.index') }}" method="GET" class="hidden mb-6 p-4 rounded-xl" style="background-color: #f0f2f5;">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="kec_custom" class="block text-sm font-semibold text-gray-700">Kecamatan</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="kec" name="kec" value="{{ request('kec') }}">
                            <div class="custom-dropdown-button" id="kec_button">
                                <span id="kec_label">{{ request('kec') ?? 'Semua Kecamatan' }}</span>
                                <i class="fas fa-chevron-down ml-2"></i>
                            </div>
                            <div class="custom-dropdown-options" id="kec_options">
                                <div class="custom-dropdown-option" data-value="">Semua Kecamatan</div>
                                <div class="custom-dropdown-option" data-value="BATU">BATU</div>
                                <div class="custom-dropdown-option" data-value="JUNREJO">JUNREJO</div>
                                <div class="custom-dropdown-option" data-value="BUMIAJI">BUMIAJI</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="puskesmas_custom" class="block text-sm font-semibold text-gray-700">Puskesmas</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="puskesmas" name="puskesmas" value="{{ request('puskesmas') }}">
                            <div class="custom-dropdown-button" id="puskesmas_button">
                                <span id="puskesmas_label">{{ request('puskesmas') ?? 'Semua Puskesmas' }}</span>
                                <i class="fas fa-chevron-down ml-2"></i>
                            </div>
                            <div class="custom-dropdown-options" id="puskesmas_options">
                                <div class="custom-dropdown-option" data-value="">Semua Puskesmas</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="desa_kel_custom" class="block text-sm font-semibold text-gray-700">Desa/Kel</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="desa_kel" name="desa_kel" value="{{ request('desa_kel') }}">
                            <div class="custom-dropdown-button" id="desa_kel_button">
                                <span id="desa_kel_label">{{ request('desa_kel') ?? 'Semua Desa/Kelurahan' }}</span>
                                <i class="fas fa-chevron-down ml-2"></i>
                            </div>
                            <div class="custom-dropdown-options" id="desa_kel_options">
                                <div class="custom-dropdown-option" data-value="">Semua Desa/Kelurahan</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-lime-600 text-white font-bold px-6 py-2 rounded-xl hover:bg-lime-700 transition-colors duration-200">Terapkan Filter</button>
                </div>
            </form>
            
            {{-- Modal Konfirmasi Hapus --}}
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <div class="p-4 text-center">
                        <i class="fas fa-trash-alt text-red-500 text-5xl mb-4"></i>
                        <p class="text-xl text-gray-800 font-semibold mb-2">Konfirmasi Hapus</p>
                        <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus data balita ini?</p>
                        <div class="flex justify-center space-x-4">
                            <form id="delete-form-modal" method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="page" value="{{ $balitas->currentPage() }}">
                                <button type="submit" class="bg-red-600 text-white font-bold px-6 py-2 rounded-xl hover:bg-red-700 transition-colors duration-200">
                                    Ya, Hapus
                                </button>
                            </form>
                            <button id="cancel-delete-btn" class="bg-gray-400 text-white font-bold px-6 py-2 rounded-xl hover:bg-gray-500 transition-colors duration-200">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @if ($balitas->isEmpty())
                <p class="text-center text-gray-600">Belum ada data balita.</p>
            @else
                <div class="overflow-x-auto hidden sm:block">
                    <table class="min-w-full rounded-xl overflow-hidden">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">Nama</th>
                                <th class="py-3 px-6 text-left">NIK</th>
                                <th class="py-3 px-6 text-left">Tanggal Lahir</th>
                                <th class="py-3 px-6 text-center">Umur</th>
                                <th class="py-3 px-6 text-center">Status Umur</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($balitas as $balita)
                            <tr class="border-b border-gray-200 hover:bg-gray-50" id="balita-{{ $balita->nik_balita }}">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $balita->nama_balita }}</td>
                                <td class="py-3 px-6 text-left">{{ $balita->nik_balita }}</td>
                                <td class="py-3 px-6 text-left" data-tgl-lahir="{{ $balita->tgl_lahir }}">{{ $balita->tgl_lahir }}</td>
                                <td class="py-3 px-6 text-center age-display" data-tgl-lahir="{{ $balita->tgl_lahir }}"></td>
                                <td class="py-3 px-6 text-center age-status-display" data-tgl-lahir="{{ $balita->tgl_lahir }}"></td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-2">
                                        {{-- Tautan Lihat Detail --}}
                                        <a href="{{ route('balitas.show', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="text-gray-500 transform hover:text-purple-500 hover:scale-110">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- Tautan Edit --}}
                                        <a href="{{ route('balitas.edit', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="text-gray-500 transform hover:text-blue-500 hover:scale-110">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- Tombol Hapus - Diperbarui untuk memicu modal --}}
                                        <button type="button" class="text-gray-500 transform hover:text-red-500 hover:scale-110 delete-btn" data-nik="{{ $balita->nik_balita }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-list sm:hidden">
                    @foreach ($balitas as $balita)
                    <div class="card" id="balita-card-{{ $balita->nik_balita }}">
                        <h3 class="font-bold text-lg mb-2">{{ $balita->nama_balita }}</h3>
                        <p class="text-gray-600 mb-1">
                            <strong>NIK:</strong> {{ $balita->nik_balita }}
                        </p>
                        <p class="text-gray-600 mb-1">
                            <strong>Tanggal Lahir:</strong> {{ $balita->tgl_lahir }}
                        </p>
                        <p class="text-gray-600 mb-1">
                            <strong>Umur:</strong> <span class="age-display-mobile" data-tgl-lahir="{{ $balita->tgl_lahir }}"></span>
                        </p>
                        <p class="text-gray-600 mb-4">
                            <strong>Status:</strong> <span class="age-status-display-mobile" data-tgl-lahir="{{ $balita->tgl_lahir }}"></span>
                        </p>
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('balitas.show', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="text-gray-500 transform hover:text-purple-500 hover:scale-110">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('balitas.edit', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="text-gray-500 transform hover:text-blue-500 hover:scale-110">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" class="text-gray-500 transform hover:text-red-500 hover:scale-110 delete-btn" data-nik="{{ $balita->nik_balita }}">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-8 flex justify-center">
                    {{ $balitas->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data untuk dropdown filter
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
                    optionsDiv.classList.toggle('show');
                });

                optionsDiv.addEventListener('click', function(e) {
                    if (e.target.classList.contains('custom-dropdown-option')) {
                        const value = e.target.getAttribute('data-value');
                        const text = e.target.textContent;
                        hiddenInput.value = value;
                        labelSpan.textContent = text;
                        optionsDiv.classList.remove('show');
                        
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

                window.addEventListener('click', function() {
                    optionsDiv.classList.remove('show');
                });
            }

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
            
            // Logic to show/hide the filter form
            const filterToggleBtn = document.getElementById('filter-toggle');
            const filterForm = document.getElementById('filter-form');
            filterToggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                filterForm.classList.toggle('hidden');
            });
            
            // Age and Status calculation
            const ageStatusDisplayElements = document.querySelectorAll('.age-status-display, .age-status-display-mobile');
            const ageDisplayElements = document.querySelectorAll('.age-display, .age-display-mobile');

            ageStatusDisplayElements.forEach(function(element) {
                const tanggalLahir = element.dataset.tglLahir;
                if (!tanggalLahir) {
                    element.textContent = 'Data tidak ada';
                    return;
                }
                const birthDate = new Date(tanggalLahir);
                const today = new Date();
                const years = today.getFullYear() - birthDate.getFullYear();
                const months = today.getMonth() - birthDate.getMonth();
                const days = today.getDate() - birthDate.getDate();
                const totalMonths = years * 12 + months;
                const isOverAge = totalMonths > 59 || (totalMonths === 59 && days > 0);

                if (isOverAge) {
                    element.textContent = 'Sudah lewat';
                    element.classList.add('age-status-over');
                } else if (totalMonths >= 58) {
                    element.textContent = 'Mendekati batas';
                    element.classList.add('age-status-approaching');
                } else {
                    element.textContent = 'Dalam batas aman';
                    element.classList.add('age-status-within');
                }
            });

            ageDisplayElements.forEach(function(element) {
                const tanggalLahir = element.dataset.tglLahir;
                if (!tanggalLahir) {
                    element.textContent = 'Data tidak ada';
                    return;
                }
                const birthDate = new Date(tanggalLahir);
                const today = new Date();
                let years = today.getFullYear() - birthDate.getFullYear();
                let months = today.getMonth() - birthDate.getMonth();
                let days = today.getDate() - birthDate.getDate();

                if (days < 0) {
                    months--;
                    const lastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
                    days += lastMonth.getDate();
                }
                if (months < 0) {
                    years--;
                    months += 12;
                }
                const totalMonths = (years * 12) + months;
                element.textContent = `${totalMonths} bulan, ${days} hari`;
            });
            
            // Modal for delete confirmation
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

            // Scroll to last-edited balita
            const scrollToId = new URLSearchParams(window.location.search).get('scroll_to');
            if (scrollToId) {
                const targetElement = document.getElementById(`balita-${scrollToId}`);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    targetElement.style.transition = 'background-color 0.5s ease';
                    targetElement.style.backgroundColor = '#f0f9ff';
                    setTimeout(() => {
                        targetElement.style.backgroundColor = '';
                    }, 2000);
                }
            }
        });
    </script>
</body>
</html>