<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Balita</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- FontAwesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* --- GAYA DARI WELCOME.BLADE.PHP (AGAR KONSISTEN) --- */
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            position: relative;
         /* Menggunakan gradien yang sama dengan file lain */
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

        /* --- HEADER & LOGO --- */
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

        /* --- TOMBOL KEMBALI (KANAN ATAS) --- */
        .back-container {
            position: absolute;
            top: 25px;
            right: 25px;
            z-index: 20;
        }

        /* --- JUDUL HALAMAN (TENGAH) --- */
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

        /* --- STYLE FORM EDIT (KARTU PUTIH) --- */
        .edit-card {
            background-color: white;
            border-radius: 2rem;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 900px;
            margin: 0 auto 50px auto;
            position: relative;
            z-index: 10;
        }

        .form-label {
            font-weight: 800;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
        }
        
        /* --- UPDATE: INPUT FIELDS (INNER SHADOW) --- */
        /* Menggabungkan style input lama dengan efek Inner Shadow baru */
        .form-input {
            background-color: #e5e7eb; /* Sedikit lebih terang dari sebelumnya */
            border: none;
            color: #1f2937;
            font-weight: 600;
            border-radius: 0.75rem; /* Rounded-xl */
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.2s;
            
            /* EFEK INNER SHADOW (Tenggelam) */
            box-shadow: inset 0px 4px 6px 0px rgba(0, 0, 0, 0.15); 
        }
        .form-input:focus {
            outline: none;
            /* Ring dan shadow tetap ada saat fokus */
            box-shadow: inset 0px 4px 6px 0px rgba(0, 0, 0, 0.1), 0 0 0 2px #008080;
            background-color: #f3f4f6;
        }
        
        /* --- UPDATE: TOMBOL (OUTER SHADOW) --- */
        /* Class khusus untuk semua tombol agar timbul */
        .custom-outer-shadow {
            box-shadow: 6px 6px 15px -3px rgba(0, 0, 0, 0.3); /* Bayangan luar tebal */
            transition: all 0.2s ease;
        }
        .custom-outer-shadow:active {
            box-shadow: 2px 2px 5px -1px rgba(0, 0, 0, 0.3);
            transform: scale(0.98); /* Efek tekan */
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
            .page-title { padding-top: 80px; }
            .page-title h1 { font-size: 2rem; }
            .edit-card { padding: 1.5rem; border-radius: 1.5rem; width: 95%; }
        }
    </style>
