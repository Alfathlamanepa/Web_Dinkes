<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Balita</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Impor font dari Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        /* Gaya dasar untuk body, menggunakan gradien animasi */
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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

        /* Gaya untuk modal (pop-up) */
        .modal {
            display: none; /* Sembunyikan modal secara default */
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

        /* Gaya konten di dalam modal */
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
        
        /* Animasi muncul dari atas saat modal ditampilkan */
        @keyframes animatetop {
            from { top: -300px; opacity: 0; }
            to { top: 0; opacity: 1; }
        }
        
        /* Tombol tutup modal */
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
        
        /* Media query untuk penyesuaian tata letak pada perangkat mobile */
        @media (max-width: 640px) {
            body { padding: 1rem; }
            .grid-cols-1.md\:grid-cols-2 { grid-template-columns: 1fr; }
            .grid > div { margin-bottom: 1rem; }
            .grid-cols-1.md\:grid-cols-2 > div.md\:col-span-2 { grid-column: span 1 / span 1; }
            .flex.items-center.space-x-2 { flex-direction: column; align-items: stretch; space-x: 0; }
            .flex-grow { width: 100%; margin-bottom: 0.5rem; }
            .flex-grow + button { width: 100%; }
        }
    </style>
</head>
<body class="p-8">
    
    @if(session('success'))
        <div id="successModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <div class="p-4 text-center">
                    <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
                    <p class="text-xl text-green-600 font-semibold mb-2">Berhasil!</p>
                    <p class="text-gray-500">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div id="errorModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <div class="p-4 text-center">
                    <i class="fas fa-times-circle text-red-500 text-5xl mb-4"></i>
                    <p class="text-xl text-red-600 font-semibold mb-2">Gagal!</p>
                    <p class="text-gray-500">{{ session('error') ?? 'Data tidak valid. Periksa kembali isian Anda.' }}</p>
                </div>
            </div>
        </div>
    @endif

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <div class="p-4 text-center">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-5xl mb-4"></i>
                <p class="text-xl text-gray-800 font-semibold mb-2">Konfirmasi Simpan</p>
                <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menyimpan data balita ini?</p>
                <div class="flex justify-center space-x-4">
                    <button id="confirm-create-btn" class="bg-teal-600 text-white font-bold px-6 py-2 rounded-xl hover:bg-teal-700 transition-colors duration-200">
                        Ya, Simpan
                    </button>
                    <button id="cancel-create-btn" class="bg-gray-400 text-white font-bold px-6 py-2 rounded-xl hover:bg-gray-500 transition-colors duration-200">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-3xl shadow-2xl max-w-4xl w-full transform transition-all duration-300 hover:scale-105">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Tambah Data Balita</h1>
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <i class="fas fa-home text-2xl transform transition-transform duration-200 hover:scale-110"></i>
            </a>
        </div>
    
        <form id="create-form" action="{{ route('balitas.store') }}" method="POST">
            @csrf
            <input type="hidden" name="from" value="{{ request('from') }}">
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div class="md:col-span-2">
                    <label for="nik_balita" class="block text-sm font-semibold text-gray-700">NIK Balita (Isi manual atau klik tombol)</label>
                    <div class="flex items-center space-x-2 mt-1">
                        <input type="text" id="nik_balita" name="nik_balita" class="flex-grow rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" pattern="[0-9]*" inputmode="numeric" value="{{ old('nik_balita') }}">
                        <button type="button" id="generate_nik_button" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg text-white" style="background-color: #008080; hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-magic mr-2"></i> Buat NIK
                        </button>
                    </div>
                </div>

                <div>
                    <label for="nama_balita" class="block text-sm font-semibold text-gray-700">Nama Balita</label>
                    <input type="text" id="nama_balita" name="nama_balita" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200 uppercase" oninput="this.value = this.value.toUpperCase()" value="{{ old('nama_balita') }}">
                </div>

                <div>
                    <label for="nama_ortu" class="block text-sm font-semibold text-gray-700">Nama Ortu</label>
                    <input type="text" id="nama_ortu" name="nama_ortu" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200 uppercase" oninput="this.value = this.value.toUpperCase()" value="{{ old('nama_ortu') }}">
                </div>
                    
                <div>
                    <label for="tgl_lahir" class="block text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" value="{{ old('tgl_lahir') }}">
                </div>
        
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
        
                <div>
                    <label for="nomor_kk" class="block text-sm font-semibold text-gray-700">Nomor KK</label>
                    <input type="text" id="nomor_kk" name="nomor_kk" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" pattern="[0-9]*" inputmode="numeric" value="{{ old('nomor_kk') }}">
                </div>
        
                <div>
                    <label for="nik_ortu" class="block text-sm font-semibold text-gray-700">NIK Ortu</label>
                    <input type="text" id="nik_ortu" name="nik_ortu" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" pattern="[0-9]*" inputmode="numeric" value="{{ old('nik_ortu') }}">
                </div>
        
                <div>
                    <label for="hp_ortu" class="block text-sm font-semibold text-gray-700">No. HP Ortu</label>
                    <input type="text" id="hp_ortu" name="hp_ortu" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" pattern="[0-9]*" inputmode="numeric" value="{{ old('hp_ortu') }}">
                </div>
        
                <div>
                    <label for="rt" class="block text-sm font-semibold text-gray-700">RT</label>
                    <input type="text" id="rt" name="rt" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" pattern="[0-9]*" inputmode="numeric" value="{{ old('rt') }}">
                </div>
        
                <div>
                    <label for="rw" class="block text-sm font-semibold text-gray-700">RW</label>
                    <input type="text" id="rw" name="rw" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" pattern="[0-9]*" inputmode="numeric" value="{{ old('rw') }}">
                </div>
        
                <div>
                    <label for="provinsi" class="block text-sm font-semibold text-gray-700">Provinsi</label>
                    <input type="text" id="provinsi" name="provinsi" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" value="JAWA TIMUR" readonly>
                </div>
                <div>
                    <label for="kab_kota" class="block text-sm font-semibold text-gray-700">Kab/Kota</label>
                    <input type="text" id="kab_kota" name="kab_kota" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200" value="KOTA BATU" readonly>
                </div>
        
                <div>
                    <label for="kec" class="block text-sm font-semibold text-gray-700">Kecamatan</label>
                    <select id="kec" name="kec" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200">
                        <option value="">Pilih Kecamatan</option>
                        <option value="BATU">Kecamatan Batu</option>
                        <option value="JUNREJO">Kecamatan Junrejo</option>
                        <option value="BUMIAJI">Kecamatan Bumiaji</option>
                    </select>
                </div>
        
                <div>
                    <label for="puskesmas" class="block text-sm font-semibold text-gray-700">Puskesmas</label>
                    <select id="puskesmas" name="puskesmas" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200">
                        <option value="">Pilih Puskesmas</option>
                    </select>
                </div>
        
                <div>
                    <label for="desa_kel" class="block text-sm font-semibold text-gray-700">Desa/Kel</label>
                    <select id="desa_kel" name="desa_kel" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200">
                        <option value="">Pilih Desa/Kelurahan</option>
                    </select>
                </div>
        
                <div>
                    <label for="posyandu" class="block text-sm font-semibold text-gray-700">Posyandu</label>
                    <select id="posyandu" name="posyandu" class="mt-1 block w-full rounded-xl border-2 border-gray-300 shadow-inner focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 transition-all duration-200">
                        <option value="">Pilih Posyandu</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end pt-8">
                <button type="button" id="submit-button" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg text-white" style="background-color: #008080; hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transform hover:scale-105 transition-transform duration-200">
                    <i class="fas fa-save mr-2"></i> Simpan Data Balita
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // =========================================================
            // Bagian 1: Logika Modal Pop-up
            // =========================================================
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');
            const confirmModal = document.getElementById('confirmModal');
            const submitButton = document.getElementById('submit-button');
            const confirmCreateBtn = document.getElementById('confirm-create-btn');
            const cancelCreateBtn = document.getElementById('cancel-create-btn');
            const createForm = document.getElementById('create-form');

            // Fungsi untuk menampilkan modal pop-up (sukses/gagal)
            function showModal(modalElement) {
                if (modalElement) {
                    modalElement.style.display = 'flex';
                    const closeBtn = modalElement.querySelector('.close-btn');
                    if (closeBtn) {
                        closeBtn.onclick = () => modalElement.style.display = 'none';
                    }
                    window.onclick = (event) => {
                        if (event.target == modalElement) {
                            modalElement.style.display = 'none';
                        }
                    };
                }
            }

            showModal(successModal);
            showModal(errorModal);
            
            // Event listener untuk tombol 'Simpan Data Balita' untuk menampilkan modal konfirmasi
            submitButton.addEventListener('click', function() {
                confirmModal.style.display = 'flex';
            });

            // Event listener untuk tombol 'Ya, Simpan' di modal konfirmasi
            confirmCreateBtn.addEventListener('click', function() {
                confirmModal.style.display = 'none';
                createForm.submit();
            });

            // Event listener untuk tombol 'Batal' di modal konfirmasi
            cancelCreateBtn.addEventListener('click', function() {
                confirmModal.style.display = 'none';
            });

            // =========================================================
            // Bagian 2: Data dan Logika Dropdown Dinamis
            // =========================================================
            const dataLokasi = {
                // Struktur data hierarkis: Kecamatan -> Puskesmas -> Desa/Kelurahan -> Posyandu
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
            const kecSelect = document.getElementById('kec');
            const puskesmasSelect = document.getElementById('puskesmas');
            const desaKelSelect = document.getElementById('desa_kel');
            const posyanduSelect = document.getElementById('posyandu');

            // Fungsi untuk mengisi opsi dropdown
            function populateDropdown(selectElement, options, placeholder) {
                selectElement.innerHTML = `<option value="">${placeholder}</option>`;
                options.forEach(option => {
                    const newOption = document.createElement('option');
                    newOption.value = option;
                    newOption.textContent = option;
                    selectElement.appendChild(newOption);
                });
            }

            // Fungsi untuk mengeset nilai dropdown yang sudah ada (digunakan untuk `old` value)
            function setSelectedValue(selectElement, value) {
                const option = Array.from(selectElement.options).find(opt => opt.value === value);
                if (option) {
                    option.selected = true;
                }
            }
        
            // Event listener: Saat Kecamatan berubah, perbarui dropdown Puskesmas
            kecSelect.addEventListener('change', function() {
                const selectedKec = this.value;
                puskesmasSelect.innerHTML = '<option value="">Pilih Puskesmas</option>';
                desaKelSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                posyanduSelect.innerHTML = '<option value="">Pilih Posyandu</option>';
                if (selectedKec && dataLokasi[selectedKec]) {
                    const puskesmasOptions = Object.keys(dataLokasi[selectedKec]);
                    populateDropdown(puskesmasSelect, puskesmasOptions, 'Pilih Puskesmas');
                }
            });

            // Event listener: Saat Puskesmas berubah, perbarui dropdown Desa/Kelurahan
            puskesmasSelect.addEventListener('change', function() {
                const selectedKec = kecSelect.value;
                const selectedPuskesmas = this.value;
                desaKelSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                posyanduSelect.innerHTML = '<option value="">Pilih Posyandu</option>';
                if (selectedKec && selectedPuskesmas && dataLokasi[selectedKec][selectedPuskesmas]) {
                    const desaOptions = Object.keys(dataLokasi[selectedKec][selectedPuskesmas]);
                    populateDropdown(desaKelSelect, desaOptions, 'Pilih Desa/Kelurahan');
                }
            });

            // Event listener: Saat Desa/Kelurahan berubah, perbarui dropdown Posyandu
            desaKelSelect.addEventListener('change', function() {
                const selectedKec = kecSelect.value;
                const selectedPuskesmas = puskesmasSelect.value;
                const selectedDesa = this.value;
                posyanduSelect.innerHTML = '<option value="">Pilih Posyandu</option>';
                if (selectedKec && selectedPuskesmas && selectedDesa && dataLokasi[selectedKec][selectedPuskesmas][selectedDesa]) {
                    const posyanduOptions = dataLokasi[selectedKec][selectedPuskesmas][selectedDesa];
                    populateDropdown(posyanduSelect, posyanduOptions, 'Pilih Posyandu');
                }
            });

            // Inisialisasi dropdown dengan nilai lama (old input)
            (function initializeDropdownsWithOldValues() {
                const oldKec = "{{ old('kec') }}";
                const oldPuskesmas = "{{ old('puskesmas') }}";
                const oldDesaKel = "{{ old('desa_kel') }}";
                const oldPosyandu = "{{ old('posyandu') }}";
                if (oldKec) {
                    setSelectedValue(kecSelect, oldKec);
                    if (dataLokasi[oldKec]) {
                        populateDropdown(puskesmasSelect, Object.keys(dataLokasi[oldKec]), 'Pilih Puskesmas');
                        setSelectedValue(puskesmasSelect, oldPuskesmas);
                        if (dataLokasi[oldKec][oldPuskesmas]) {
                            populateDropdown(desaKelSelect, Object.keys(dataLokasi[oldKec][oldPuskesmas]), 'Pilih Desa/Kelurahan');
                            setSelectedValue(desaKelSelect, oldDesaKel);
                            if (dataLokasi[oldKec][oldPuskesmas][oldDesaKel]) {
                                populateDropdown(posyanduSelect, dataLokasi[oldKec][oldPuskesmas][oldDesaKel], 'Pilih Posyandu');
                                setSelectedValue(posyanduSelect, oldPosyandu);
                            }
                        }
                    }
                }
            })();

            // =========================================================
            // Bagian 3: Logika Pembuatan NIK Otomatis
            // =========================================================
            const tglLahirInput = document.getElementById('tgl_lahir');
            const jenisKelaminInput = document.getElementById('jenis_kelamin');
            const nikBalitaInput = document.getElementById('nik_balita');
            const generateButton = document.getElementById('generate_nik_button');
            const kodeProvinsi = '35';
            const kodeKabupaten = '79';

            // Fungsi untuk menghasilkan 4 digit terakhir NIK yang unik secara pseudo-random
            function generateUniqueLastDigits() {
                const min = 80;
                const max = 9999;
                const randomNum = Math.floor(Math.random() * (max - min + 1)) + min;
                const timestamp = new Date().getTime();
                const uniqueNum = (timestamp % (max - min + 1)) + randomNum;
                const paddedNum = uniqueNum.toString().padStart(4, '0');
                return paddedNum.substring(paddedNum.length - 4);
            }

            // Event listener saat tombol 'Buat NIK' diklik
            generateButton.addEventListener('click', function() {
                const tanggalLahir = tglLahirInput.value;
                const jenisKelamin = jenisKelaminInput.value;
                const kecamatan = kecSelect.value;
                
                if (!tanggalLahir || !jenisKelamin || !kecamatan) {
                    alert('Mohon isi Tanggal Lahir, Jenis Kelamin, dan Kecamatan terlebih dahulu.');
                    nikBalitaInput.value = '';
                    return;
                }

                const date = new Date(tanggalLahir);
                let day = date.getDate();
                const month = date.getMonth() + 1;
                const year = date.getFullYear().toString().slice(-2);

                // Aturan khusus NIK: Tambahkan 40 pada tanggal untuk perempuan
                if (jenisKelamin === 'P') {
                    day += 40;
                }
                
                const dayString = day.toString().padStart(2, '0');
                const monthString = month.toString().padStart(2, '0');
                const lastFourDigits = generateUniqueLastDigits();
                
                const kodeKecamatan = {
                    "BATU": "01",
                    "JUNREJO": "03",
                    "BUMIAJI": "02"
                }[kecamatan];

                // Gabungkan semua komponen untuk membentuk NIK
                const nik = kodeProvinsi + kodeKabupaten + kodeKecamatan + dayString + monthString + year + lastFourDigits;
                nikBalitaInput.value = nik;
            });
            
            // =========================================================
            // Bagian 4: Validasi Input Sederhana
            // =========================================================
            // Memastikan input hanya menerima angka
            const numericInputs = document.querySelectorAll('input[inputmode="numeric"]');
            numericInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        });
    </script>
</body>
</html>