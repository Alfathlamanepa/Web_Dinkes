<!DOCTYPE html>
<html>
<head>
    <title>Detail Data Balita</title>
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
    <div class="bg-white p-8 rounded-3xl shadow-2xl max-w-4xl w-full">
        @if ($balita)
            <div class="flex justify-between items-center border-b pb-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Detail Balita</h1>
                
                {{-- Tombol Kembali yang Cerdas --}}
                <a href="{{ request()->query('from') == 'search' ? route('balitas.search', ['nik_balita' => $balita->nik_balita]) : route('balitas.index', ['page' => request()->query('page')]) }}" 
                   class="text-gray-600 hover:text-gray-800 transition duration-200 font-semibold"
                   title="Kembali ke Halaman Sebelumnya">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                {{-- Akhir Tombol Kembali Cerdas --}}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-teal-600 mb-4 border-b pb-2">Data Identitas Balita</h2>
                    <dl class="space-y-3">
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">NIK Balita</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900 w-2/3">{{ $balita->nik_balita }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Nama Balita</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900 w-2/3">{{ $balita->nama_balita }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Tanggal Lahir</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ \Carbon\Carbon::parse($balita->tgl_lahir)->format('d F Y') }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Umur (Realtime)</dt>
                            <dd class="mt-1 text-sm font-bold text-teal-600 w-2/3" id="realtime-umur" data-tgl-lahir="{{ $balita->tgl_lahir }}">
                                <i class="fas fa-spinner fa-spin mr-2 animate-pulse"></i>Menghitung...
                            </dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Jenis Kelamin</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Nomor KK</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->nomor_kk ?? '-' }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Status Usia</dt>
                            <dd class="mt-1 text-sm font-bold w-2/3" id="age-status">Status...</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-teal-600 mb-4 border-b pb-2">Data Orang Tua & Wilayah</h2>
                    <dl class="space-y-3">
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Nama Orang Tua</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->nama_ortu }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">NIK Orang Tua</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->nik_ortu ?? '-' }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">No. HP Orang Tua</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->hp_ortu ?? '-' }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Provinsi / Kota</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->provinsi }} / {{ $balita->kab_kota }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Kecamatan</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->kec }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Desa / Posyandu</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->desa_kel }} / {{ $balita->posyandu }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">Puskesmas</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->puskesmas }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="text-sm font-medium text-gray-500 w-1/3">RT / RW</dt>
                            <dd class="mt-1 text-sm text-gray-900 w-2/3">{{ $balita->rt ?? '-' }} / {{ $balita->rw ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="mt-8 border-t pt-4">
                <h2 class="text-xl font-semibold text-teal-600 mb-4 border-b pb-2">Informasi Waktu Data</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Data Dibuat Pada (created_at)</dt>
                        <dd class="mt-1 text-sm font-semibold text-gray-900">
                            {{ $balita->created_at ? $balita->created_at->format('d F Y, H:i:s') : 'N/A' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Terakhir Diubah Pada (updated_at)</dt>
                        <dd class="mt-1 text-sm font-semibold text-gray-900">
                            {{ $balita->updated_at ? $balita->updated_at->format('d F Y, H:i:s') : 'N/A' }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('balitas.edit', ['balita' => $balita->nik_balita, 'from' => request('from'), 'page' => request('page')]) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                    <i class="fas fa-edit mr-2"></i> Edit Data
                </a>
                
                {{-- Tombol untuk memicu Modal Hapus --}}
                <button type="button" id="delete-button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Data
                </button>
            </div>

            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <div class="p-4 text-center">
                        <i class="fas fa-trash-alt text-red-600 text-5xl mb-4"></i>
                        <p class="text-xl text-gray-800 font-semibold mb-2">Konfirmasi Hapus</p>
                        <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus data balita ini?</p>
                        <div class="flex justify-center space-x-4">
                            <form id="delete-form-modal" method="POST" action="{{ route('balitas.destroy', $balita->nik_balita) }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="page" value="{{ request('page') }}">
                                <button type="submit" class="bg-red-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    Ya, Hapus
                                </button>
                            </form>
                            <button id="cancel-delete-btn" class="bg-gray-400 text-white font-bold px-6 py-2 rounded-lg hover:bg-gray-500 transition-colors duration-200">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Akhir Modal Konfirmasi Hapus --}}

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Logika Umur (Dipertahankan sama)
                    const realtimeUmurElement = document.getElementById('realtime-umur');
                    const ageStatusElement = document.getElementById('age-status');
                    const tglLahir = realtimeUmurElement.getAttribute('data-tgl-lahir');
                    const birthDate = new Date(tglLahir);
                    
                    if (!isNaN(birthDate.getTime())) {
                        const calculateAge = () => {
                            const today = new Date();
                            let totalMonths = 0;
                            let isOverAge = false;

                            let birthYear = birthDate.getFullYear();
                            let birthMonth = birthDate.getMonth();
                            let birthDay = birthDate.getDate();

                            let currentYear = today.getFullYear();
                            let currentMonth = today.getMonth();
                            let currentDay = today.getDate();

                            totalMonths = (currentYear - birthYear) * 12 + (currentMonth - birthMonth);

                            if (currentDay < birthDay) {
                                totalMonths--;
                            }
                            
                            if (totalMonths >= 60) {
                                isOverAge = true;
                            }

                            let diffMonths = totalMonths;
                            let diffDays = currentDay - birthDay;

                            if (diffDays < 0) {
                                diffMonths--;
                                let tempDate = new Date(today);
                                tempDate.setDate(0);
                                diffDays = tempDate.getDate() - birthDay + currentDay;
                            }
                            
                            realtimeUmurElement.textContent = `${diffMonths} bulan ${diffDays} hari`;
                            realtimeUmurElement.classList.remove('animate-pulse');
                
                            if (isOverAge) {
                                ageStatusElement.textContent = 'Usia balita sudah lewat dari batas aman (≥ 60 bulan).';
                                ageStatusElement.classList.add('text-red-600');
                                ageStatusElement.classList.remove('text-blue-500', 'text-yellow-500');
                            } else if (totalMonths >= 58 && totalMonths < 60) {
                                ageStatusElement.textContent = 'Usia balita mendekati batas aman (58-59 bulan).';
                                ageStatusElement.classList.add('text-yellow-600');
                                ageStatusElement.classList.remove('text-blue-500', 'text-red-500');
                            } else {
                                ageStatusElement.textContent = 'Usia balita masih dalam batas aman (< 58 bulan).';
                                ageStatusElement.classList.add('text-blue-600');
                                ageStatusElement.classList.remove('text-red-500', 'text-yellow-500');
                            }
                        };
                        calculateAge();
                    }


                    // Logika Modal Hapus
                    const deleteModal = document.getElementById('deleteModal');
                    const deleteButton = document.getElementById('delete-button');
                    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
                    
                    deleteButton.addEventListener('click', function() {
                        deleteModal.style.display = 'flex';
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
        @else
            <p class="text-gray-600 text-center">Data balita tidak ditemukan.</p>
        @endif
    </div>
</body>
</html>