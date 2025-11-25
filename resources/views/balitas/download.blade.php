<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Data Balita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(-45deg, #008080, #4BCFCA, #87D9D6, #99E600);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
        }

        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container-box {
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            background-color: white;
            transition: all 0.3s ease-in-out;
            transform: scale(0.95);
        }

        .container-box:hover {
            transform: scale(1);
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
            top: 100%; 
            left: 0;
            display: none;
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
        }
        
        .custom-dropdown-option:hover {
            background-color: #f0f0f0;
        }

        .btn-download {
            background-color: #99E600;
            color: #333;
            font-weight: bold;
            border-radius: 0.75rem;
            transition: transform 0.2s ease-in-out;
        }

        .btn-download:hover {
            transform: scale(1.05);
            background-color: #80c200;
        }
        
        .btn-filter-show {
            background-color: #008080;
            color: white;
            font-weight: bold;
            border-radius: 0.75rem;
            transition: transform 0.2s ease-in-out;
        }
        
        .btn-filter-show:hover {
            transform: scale(1.05);
            background-color: #0a4545ff;
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
        
        @media (max-width: 640px) {
            .overflow-x-auto {
                overflow-x: scroll;
            }
            table {
                width: 700px; 
            }
        }
    </style>
</head>
<body class="p-8 flex items-center justify-center min-h-screen">

    {{-- Pop-up Error --}}
    @if(session('error'))
        <div id="errorModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <div class="p-4 text-center">
                    <i class="fas fa-times-circle text-red-500 text-5xl mb-4"></i>
                    <p class="text-xl text-red-600 font-semibold mb-2">Gagal!</p>
                    <p class="text-gray-500">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white p-8 rounded-xl shadow-2xl max-w-7xl w-full container-box">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Download Data Balita (CSV)</h1>
        
        <form id="filter-form" action="{{ route('balitas.download.filter') }}" method="GET" class="mb-8 p-6 rounded-3xl shadow-inner" style="background-color: #F8F9FA;">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Filter Data</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="kec" class="block text-sm font-semibold text-gray-700">Kecamatan</label>
                    <div class="custom-dropdown-container">
                        <input type="hidden" id="kec_val" name="kec" value="{{ request('kec') }}">
                        <div class="custom-dropdown-button" id="kec_button">
                            <span id="kec_label">{{ request('kec') ?? 'Semua Kecamatan' }}</span>
                            <i class="fas fa-chevron-down"></i>
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
                    <label for="puskesmas" class="block text-sm font-semibold text-gray-700">Puskesmas</label>
                    <div class="custom-dropdown-container">
                        <input type="hidden" id="puskesmas_val" name="puskesmas" value="{{ request('puskesmas') }}">
                        <div class="custom-dropdown-button" id="puskesmas_button">
                            <span id="puskesmas_label">{{ request('puskesmas') ?? 'Semua Puskesmas' }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="custom-dropdown-options" id="puskesmas_options">
                            <div class="custom-dropdown-option" data-value="">Semua Puskesmas</div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="desa_kel" class="block text-sm font-semibold text-gray-700">Desa/Kel</label>
                    <div class="custom-dropdown-container">
                        <input type="hidden" id="desa_kel_val" name="desa_kel" value="{{ request('desa_kel') }}">
                        <div class="custom-dropdown-button" id="desa_kel_button">
                            <span id="desa_kel_label">{{ request('desa_kel') ?? 'Semua Desa/Kelurahan' }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="custom-dropdown-options" id="desa_kel_options">
                            <div class="custom-dropdown-option" data-value="">Semua Desa/Kelurahan</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end">
                <input type="hidden" name="filter" value="1">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg btn-filter-show">
                    <i class="fas fa-eye mr-2"></i> Tampilkan Data
                </button>
            </div>
        </form>
        
        {{-- AREA PRATINJAU DATA --}}
        @if ($balitas->count() > 0)
            <div class="p-6 bg-gray-50 rounded-xl shadow-inner mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Pratinjau Hasil Filter ({{ $balitas->count() }} Data)</h3>
                    {{-- Tombol Download yang muncul setelah filter diterapkan --}}
                    <a href="{{ route('balitas.download.csv', request()->query()) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-xl shadow-lg btn-download">
                        <i class="fas fa-file-download mr-2"></i> Unduh CSV
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full rounded-xl overflow-hidden">
                        <thead class="bg-gray-200 text-gray-700 uppercase text-xs leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">NIK Balita</th>
                                <th class="py-3 px-6 text-left">Nama</th>
                                <th class="py-3 px-6 text-left">Tgl Lahir</th>
                                <th class="py-3 px-6 text-left">Kecamatan</th>
                                <th class="py-3 px-6 text-left">Puskesmas</th>
                                <th class="py-3 px-6 text-left">Desa/Kel</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light bg-white">
                            @foreach ($balitas as $balita)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $balita->nik_balita }}</td>
                                <td class="py-3 px-6 text-left">{{ $balita->nama_balita }}</td>
                                <td class="py-3 px-6 text-left">{{ $balita->tgl_lahir }}</td>
                                <td class="py-3 px-6 text-left">{{ $balita->kec }}</td>
                                <td class="py-3 px-6 text-left">{{ $balita->puskesmas }}</td>
                                <td class="py-3 px-6 text-left">{{ $balita->desa_kel }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif (request()->has('filter'))
             <div class="text-center text-gray-500 font-semibold mt-8 p-6 bg-red-50 rounded-lg">
                Tidak ada data balita yang ditemukan berdasarkan filter.
            </div>
        @endif
        
        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="inline-block bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-700 transition duration-200">Kembali ke Menu Utama</a>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Logika untuk menampilkan modal error
            const errorModal = document.getElementById('errorModal');
            if (errorModal) {
                errorModal.style.display = 'flex';
                const closeBtn = errorModal.querySelector('.close-btn');
                closeBtn.onclick = () => errorModal.style.display = 'none';
                window.onclick = (event) => {
                    if (event.target == errorModal) {
                        errorModal.style.display = 'none';
                    }
                };
            }

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

            function populateCustomDropdown(container, optionsData, placeholder, selectedValue) {
                const optionsDiv = container.querySelector('.custom-dropdown-options');
                const buttonSpan = container.querySelector('span');
                const hiddenInput = container.querySelector('input[type="hidden"]');

                optionsDiv.innerHTML = `<div class="custom-dropdown-option" data-value="">${placeholder}</div>`;
                optionsData.forEach(option => {
                    optionsDiv.innerHTML += `<div class="custom-dropdown-option" data-value="${option}">${option}</div>`;
                });
                
                // Set label berdasarkan nilai yang ada di input hidden
                const currentLabel = selectedValue || placeholder;
                buttonSpan.textContent = currentLabel;
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
                        
                        if (hiddenInput.id === 'kec_val') {
                            const kecValue = hiddenInput.value;
                            const puskesmasOptionsData = kecValue ? Object.keys(dataMap[kecValue]) : [];
                            
                            // Reset Puskesmas
                            populateCustomDropdown(document.getElementById('puskesmas_button').parentElement, puskesmasOptionsData, 'Semua Puskesmas', '');
                            puskesmasSelect.value = '';

                            // Reset Desa/Kel
                            populateCustomDropdown(document.getElementById('desa_kel_button').parentElement, [], 'Semua Desa/Kelurahan', '');
                            desaKelSelect.value = '';
                        } else if (hiddenInput.id === 'puskesmas_val') {
                            const kecValue = kecSelect.value;
                            const puskesmasValue = hiddenInput.value;
                            const desaKelOptionsData = (kecValue && puskesmasValue && dataMap[kecValue] && dataMap[kecValue][puskesmasValue]) ? Object.keys(dataMap[kecValue][puskesmasValue]) : [];
                            
                            // Reset Desa/Kel
                            populateCustomDropdown(document.getElementById('desa_kel_button').parentElement, desaKelOptionsData, 'Semua Desa/Kelurahan', '');
                            desaKelSelect.value = '';
                        }
                    }
                });

                window.addEventListener('click', function() {
                    optionsDiv.classList.remove('show');
                });
            }
            
            // Logika inisialisasi dropdown untuk memuat nilai dari URL
            function initializeDropdowns() {
                const urlParams = new URLSearchParams(window.location.search);
                
                const oldKec = urlParams.get('kec');
                const oldPuskesmas = urlParams.get('puskesmas');
                const oldDesaKel = urlParams.get('desa_kel');

                // 1. Inisialisasi Kecamatan
                const kecOptionsData = Object.keys(dataLokasi);
                kecSelect.value = oldKec || ''; // Set nilai hidden input
                populateCustomDropdown(kecButton.parentElement, kecOptionsData, 'Semua Kecamatan', oldKec);
                addDropdownListeners(kecButton, kecOptions, kecSelect, kecLabel, 'Semua Kecamatan', dataLokasi);

                // 2. Inisialisasi Puskesmas
                let puskesmasOptionsData = [];
                if (oldKec && dataLokasi[oldKec]) {
                    puskesmasOptionsData = Object.keys(dataLokasi[oldKec]);
                }
                puskesmasSelect.value = oldPuskesmas || ''; // Set nilai hidden input
                populateCustomDropdown(puskesmasButton.parentElement, puskesmasOptionsData, 'Semua Puskesmas', oldPuskesmas);
                addDropdownListeners(puskesmasButton, puskesmasOptions, puskesmasSelect, puskesmasLabel, 'Semua Puskesmas', dataLokasi);

                // 3. Inisialisasi Desa/Kelurahan
                let desaOptions = [];
                if (oldKec && oldPuskesmas && dataLokasi[oldKec] && dataLokasi[oldKec][oldPuskesmas]) {
                    desaOptions = Object.keys(dataLokasi[oldKec][oldPuskesmas]);
                }
                desaKelSelect.value = oldDesaKel || ''; // Set nilai hidden input
                populateCustomDropdown(desaKelButton.parentElement, desaOptions, 'Semua Desa/Kelurahan', oldDesaKel);
                addDropdownListeners(desaKelButton, desaKelOptions, desaKelSelect, desaKelLabel, 'Semua Desa/Kelurahan', dataLokasi);
            }

            initializeDropdowns();
            
        });
    </script>
</body>
</html>