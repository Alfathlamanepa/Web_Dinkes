<!DOCTYPE html>
<html>
<head>
    <title>Status Usia Balita</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Impor font dari Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        
        /* Gaya dasar body dengan gradien animasi */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(-45deg, #008080, #4BCFCA, #87D9D6, #99E600);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
        }

        /* Keyframes untuk animasi pergerakan gradien */
        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Gaya untuk kontainer filter dengan efek transisi */
        .filter-container {
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            background-color: white;
            transition: all 0.3s ease-in-out;
            transform: scale(0.95);
        }
        .filter-container:hover {
            transform: scale(1);
        }

        /* Gaya untuk input field dropdown kustom */
        .input-field {
            border-radius: 0.75rem;
            border-width: 2px;
            border-color: #d1d5db;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease-in-out;
            padding: 0.5rem 1rem;
            width: 100%;
            display: none; /* Sembunyikan select native */
        }
        
        .custom-dropdown-container { position: relative; width: 100%; }
        
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
        .custom-dropdown-button:hover { border-color: #008080; }
        
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
        .custom-dropdown-options.show { display: block; }
        .custom-dropdown-option {
            padding: 0.5rem 1rem;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .custom-dropdown-option:hover { background-color: #f0f0f0; }

        .input-field:focus {
            outline: none;
            border-color: #008080;
            box-shadow: 0 0 0 3px rgba(5, 111, 102, 0.5);
        }

        .btn-filter {
            background-color: #008080;
            color: white;
            font-weight: bold;
            border-radius: 0.75rem;
            transition: transform 0.2s ease-in-out;
        }
        .btn-filter:hover {
            transform: scale(1.05);
            background-color: #0a4545ff;
        }

        /* Perbaikan untuk tampilan mobile */
        @media (max-width: 640px) {
            .filter-container {
                padding: 1rem;
                width: 95%;
                max-width: none;
            }
            .grid.grid-cols-1.md\:grid-cols-3 {
                display: block;
            }
            .grid > div {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body class="p-8 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-2xl max-w-2xl w-full filter-container">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Status Usia Balita</h1>
        
        <form action="<?php echo e(route('balitas.status')); ?>" method="GET" class="mb-8 p-6 rounded-3xl shadow-inner" style="background-color: #F8F9FA;">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Filter Data</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="kec" class="block text-sm font-semibold text-gray-700">Kecamatan</label>
                    <div class="custom-dropdown-container">
                        <input type="hidden" id="kec_val" name="kec" value="<?php echo e(request('kec')); ?>">
                        <div class="custom-dropdown-button" id="kec_button">
                            <span id="kec_label"><?php echo e(request('kec') ?? 'Semua Kecamatan'); ?></span>
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
                        <input type="hidden" id="puskesmas_val" name="puskesmas" value="<?php echo e(request('puskesmas')); ?>">
                        <div class="custom-dropdown-button" id="puskesmas_button">
                            <span id="puskesmas_label"><?php echo e(request('puskesmas') ?? 'Semua Puskesmas'); ?></span>
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
                        <input type="hidden" id="desa_kel_val" name="desa_kel" value="<?php echo e(request('desa_kel')); ?>">
                        <div class="custom-dropdown-button" id="desa_kel_button">
                            <span id="desa_kel_label"><?php echo e(request('desa_kel') ?? 'Semua Desa/Kelurahan'); ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="custom-dropdown-options" id="desa_kel_options">
                            <div class="custom-dropdown-option" data-value="">Semua Desa/Kelurahan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg text-white btn-filter">
                    <i class="fas fa-filter mr-2"></i> Tampilkan
                </button>
            </div>
        </form>

        <div class="space-y-4">
            <a href="<?php echo e(route('balitas.status.show', ['status' => 'aman', 'kec' => request('kec'), 'puskesmas' => request('puskesmas'), 'desa_kel' => request('desa_kel')])); ?>" class="block">
                <div class="p-5 rounded-lg border-2 flex items-center justify-between transition-all duration-300 transform hover:scale-105 cursor-pointer border-green-500">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Bayi Sehat (Aman)</h2>
                        <p class="text-gray-500">Usia < 58 bulan</p>
                    </div>
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white shadow-md bg-green-500"><?php echo e(count($aman)); ?></div>
                </div>
            </a>

            <a href="<?php echo e(route('balitas.status.show', ['status' => 'mendekati', 'kec' => request('kec'), 'puskesmas' => request('puskesmas'), 'desa_kel' => request('desa_kel')])); ?>" class="block">
                <div class="p-5 rounded-lg border-2 flex items-center justify-between transition-all duration-300 transform hover:scale-105 cursor-pointer border-yellow-400">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Bayi Hampir Batas</h2>
                        <p class="text-gray-500">Usia 58 - 59 bulan</p>
                    </div>
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white shadow-md bg-yellow-400"><?php echo e(count($mendekati)); ?></div>
                </div>
            </a>
            
            <a href="<?php echo e(route('balitas.status.show', ['status' => 'lewat', 'kec' => request('kec'), 'puskesmas' => request('puskesmas'), 'desa_kel' => request('desa_kel')])); ?>" class="block">
                <div class="p-5 rounded-lg border-2 flex items-center justify-between transition-all duration-300 transform hover:scale-105 cursor-pointer border-red-500">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Bayi Lewat Batas</h2>
                        <p class="text-gray-500">Usia > 59 bulan</p>
                    </div>
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white shadow-md bg-red-500"><?php echo e(count($lewat)); ?></div>
                </div>
            </a>
            
            <?php if(count($aman) === 0 && count($mendekati) === 0 && count($lewat) === 0): ?>
                <div class="text-center text-gray-500 font-semibold mt-4">Tidak ada data balita.</div>
            <?php endif; ?>
        </div>

        <div class="mt-8 text-center">
            <a href="<?php echo e(url('/')); ?>" class="inline-block bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-700 transition duration-200">Kembali ke Menu Utama</a>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // =========================================================
            // Bagian 1: Data dan Logika Dropdown Dinamis
            // =========================================================
            const dataLokasi = {
                // Struktur data hierarkis untuk dropdown
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
                    "BEJI": { "MOJOREJO": ["MAWAR", "MELATI", "ANGGREK", "DAHLIA", "MATAHARI", "FLAMBOYAN", "NUSA INDAH", "SAKURA"] },
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

            /**
             * Mengisi opsi dropdown kustom dan memperbarui label tombol.
             * @param {HTMLElement} container - Elemen kontainer dropdown kustom.
             * @param {string[]} optionsData - Array string opsi.
             * @param {string} placeholder - Teks placeholder default.
             * @param {string} selectedValue - Nilai yang dipilih saat ini.
             */
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
            
            /**
             * Menambahkan event listener pada dropdown kustom.
             * @param {HTMLElement} button - Tombol dropdown.
             * @param {HTMLElement} optionsDiv - Kontainer opsi dropdown.
             * @param {HTMLElement} hiddenInput - Input tersembunyi untuk menyimpan nilai.
             * @param {HTMLElement} labelSpan - Elemen span yang menampilkan teks yang dipilih.
             * @param {string} placeholder - Teks placeholder default.
             * @param {object} dataMap - Objek data lokasi.
             */
            function addDropdownListeners(button, optionsDiv, hiddenInput, labelSpan, placeholder, dataMap) {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Sembunyikan dropdown lain dan tampilkan dropdown saat ini
                    document.querySelectorAll('.custom-dropdown-options').forEach(el => {
                        if (el !== optionsDiv) el.classList.remove('show');
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
                        
                        // Logika untuk memperbarui dropdown berikutnya secara dinamis
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

                // Sembunyikan dropdown saat klik di luar area dropdown
                window.addEventListener('click', function() {
                    optionsDiv.classList.remove('show');
                });
            }

            // Inisialisasi dropdown saat DOM selesai dimuat
            (function initializeDropdowns() {
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
                    }
                } else {
                    // Inisialisasi dropdown Puskesmas dan Desa/Kelurahan kosong jika Kecamatan belum dipilih
                    addDropdownListeners(puskesmasButton, puskesmasOptions, puskesmasSelect, puskesmasLabel, 'Semua Puskesmas', dataLokasi);
                    addDropdownListeners(desaKelButton, desaKelOptions, desaKelSelect, desaKelLabel, 'Semua Desa/Kelurahan', dataLokasi);
                }
            })();
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\balita-app\resources\views/balitas/status.blade.php ENDPATH**/ ?>