</head>
<body>

    {{-- LOGO KIRI ATAS --}}
    <div class="header-logos">
        <img src="{{ asset('images/Logo Batu.png') }}" alt="Logo Kota Batu">
        <img src="{{ asset('images/Germas.png') }}" alt="Logo Germas">
    </div>

    {{-- TOMBOL KEMBALI KANAN ATAS --}}
    <div class="back-container">
        {{-- Tombol kembali juga diberi efek custom-outer-shadow agar konsisten --}}
        <a href="{{ request()->query('from') == 'search' ? route('balitas.search', ['nik_balita' => $balita->nik_balita]) : route('balitas.index', ['page' => request()->query('page')]) }}" class="bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center transition backdrop-blur-sm border border-white/30 custom-outer-shadow">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
    </div>

    {{-- JUDUL HALAMAN TENGAH --}}
    <div class="w-full">
        <div class="page-title">
            <h1>EDIT DATA<br>BALITA</h1>
        </div>
        
        {{-- KARTU FORM --}}
        <div class="edit-card">
            <form id="edit-form" action="{{ route('balitas.update', $balita->nik_balita) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="page" value="{{ request('page') }}">
                <input type="hidden" name="from" value="{{ request('from') }}">
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- KOLOM KIRI --}}
                    <div class="space-y-5">
                        <div>
                            <label for="nik_balita" class="form-label">NIK Balita</label>
                            <input type="text" id="nik_balita" name="nik_balita" value="{{ old('nik_balita', $balita->nik_balita) }}" class="form-input" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <div>
                            <label for="nama_balita" class="form-label">Nama Balita</label>
                            <input type="text" id="nama_balita" name="nama_balita" value="{{ old('nama_balita', $balita->nama_balita) }}" class="form-input uppercase">
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-input cursor-pointer">
                                <option value="L" {{ old('jenis_kelamin', $balita->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $balita->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', $balita->tgl_lahir) }}" class="form-input">
                        </div>
                        <div>
                            <label for="nomor_kk" class="form-label">Nomor KK</label>
                            <input type="text" id="nomor_kk" name="nomor_kk" value="{{ old('nomor_kk', $balita->nomor_kk) }}" class="form-input" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <div>
                            <label for="nama_ortu" class="form-label">Nama Ortu</label>
                            <input type="text" id="nama_ortu" name="nama_ortu" value="{{ old('nama_ortu', $balita->nama_ortu) }}" class="form-input uppercase">
                        </div>
                        <div>
                            <label for="nik_ortu" class="form-label">NIK Ortu</label>
                            <input type="text" id="nik_ortu" name="nik_ortu" value="{{ old('nik_ortu', $balita->nik_ortu) }}" class="form-input" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <div>
                            <label for="hp_ortu" class="form-label">No. HP Ortu</label>
                            <input type="text" id="hp_ortu" name="hp_ortu" value="{{ old('hp_ortu', $balita->hp_ortu) }}" class="form-input" inputmode="numeric" pattern="[0-9]*">
                        </div>
                    </div>
            
                    {{-- KOLOM KANAN --}}
                    <div class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="rt" class="form-label">RT</label>
                                <input type="text" id="rt" name="rt" value="{{ old('rt', $balita->rt) }}" class="form-input text-center" inputmode="numeric">
                            </div>
                            <div>
                                <label for="rw" class="form-label">RW</label>
                                <input type="text" id="rw" name="rw" value="{{ old('rw', $balita->rw) }}" class="form-input text-center" inputmode="numeric">
                            </div>
                        </div>
                        <div>
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi" value="JAWA TIMUR" class="form-input bg-gray-200 cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label for="kab_kota" class="form-label">Kab/Kota</label>
                            <input type="text" id="kab_kota" name="kab_kota" value="KOTA BATU" class="form-input bg-gray-200 cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label for="kec" class="form-label">Kecamatan</label>
                            <select id="kec" name="kec" class="form-input cursor-pointer">
                                <option value="">Pilih Kecamatan</option>
                                <option value="BATU">Kecamatan Batu</option>
                                <option value="JUNREJO">Kecamatan Junrejo</option>
                                <option value="BUMIAJI">Kecamatan Bumiaji</option>
                            </select>
                        </div>
                        <div>
                            <label for="puskesmas" class="form-label">Puskesmas</label>
                            <select id="puskesmas" name="puskesmas" class="form-input cursor-pointer">
                                <option value="">Pilih Puskesmas</option>
                            </select>
                        </div>
                        <div>
                            <label for="desa_kel" class="form-label">Desa/Kel</label>
                            <select id="desa_kel" name="desa_kel" class="form-input cursor-pointer">
                                <option value="">Pilih Desa/Kelurahan</option>
                            </select>
                        </div>
                        <div>
                            <label for="posyandu" class="form-label">Posyandu</label>
                            <select id="posyandu" name="posyandu" class="form-input cursor-pointer">
                                <option value="">Pilih Posyandu</option>
                            </select>
                        </div>
                    </div>
                </div>
        
                {{-- TOMBOL SIMPAN (OUTER SHADOW) --}}
                <div class="pt-8">
                    {{-- Saya hapus 'shadow-lg' dan ganti dengan 'custom-outer-shadow' --}}
                    <button type="button" id="submit-button" class="w-full bg-[#009688] hover:bg-[#00796b] text-white font-black text-lg py-4 rounded-xl custom-outer-shadow transition transform hover:-translate-y-1 uppercase tracking-wider">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- --- MODALS (POP-UP) --- --}}

    {{-- Pop-up Sukses --}}
    @if(session('success'))
        <div id="successModal" class="modal" style="display: flex;">
            <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl transform scale-100 transition-transform duration-300">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100 mb-6">
                    <i class="fas fa-check text-green-500 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2">Berhasil!</h3>
                <p class="text-gray-500 mb-6">{{ session('success') }}</p>
                <button class="close-btn w-full bg-gray-200 text-gray-800 font-bold py-3 rounded-xl hover:bg-gray-300 transition custom-outer-shadow">Tutup</button>
            </div>
        </div>
    @endif

    {{-- Pop-up Error --}}
    @if(session('error') || $errors->any())
        <div id="errorModal" class="modal" style="display: flex;">
            <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-100 mb-6">
                    <i class="fas fa-times text-red-500 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2">Gagal!</h3>
                <p class="text-gray-500 mb-6">{{ session('error') ?? 'Data tidak valid. Periksa kembali isian Anda.' }}</p>
                <button class="close-btn w-full bg-gray-200 text-gray-800 font-bold py-3 rounded-xl hover:bg-gray-300 transition custom-outer-shadow">Tutup</button>
            </div>
        </div>
    @endif

    {{-- Pop-up Konfirmasi Simpan --}}
    <div id="confirmModal" class="modal">
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl animate-fade-in-up">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-yellow-100 mb-6">
                <i class="fas fa-question text-yellow-600 text-4xl"></i>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Simpan Perubahan?</h3>
            <p class="text-gray-500 mb-8 text-sm">Pastikan data yang Anda masukkan sudah benar sebelum menyimpan.</p>
            
            <div class="flex flex-col gap-3">
                {{-- Tombol Modal juga pakai outer shadow --}}
                <button id="confirm-save-btn" class="w-full bg-[#009688] hover:bg-[#00796b] text-white font-bold py-3 rounded-xl custom-outer-shadow transition">
                    Ya, Simpan
                </button>
                <button id="cancel-save-btn" class="w-full bg-gray-200 text-gray-700 font-bold py-3 rounded-xl hover:bg-gray-300 transition custom-outer-shadow">
                    Batal
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Modal Logic ---
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');
            const confirmModal = document.getElementById('confirmModal');
            const submitButton = document.getElementById('submit-button');
            const confirmSaveBtn = document.getElementById('confirm-save-btn');
            const cancelSaveBtn = document.getElementById('cancel-save-btn');
            const editForm = document.getElementById('edit-form');
            const closeBtns = document.querySelectorAll('.close-btn');

            // Close buttons functionality
            closeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    if(successModal) successModal.style.display = 'none';
                    if(errorModal) errorModal.style.display = 'none';
                });
            });

            // Klik di luar modal menutup modal
            window.onclick = function(event) {
                if (event.target == successModal) successModal.style.display = 'none';
                if (event.target == errorModal) errorModal.style.display = 'none';
                if (event.target == confirmModal) confirmModal.style.display = 'none';
            };
            
            // Konfirmasi Simpan
            if(submitButton) {
                submitButton.addEventListener('click', function() {
                    confirmModal.style.display = 'flex';
                });
            }

            if(confirmSaveBtn) {
                confirmSaveBtn.addEventListener('click', function() {
                    confirmModal.style.display = 'none';
                    editForm.submit();
                });
            }

            if(cancelSaveBtn) {
                cancelSaveBtn.addEventListener('click', function() {
                    confirmModal.style.display = 'none';
                });
            }

            // --- Lokasi Dropdown Logic (Sama seperti sebelumnya) ---
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
                        "BULUKERTO": ["MELATI", "KENANGA", "ANGGREK 1", "ANGGREK 222"],
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

            function populateDropdown(selectElement, options, placeholder) {
                selectElement.innerHTML = `<option value="">${placeholder}</option>`;
                options.forEach(option => {
                    const newOption = document.createElement('option');
                    newOption.value = option;
                    newOption.textContent = option;
                    selectElement.appendChild(newOption);
                });
            }

            function setSelectedValue(selectElement, value) {
                const option = Array.from(selectElement.options).find(opt => opt.value === value);
                if (option) option.selected = true;
            }
        
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

            // Initialize Dropdowns
            const balitaData = {
                kec: "{{ $balita->kec }}",
                puskesmas: "{{ $balita->puskesmas }}",
                desa_kel: "{{ $balita->desa_kel }}",
                posyandu: "{{ $balita->posyandu }}"
            };
            
            function initializeDropdowns() {
                if (balitaData.kec) {
                    kecSelect.value = balitaData.kec.toUpperCase();
                }

                if (balitaData.kec && dataLokasi[balitaData.kec.toUpperCase()]) {
                    const puskesmasOptions = Object.keys(dataLokasi[balitaData.kec.toUpperCase()]);
                    populateDropdown(puskesmasSelect, puskesmasOptions, 'Pilih Puskesmas');
                    if (balitaData.puskesmas) setSelectedValue(puskesmasSelect, balitaData.puskesmas.toUpperCase());
                }

                if (balitaData.kec && balitaData.puskesmas && dataLokasi[balitaData.kec.toUpperCase()] && dataLokasi[balitaData.kec.toUpperCase()][balitaData.puskesmas.toUpperCase()]) {
                    const desaOptions = Object.keys(dataLokasi[balitaData.kec.toUpperCase()][balitaData.puskesmas.toUpperCase()]);
                    populateDropdown(desaKelSelect, desaOptions, 'Pilih Desa/Kelurahan');
                    if (balitaData.desa_kel) setSelectedValue(desaKelSelect, balitaData.desa_kel.toUpperCase());
                }

                if (balitaData.kec && balitaData.puskesmas && balitaData.desa_kel && dataLokasi[balitaData.kec.toUpperCase()][balitaData.puskesmas.toUpperCase()][balitaData.desa_kel.toUpperCase()]) {
                    const posyanduOptions = dataLokasi[balitaData.kec.toUpperCase()][balitaData.puskesmas.toUpperCase()][balitaData.desa_kel.toUpperCase()];
                    populateDropdown(posyanduSelect, posyanduOptions, 'Pilih Posyandu');
                    if (balitaData.posyandu) setSelectedValue(posyanduSelect, balitaData.posyandu.toUpperCase());
                }
            }

            initializeDropdowns();

            // Numeric Input Only
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