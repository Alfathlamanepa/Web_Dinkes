<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Balita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Impor font dari Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        
        /* Gaya dasar body dengan gradien animasi */
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

        /* Gaya tombol pencarian dengan efek transisi */
        .btn-cari {
            transition: all 0.2s ease-in-out;
            transform: scale(1);
        }
        .btn-cari:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .btn-cari:active {
            transform: scale(0.95);
        }

        /* Gaya modal (pop-up) untuk notifikasi */
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

        /* Gaya tombol aksi dengan efek transisi */
        .btn-action {
            transition: all 0.2s ease-in-out;
            transform: scale(1);
        }
        .btn-action:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .btn-action:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body class="p-8 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-2xl shadow-2xl max-w-xl w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Cari Balita</h1>
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <i class="fas fa-home text-2xl"></i>
            </a>
        </div>

        <form action="{{ route('balitas.search') }}" method="GET" class="mb-6">
            <div class="flex items-center space-x-2">
                <input type="text" id="nik_input" name="nik_balita" placeholder="Masukkan NIK Balita" class="flex-grow rounded-xl border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ request('nik_balita') }}">
                <button type="submit" class="btn-cari inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white" style="background-color: #008080; hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors duration-200">
                    Cari
                </button>
            </div>
        </form>

        @if(request('nik_balita'))
            <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Hasil Pencarian</h2>
            @if($balita)
                <div class="p-6 rounded-xl border-2 border-green-400 shadow-lg">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $balita->nama_balita }}</h3>
                            <p class="text-sm text-gray-500">NIK: {{ $balita->nik_balita }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <strong>Nama Ortu:</strong> <span class="font-normal">{{ $balita->nama_ortu }}</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <strong>Tanggal Lahir:</strong> <span class="font-normal">{{ $balita->tgl_lahir }}</span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg col-span-1 md:col-span-2">
                            <strong>Alamat:</strong> <span class="font-normal">{{ $balita->provinsi }}, {{ $balita->kab_kota }}, {{ $balita->kec }}, {{ $balita->desa_kel }}</span>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-2">
                        <a href="{{ route('balitas.show', ['balita' => $balita->nik_balita, 'from' => 'search']) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white btn-action" style="background-color: #008080; hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors duration-200">
                            Lihat Detail
                        </a>
                        <a href="{{ route('balitas.edit', ['balita' => $balita->nik_balita, 'from' => 'search']) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white btn-action" style="background-color: #99E600; hover:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500 transition-colors duration-200">
                            Edit Data Balita
                        </a>
                    </div>
                </div>
            @else
                <div id="notFoundModal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn">&times;</span>
                        <div class="p-4 text-center">
                            <i class="fas fa-times-circle text-red-500 text-5xl mb-4"></i>
                            <p class="text-xl text-red-600 font-semibold mb-4">Data balita tidak ditemukan.</p>
                            <p class="text-gray-500 mb-6">NIK yang Anda masukkan tidak terdaftar dalam sistem.</p>
                            <a href="{{ route('balitas.create') }}" class="inline-block bg-green-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-800 transition duration-200">
                                <i class="fas fa-plus-circle mr-2"></i> Tambah Data Balita
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="bg-gray-50 p-6 rounded-lg text-center shadow-inner">
                <p class="text-gray-500">Silakan masukkan NIK untuk memulai pencarian.</p>
            </div>
        @endif
        
        <div class="mt-6 text-center">
            <a href="{{ url('/') }}" class="text-green-800 hover:text-indigo-900 font-medium transition-colors duration-200">Kembali ke Menu Utama</a>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =========================================================
            // Bagian 1: Logika Validasi dan Modal
            // =========================================================
            const nikInput = document.getElementById('nik_input');
            const notFoundModal = document.getElementById('notFoundModal');
            const closeBtn = document.querySelector('.close-btn');
    
            // Memastikan input NIK hanya menerima karakter numerik
            if (nikInput) {
                nikInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }

            // Tampilkan modal 'tidak ditemukan' jika kondisi terpenuhi (ada NIK di URL tapi data null)
            @if(request('nik_balita') && !$balita)
                notFoundModal.style.display = 'flex';
            @endif

            // Sembunyikan modal saat tombol tutup diklik
            if (closeBtn) {
                closeBtn.onclick = function() {
                    notFoundModal.style.display = 'none';
                }
            }
    
            // Sembunyikan modal saat pengguna mengklik di luar area modal
            window.onclick = function(event) {
                if (event.target === notFoundModal) {
                    notFoundModal.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>