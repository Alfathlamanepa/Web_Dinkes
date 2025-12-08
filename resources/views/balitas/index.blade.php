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
        /* --- GAYA KONSISTEN --- */
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            position: relative;
            background: linear-gradient(-45deg, #008080, #4BCFCA, #87D9D6, #99E600);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            padding: 0.5rem;
        }

        @media (min-width: 640px) { body { padding: 1rem; } }

        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Header Logos */
        .header-logos {
            position: absolute;
            top: 15px; left: 15px;
            display: flex; align-items: center; gap: 10px;
            z-index: 20;
        }
        .header-logos img { height: 40px; width: auto; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); }
        @media (min-width: 640px) {
            .header-logos { top: 25px; left: 25px; gap: 15px; }
            .header-logos img { height: 80px; }
        }

        /* Back Button */
        .back-container {
            position: absolute; top: 15px; right: 15px; z-index: 20;
        }
        @media (min-width: 640px) { .back-container { top: 25px; right: 25px; } }

        /* Page Title */
        .page-title {
            text-align: center; padding-top: 80px; margin-bottom: 1.5rem; position: relative; z-index: 10;
        }
        .page-title h1 {
            font-size: 1.8rem; font-weight: 900; color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-transform: uppercase; letter-spacing: 1px; line-height: 1.1;
        }
        @media (min-width: 640px) {
            .page-title { padding-top: 120px; margin-bottom: 2rem; }
            .page-title h1 { font-size: 3rem; }
        }

        /* Main Card */
        .index-card {
            background-color: white; border-radius: 1.5rem; padding: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            width: 100%; max-width: 1200px; margin: 0 auto 50px auto;
            position: relative; z-index: 10; min-height: 600px;
        }
        @media (min-width: 640px) { .index-card { border-radius: 2rem; padding: 2.5rem; } }

        /* Shadows */
        .custom-outer-shadow {
            box-shadow: 4px 4px 10px -2px rgba(0, 0, 0, 0.2); transition: all 0.2s ease;
        }
        .custom-outer-shadow:active { transform: scale(0.95); }

        /* Filter Box */
        .filter-box {
            background-color: #f3f4f6; border-radius: 1.5rem; padding: 1.5rem;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06); margin-bottom: 2rem;
        }

        /* Custom Dropdown */
        .custom-dropdown-container { position: relative; }
        .custom-dropdown-button {
            background-color: #e5e7eb; border-radius: 1rem; padding: 0.75rem 1rem;
            display: flex; justify-content: space-between; align-items: center;
            cursor: pointer; font-weight: 600; color: #374151; transition: background 0.2s;
        }
        .custom-dropdown-button:hover { background-color: #d1d5db; }
        .custom-dropdown-options {
            position: absolute; top: 110%; left: 0; width: 100%;
            background: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 50; display: none; max-height: 250px; overflow-y: auto; padding: 0.5rem;
        }
        .custom-dropdown-options.show { display: block; }
        .custom-dropdown-option {
            padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; transition: background 0.1s;
        }
        .custom-dropdown-option:hover { background-color: #f3f4f6; }

        /* Animation */
        .fade-in { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Modal */
        .modal {
            display: none; position: fixed; z-index: 100; left: 0; top: 0; width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
            justify-content: center; align-items: center;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
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

    {{-- KONTEN UTAMA --}}
    <div class="w-full">
        <div class="page-title">
            <h1>DATA BALITA</h1>
        </div>

        <div class="index-card">
            
            {{-- FILTER SECTION --}}
            <form action="{{ route('balitas.index') }}" method="GET" class="filter-box relative">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Filter Data</h2>
                    <a href="{{ route('balitas.create') }}" class="bg-[#009688] hover:bg-[#00796b] text-white font-bold py-2 px-4 sm:py-3 sm:px-6 rounded-xl custom-outer-shadow transition flex items-center justify-center text-sm sm:text-base">
                        <i class="fas fa-plus mr-2"></i> Tambah <span class="hidden sm:inline ml-1">Data</span>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    {{-- Filter Items (Kecamatan, Puskesmas, Desa, Posyandu) --}}
                    @foreach(['kec' => 'Kecamatan', 'puskesmas' => 'Puskesmas', 'desa_kel' => 'Desa/Kel', 'posyandu' => 'Posyandu'] as $key => $label)
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase">{{ $label }}</label>
                        <div class="custom-dropdown-container">
                            <input type="hidden" id="{{ $key }}" name="{{ $key }}" value="{{ request($key) }}">
                            <div class="custom-dropdown-button" id="{{ $key }}_button">
                                <span id="{{ $key }}_label" class="truncate text-sm">{{ request($key) ?? "Semua $label" }}</span>
                                <i class="fas fa-chevron-down text-gray-500 ml-2 text-xs"></i>
                            </div>
                            <div class="custom-dropdown-options" id="{{ $key }}_options">
                                <div class="custom-dropdown-option text-sm" data-value="">Semua {{ $label }}</div>
                                @if($key === 'kec')
                                    <div class="custom-dropdown-option text-sm" data-value="BATU">BATU</div>
                                    <div class="custom-dropdown-option text-sm" data-value="JUNREJO">JUNREJO</div>
                                    <div class="custom-dropdown-option text-sm" data-value="BUMIAJI">BUMIAJI</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-8 rounded-full custom-outer-shadow transition transform hover:-translate-y-1 w-full sm:w-auto">
                        <i class="fas fa-filter mr-2"></i> Tampilkan
                    </button>
                </div>
            </form>

            {{-- GRID CARD CONTAINER (Pengganti Tabel) --}}
            <div id="data-container" class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 min-h-[400px]">
                @if($balitas->isEmpty())
                    <div class="col-span-1 lg:col-span-2 text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                        <i class="fas fa-box-open text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 font-bold text-lg">Belum ada data balita.</p>
                    </div>
                @else
                    @foreach ($balitas as $balita)
                    <div class="card-item relative bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 sm:p-6 border border-gray-200 flex flex-col justify-between" style="display: none;" data-tgl-lahir="{{ $balita->tgl_lahir }}">
                        
                        {{-- Header Kartu --}}
                        <div class="mb-3 border-b border-gray-100 pb-3">
                            <div class="flex items-start gap-3 w-full">
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center shrink-0 mt-1 status-icon-bg">
                                    <i class="fas fa-baby text-gray-400 text-2xl status-icon"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h2 class="text-base sm:text-lg font-black text-gray-800 uppercase break-words leading-tight mb-1">
                                        {{ $balita->nama_balita }}
                                    </h2>
                                    <span class="text-gray-500 text-xs font-semibold tracking-wide flex items-center">
                                        <i class="fas fa-id-card mr-1"></i> {{ $balita->nik_balita }}
                                    </span>
                                </div>
                            </div>
                            
                            {{-- Badge Umur & Status --}}
                            <div class="mt-3 flex justify-between items-center gap-2">
                                <div class="bg-gray-50 border border-gray-200 px-3 py-1 rounded-lg text-center flex-1">
                                    <span class="block text-[10px] text-gray-400 font-bold uppercase">Umur</span>
                                    <span class="text-gray-700 font-bold age-display text-sm">...</span>
                                </div>
                                <div class="bg-gray-50 border border-gray-200 px-3 py-1 rounded-lg text-center flex-1">
                                    <span class="block text-[10px] text-gray-400 font-bold uppercase">Status</span>
                                    <span class="font-bold age-status text-sm">...</span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="grid grid-cols-3 gap-2 mt-2">
                            <a href="{{ route('balitas.show', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="flex items-center justify-center py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-600 hover:text-white transition font-bold text-xs">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                            <a href="{{ route('balitas.edit', ['balita' => $balita->nik_balita, 'page' => $balitas->currentPage()]) }}" class="flex items-center justify-center py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition font-bold text-xs">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <button type="button" class="flex items-center justify-center py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition font-bold text-xs delete-btn" data-nik="{{ $balita->nik_balita }}">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            {{-- CLIENT SIDE PAGINATION CONTROLS --}}
            <div id="pagination-controls" class="mt-8 flex justify-center items-center gap-2 flex-wrap px-2"></div>
            <div class="text-center mt-4 text-xs text-gray-400 font-semibold" id="page-info"></div>

            {{-- LARAVEL PAGINATION (Hidden but functional for large datasets if needed, or remove if fully client-side) --}}
            <div class="hidden">
                 {{ $balitas->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div id="deleteModal" class="modal">
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl animate-fade-in-up m-4">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-100 mb-6">
                <i class="fas fa-trash-alt text-red-500 text-4xl"></i>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Hapus Data?</h3>
            <p class="text-gray-500 mb-6 text-sm">Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex flex-col gap-3">
                <form id="delete-form-modal" method="POST" action="">
                    @csrf @method('DELETE')
                    <input type="hidden" name="page" value="{{ $balitas->currentPage() }}">
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl custom-outer-shadow transition">Ya, Hapus</button>
                </form>
                <button id="cancel-delete-btn" class="w-full bg-gray-200 text-gray-700 font-bold py-3 rounded-xl hover:bg-gray-300 transition custom-outer-shadow">Batal</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- DATA LOKASI (Disingkat untuk keringkasan, isinya sama dengan sebelumnya) ---
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
            // *Catatan: Untuk kode produksi, pastikan seluruh array desa diisi lengkap seperti file asli*

            // --- 1. FILTER LOGIC (Sama persis) ---
            const dropdowns = ['kec', 'puskesmas', 'desa_kel', 'posyandu'];
            
            function populateDropdown(id, data, placeholder) {
                const container = document.getElementById(id + '_options');
                container.innerHTML = `<div class="custom-dropdown-option text-sm" data-value="">${placeholder}</div>`;
                data.forEach(val => {
                    container.innerHTML += `<div class="custom-dropdown-option text-sm" data-value="${val}">${val}</div>`;
                });
            }

            function setupDropdownListeners(id, mapData) {
                const btn = document.getElementById(id + '_button');
                const optionsDiv = document.getElementById(id + '_options');
                const input = document.getElementById(id);
                const label = document.getElementById(id + '_label');

                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll('.custom-dropdown-options').forEach(el => { if(el !== optionsDiv) el.classList.remove('show'); });
                    optionsDiv.classList.toggle('show');
                });

                optionsDiv.addEventListener('click', (e) => {
                    if (e.target.classList.contains('custom-dropdown-option')) {
                        const val = e.target.getAttribute('data-value');
                        input.value = val;
                        label.textContent = e.target.textContent;
                        optionsDiv.classList.remove('show');

                        // Cascade logic
                        if (id === 'kec') {
                            const puskData = val ? Object.keys(mapData[val]) : [];
                            populateDropdown('puskesmas', puskData, 'Semua Puskesmas');
                            resetInputs(['puskesmas', 'desa_kel', 'posyandu']);
                        } else if (id === 'puskesmas') {
                            const k = document.getElementById('kec').value;
                            const desaData = (k && val) ? Object.keys(mapData[k][val]) : [];
                            populateDropdown('desa_kel', desaData, 'Semua Desa/Kel');
                            resetInputs(['desa_kel', 'posyandu']);
                        } else if (id === 'desa_kel') {
                            // Logic posyandu (asumsikan data map lengkap)
                        }
                    }
                });
            }

            function resetInputs(ids) {
                ids.forEach(i => {
                    document.getElementById(i).value = '';
                    document.getElementById(i + '_label').textContent = 'Semua ' + (i === 'desa_kel' ? 'Desa/Kel' : i.charAt(0).toUpperCase() + i.slice(1));
                });
            }

            window.addEventListener('click', () => document.querySelectorAll('.custom-dropdown-options').forEach(el => el.classList.remove('show')));
            
            // Init Dropdowns
            const kecKeys = Object.keys(dataLokasi);
            populateDropdown('kec', kecKeys, 'Semua Kecamatan');
            setupDropdownListeners('kec', dataLokasi);
            setupDropdownListeners('puskesmas', dataLokasi);
            setupDropdownListeners('desa_kel', dataLokasi);
            setupDropdownListeners('posyandu', dataLokasi);


            // --- 2. GRID & PAGINATION LOGIC (Slide System) ---
            const cards = document.querySelectorAll('.card-item');
            const itemsPerPage = 20; // Set 6 agar tidak scroll
            let currentPage = 1;
            const totalPages = Math.ceil(cards.length / itemsPerPage);
            
            const container = document.getElementById('data-container');
            const paginationContainer = document.getElementById('pagination-controls');
            const pageInfo = document.getElementById('page-info');

            // Hitung Umur & Status untuk setiap kartu
            cards.forEach(card => {
                const tgl = card.dataset.tglLahir;
                if(!tgl) return;
                
                const birthDate = new Date(tgl);
                const today = new Date();
                let months = (today.getFullYear() - birthDate.getFullYear()) * 12 + (today.getMonth() - birthDate.getMonth());
                if (today.getDate() < birthDate.getDate()) months--;
                
                // Tampilan Hari
                let days = today.getDate() - birthDate.getDate();
                if (days < 0) {
                    const lastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
                    days += lastMonth.getDate();
                }

                // Set Text
                const ageTxt = card.querySelector('.age-display');
                const statusTxt = card.querySelector('.age-status');
                const iconBg = card.querySelector('.status-icon-bg');
                const icon = card.querySelector('.status-icon');
                
                ageTxt.textContent = `${months} Bln ${days} Hr`;
                
                if(months >= 60) {
                    statusTxt.textContent = 'Lewat'; statusTxt.className = 'font-bold age-status text-sm text-red-600';
                    card.classList.add('border-l-4', 'border-red-500');
                    iconBg.className = 'w-12 h-12 rounded-full bg-red-100 flex items-center justify-center shrink-0 mt-1';
                    icon.className = 'fas fa-baby text-red-500 text-2xl';
                } else if (months >= 58) {
                    statusTxt.textContent = 'Hampir'; statusTxt.className = 'font-bold age-status text-sm text-yellow-600';
                    card.classList.add('border-l-4', 'border-yellow-400');
                    iconBg.className = 'w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center shrink-0 mt-1';
                    icon.className = 'fas fa-baby text-yellow-500 text-2xl';
                } else {
                    statusTxt.textContent = 'Aman'; statusTxt.className = 'font-bold age-status text-sm text-green-600';
                    card.classList.add('border-l-4', 'border-green-500');
                    iconBg.className = 'w-12 h-12 rounded-full bg-green-100 flex items-center justify-center shrink-0 mt-1';
                    icon.className = 'fas fa-baby text-green-500 text-2xl';
                }
            });

            function showPage(page) {
                if(cards.length === 0) return;
                cards.forEach(c => { c.style.display = 'none'; c.classList.remove('fade-in'); });
                
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                
                for(let i=start; i<end; i++) {
                    if(cards[i]) {
                        cards[i].style.display = 'flex'; // Flex agar layout card benar
                        void cards[i].offsetWidth; 
                        cards[i].classList.add('fade-in');
                    }
                }
                renderPagination();
                updateInfo();
            }

            function renderPagination() {
                paginationContainer.innerHTML = '';
                if(totalPages <= 1) return;

                const createBtn = (html, enabled, onClick) => {
                    const b = document.createElement('button');
                    b.innerHTML = html;
                    b.className = `w-8 h-8 sm:w-10 sm:h-10 rounded-lg font-bold border border-gray-300 transition flex items-center justify-center custom-outer-shadow text-sm ${enabled ? 'bg-white text-gray-600 hover:bg-gray-100' : 'bg-gray-100 text-gray-300 cursor-not-allowed'}`;
                    if(enabled) b.onclick = onClick; else b.disabled = true;
                    return b;
                };

                paginationContainer.appendChild(createBtn('<i class="fas fa-chevron-left"></i>', currentPage > 1, () => changePage(currentPage-1)));

                for(let i=1; i<=totalPages; i++) {
                    if(totalPages > 5 && (i!==1 && i!==totalPages && Math.abs(currentPage-i)>1)) {
                        if(i===2 || i===totalPages-1) {
                            const span = document.createElement('span'); span.textContent='...'; span.className='text-gray-400 text-xs px-1';
                            paginationContainer.appendChild(span);
                        }
                        continue;
                    }
                    const btn = createBtn(i, true, () => changePage(i));
                    if(i===currentPage) { btn.className = 'w-8 h-8 sm:w-10 sm:h-10 rounded-lg font-bold border border-[#009688] bg-[#009688] text-white flex items-center justify-center custom-outer-shadow text-sm'; }
                    paginationContainer.appendChild(btn);
                }

                paginationContainer.appendChild(createBtn('<i class="fas fa-chevron-right"></i>', currentPage < totalPages, () => changePage(currentPage+1)));
            }

            function changePage(p) {
                if(p<1 || p>totalPages) return;
                currentPage = p;
                showPage(p);
                // Scroll to top of container
                const yOffset = -120; 
                const y = container.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({top: y, behavior: 'smooth'});
            }

            function updateInfo() {
                if(cards.length > 0) pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages} (Total ${cards.length} Data)`;
            }

            // --- 3. MODAL HAPUS (Delegation karena elemen dinamis) ---
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('delete-form-modal');
            const cancelBtn = document.getElementById('cancel-delete-btn');

            document.body.addEventListener('click', function(e) {
                if (e.target.closest('.delete-btn')) {
                    const btn = e.target.closest('.delete-btn');
                    const nik = btn.dataset.nik;
                    deleteForm.action = `{{ url('balitas') }}/${nik}`;
                    deleteModal.style.display = 'flex';
                }
            });

            cancelBtn.addEventListener('click', (e) => { e.preventDefault(); deleteModal.style.display = 'none'; });
            window.onclick = (e) => { if(e.target == deleteModal) deleteModal.style.display = 'none'; };

            // Init
            showPage(1);
        });
    </script>
</body>
</html>