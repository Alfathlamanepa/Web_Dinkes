<!DOCTYPE html>
<html>
<head>
    <title>Daftar Balita</title>
    
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

        /* Gaya untuk kartu balita */
        .card {
            border-left-width: 4px;
            border-left-style: solid;
        }
        .aman-border { border-color: #22c55e; }
        .mendekati-border { border-color: #f59e0b; }
        .lewat-border { border-color: #ef4444; }

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
    </style>
</head>
<body class="flex items-center justify-center p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg w-full">
        <div class="flex items-center mb-6">
            <a href="{{ route('balitas.status') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition-transform transform hover:scale-110">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">{{ $title }}</h1>
        </div>
        
        <div class="space-y-4">
            @if(count($filteredBalitas) > 0)
                @foreach($filteredBalitas as $balita)
                <div class="bg-white p-6 rounded-lg shadow-md card 
                    @if(str_contains($title, 'Aman'))
                        aman-border
                    @elseif(str_contains($title, 'Hampir Batas'))
                        mendekati-border
                    @elseif(str_contains($title, 'Lewat Batas'))
                        lewat-border
                    @endif
                    " data-tgl-lahir="{{ $balita->tgl_lahir }}">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $balita->nama_balita }}</h2>
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-id-card"></i> {{ $balita->nik_balita }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-1 age-display">
                        <i class="fas fa-baby"></i> <strong>Umur:</strong>
                    </p>
                    <p class="text-gray-600 mb-1">
                        <i class="fas fa-calendar-alt"></i> <strong>Tanggal Lahir:</strong> {{ $balita->tgl_lahir }}
                    </p>
                    <p class="text-gray-600 mb-1">
                        <i class="fas fa-user-friends"></i> <strong>Nama Ortu:</strong> {{ $balita->nama_ortu }}
                    </p>
                    <p class="text-gray-600">
                        <i class="fas fa-phone-alt"></i> <strong>No. HP Ortu:</strong> {{ $balita->hp_ortu }}
                    </p>
                    @if(str_contains($title, 'Lewat Batas'))
                        <div class="mt-4 flex justify-end">
                            <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition duration-200 delete-btn" data-nik="{{ $balita->nik_balita }}">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </div>
                    @endif
                </div>
                @endforeach
            @else
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <p class="text-gray-500 font-semibold">Tidak ada data balita untuk status ini.</p>
            </div>
            @endif
        </div>
    </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const balitaCards = document.querySelectorAll('.card');
            
            // =========================================================
            // Bagian 1: Logika Perhitungan Umur
            // =========================================================
            balitaCards.forEach(card => {
                const tanggalLahir = card.dataset.tglLahir;
                if (!tanggalLahir) {
                    return;
                }

                const birthDate = new Date(tanggalLahir);
                const today = new Date();

                let years = today.getFullYear() - birthDate.getFullYear();
                let months = today.getMonth() - birthDate.getMonth();
                let days = today.getDate() - birthDate.getDate();

                // Penyesuaian bulan dan tahun jika hari atau bulan kurang dari 0
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
                const ageDisplay = card.querySelector('.age-display');
                if (ageDisplay) {
                    ageDisplay.innerHTML = `<i class="fas fa-baby"></i> <strong>Umur:</strong> ${totalMonths} bulan, ${days} hari`;
                }
            });

            // =========================================================
            // Bagian 2: Logika Modal Konfirmasi Hapus
            // =========================================================
            const deleteModal = document.getElementById('deleteModal');
            const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
            const deleteFormModal = document.getElementById('delete-form-modal');
            const deleteButtons = document.querySelectorAll('.delete-btn');
            
            // Tambahkan event listener ke setiap tombol hapus
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nik = this.getAttribute('data-nik');
                    const url = `{{ url('balitas') }}/${nik}`;
                    deleteFormModal.action = url;
                    deleteModal.style.display = 'flex';
                });
            });

            // Sembunyikan modal saat tombol 'Batal' diklik
            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.style.display = 'none';
            });

            // Sembunyikan modal jika pengguna mengklik di luar area modal
            window.onclick = function(event) {
                if (event.target === deleteModal) {
                    deleteModal.style.display = 'none';
                }
            };
        });
    </script>
</body>
</html>