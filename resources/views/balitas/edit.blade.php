<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Balita</title>
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
    </style>
</head>
<body class="p-8 flex items-center justify-center min-h-screen">

    {{-- Pop-up Sukses --}}
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

    {{-- Pop-up Error --}}
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

    {{-- Pop-up Konfirmasi Simpan --}}
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <div class="p-4 text-center">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-5xl mb-4"></i>
                <p class="text-xl text-gray-800 font-semibold mb-2">Konfirmasi Perubahan</p>
                <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menyimpan perubahan data balita ini?</p>
                <div class="flex justify-center space-x-4">
                    <button id="confirm-save-btn" class="bg-teal-600 text-white font-bold px-6 py-2 rounded-xl hover:bg-teal-700 transition-colors duration-200">
                        Ya, Simpan
                    </button>
                    <button id="cancel-save-btn" class="bg-gray-400 text-white font-bold px-6 py-2 rounded-xl hover:bg-gray-500 transition-colors duration-200">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 tracking-wide text-center flex-grow">Edit Data Balita</h1>
            <a href="{{ request()->query('from') == 'search' ? route('balitas.search', ['nik_balita' => $balita->nik_balita]) : route('balitas.index', ['page' => request()->query('page')]) }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
        </div>
    
        <form id="edit-form" action="{{ route('balitas.update', $balita->nik_balita) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="page" value="{{ request('page') }}">
            {{-- Tambahan untuk melacak asal halaman --}}
            <input type="hidden" name="from" value="{{ request('from') }}">
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <label for="nik_balita" class="block text-sm font-medium text-gray-700">NIK Balita</label>
                    <input type="text" id="nik_balita" name="nik_balita" value="{{ old('nik_balita', $balita->nik_balita) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" inputmode="numeric" pattern="[0-9]*">
                </div>
        
                <div>
                    <label for="nama_balita" class="block text-sm font-medium text-gray-700">Nama Balita</label>
                    <input type="text" id="nama_balita" name="nama_balita" value="{{ old('nama_balita', $balita->nama_balita) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
        
                <div>
                    <label for="nama_ortu" class="block text-sm font-medium text-gray-700">Nama Ortu</label>
                    <input type="text" id="nama_ortu" name="nama_ortu" value="{{ old('nama_ortu', $balita->nama_ortu) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
        
                <div>
                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', $balita->tgl_lahir) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
        
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="L" {{ old('jenis_kelamin', $balita->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $balita->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
        
                <div>
                    <label for="nomor_kk" class="block text-sm font-medium text-gray-700">Nomor KK</label>
                    <input type="text" id="nomor_kk" name="nomor_kk" value="{{ old('nomor_kk', $balita->nomor_kk) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" inputmode="numeric" pattern="[0-9]*">
                </div>
        
                <div>
                    <label for="nik_ortu" class="block text-sm font-medium text-gray-700">NIK Ortu</label>
                    <input type="text" id="nik_ortu" name="nik_ortu" value="{{ old('nik_ortu', $balita->nik_ortu) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" inputmode="numeric" pattern="[0-9]*">
                </div>
        
                <div>
                    <label for="hp_ortu" class="block text-sm font-medium text-gray-700">No. HP Ortu</label>
                    <input type="text" id="hp_ortu" name="hp_ortu" value="{{ old('hp_ortu', $balita->hp_ortu) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" inputmode="numeric" pattern="[0-9]*">
                </div>
        
                <div>
                    <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                    <input type="text" id="rt" name="rt" value="{{ old('rt', $balita->rt) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" inputmode="numeric" pattern="[0-9]*">
                </div>
        
                <div>
                    <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                    <input type="text" id="rw" name="rw" value="{{ old('rw', $balita->rw) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" inputmode="numeric" pattern="[0-9]*">
                </div>
        
                <div>
                    <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                    <input type="text" id="provinsi" name="provinsi" value="JAWA TIMUR" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                </div>
        
                <div>
                    <label for="kab_kota" class="block text-sm font-medium text-gray-700">Kab/Kota</label>
                    <input type="text" id="kab_kota" name="kab_kota" value="KOTA BATU" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                </div>
        
                <div>
                    <label for="kec" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                    <select id="kec" name="kec" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Pilih Kecamatan</option>
                        <option value="BATU">Kecamatan Batu</option>
                        <option value="JUNREJO">Kecamatan Junrejo</option>
                        <option value="BUMIAJI">Kecamatan Bumiaji</option>
                    </select>
                </div>
        
                <div>
                    <label for="puskesmas" class="block text-sm font-medium text-gray-700">Puskesmas</label>
                    <select id="puskesmas" name="puskesmas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Pilih Puskesmas</option>
                    </select>
                </div>
        
                <div>
                    <label for="desa_kel" class="block text-sm font-medium text-gray-700">Desa/Kel</label>
                    <select id="desa_kel" name="desa_kel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Pilih Desa/Kelurahan</option>
                    </select>
                </div>
        
                <div>
                    <label for="posyandu" class="block text-sm font-medium text-gray-700">Posyandu</label>
                    <select id="posyandu" name="posyandu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Pilih Posyandu</option>
                    </select>
                </div>
            </div>
    
            <div class="flex justify-end pt-4">
                <button type="button" id="submit-button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white" style="background-color: #008080; hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika untuk menampilkan modal
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');
            const confirmModal = document.getElementById('confirmModal');
            const submitButton = document.getElementById('submit-button');
            const confirmSaveBtn = document.getElementById('confirm-save-btn');
            const cancelSaveBtn = document.getElementById('cancel-save-btn');
            const editForm = document.getElementById('edit-form');

            if (successModal) {
                successModal.style.display = 'flex';
                const closeBtn = successModal.querySelector('.close-btn');
                if (closeBtn) {
                    closeBtn.onclick = () => successModal.style.display = 'none';
                }
            }

            if (errorModal) {
                errorModal.style.display = 'flex';
                const closeBtn = errorModal.querySelector('.close-btn');
                if (closeBtn) {
                    closeBtn.onclick = () => errorModal.style.display = 'none';
                }
            }

            window.onclick = function(event) {
                if (event.target == successModal) {
                    successModal.style.display = 'none';
                }
                if (event.target == errorModal) {
                    errorModal.style.display = 'none';
                }
                if (event.target == confirmModal) {
                    confirmModal.style.display = 'none';
                }
            };
            
            // Logika untuk tombol konfirmasi
            submitButton.addEventListener('click', function() {
                confirmModal.style.display = 'flex';
            });

            confirmSaveBtn.addEventListener('click', function() {
                confirmModal.style.display = 'none';
                editForm.submit();
            });

            cancelSaveBtn.addEventListener('click', function() {
                confirmModal.style.display = 'none';
            });

            // Data untuk dropdown
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

            // Fungsi untuk mengisi dropdown
            function populateDropdown(selectElement, options, placeholder) {
                selectElement.innerHTML = `<option value="">${placeholder}</option>`;
                options.forEach(option => {
                    const newOption = document.createElement('option');
                    newOption.value = option;
                    newOption.textContent = option;
                    selectElement.appendChild(newOption);
                });
            }

            // Fungsi untuk memilih nilai dropdown yang sudah ada
            function setSelectedValue(selectElement, value) {
                const option = Array.from(selectElement.options).find(opt => opt.value === value);
                if (option) {
                    option.selected = true;
                }
            }
        
            // Event listener untuk Kecamatan
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

            // Event listener untuk Puskesmas
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

            // Event listener untuk Desa/Kelurahan
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

            // Inisialisasi dropdown dengan data yang sudah ada
            const balitaData = {
                kec: "{{ $balita->kec }}",
                puskesmas: "{{ $balita->puskesmas }}",
                desa_kel: "{{ $balita->desa_kel }}",
                posyandu: "{{ $balita->posyandu }}"
            };
            
            // Logika baru untuk inisialisasi dropdown secara berurutan
            function initializeDropdowns() {
                // Set nilai awal untuk Kecamatan
                if (balitaData.kec) {
                    kecSelect.value = balitaData.kec.toUpperCase();
                }

                // Perbarui Puskesmas
                if (balitaData.kec && dataLokasi[balitaData.kec.toUpperCase()]) {
                    const puskesmasOptions = Object.keys(dataLokasi[balitaData.kec.toUpperCase()]);
                    populateDropdown(puskesmasSelect, puskesmasOptions, 'Pilih Puskesmas');
                    if (balitaData.puskesmas) {
                        setSelectedValue(puskesmasSelect, balitaData.puskesmas.toUpperCase());
                    }
                }

                // Perbarui Desa/Kelurahan
                if (balitaData.kec && balitaData.puskesmas && dataLokasi[balitaData.kec.toUpperCase()] && dataLokasi[balitaData.kec.toUpperCase()][balitaData.puskesmas.toUpperCase()]) {
                    const desaOptions = Object.keys(dataLokasi[balitaData.kec.toUpperCase()][balitaData.puskesmas.toUpperCase()]);
                    populateDropdown(desaKelSelect, desaOptions, 'Pilih Desa/Kelurahan');
                    if (balitaData.desa_kel) {
                        setSelectedValue(desaKelSelect, balitaData.desa_kel.toUpperCase());
                    }
                }

                // Perbarui Posyandu
                if (balitaData.kec && balitaData.puskesmas && balitaData.desa_kel && dataLokasi[balitaData.kec.toUpperCase()][balitaData.puskesmas.toUpperCase()][balitaData.desa_kel.toUpperCase()]) {
                    const posyanduOptions = dataLokasi[balitaData.kec.toUpperCase()][balitaData.puskesmas.toUpperCase()][balitaData.desa_kel.toUpperCase()];
                    populateDropdown(posyanduSelect, posyanduOptions, 'Pilih Posyandu');
                    if (balitaData.posyandu) {
                        setSelectedValue(posyanduSelect, balitaData.posyandu.toUpperCase());
                    }
                }
            }

            initializeDropdowns();

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