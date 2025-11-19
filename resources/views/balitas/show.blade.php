<!DOCTYPE html>
<html>
<head>
    <title>Detail Data Balita</title>
    
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
    </style>
</head>
<body class="p-8 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-3xl shadow-2xl max-w-4xl w-full">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Detail Data Balita</h1>
            <a href="{{ request()->query('from') == 'search' ? route('balitas.search', ['nik_balita' => $balita->nik_balita]) : route('balitas.index', ['page' => request()->query('page')]) }}" id="back-button" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left text-2xl transform transition-transform duration-200 hover:scale-110"></i>
            </a>
        </div>
        
        @if($balita)
            <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="font-semibold text-gray-700">NIK Balita: <span class="font-normal text-gray-900">{{ $balita->nik_balita }}</span></p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="font-semibold text-gray-700">Nama Balita: <span class="font-normal text-gray-900">{{ $balita->nama_balita }}</span></p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="font-semibold text-gray-700">Nama Ortu: <span class="font-normal text-gray-900">{{ $balita->nama_ortu }}</span></p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="font-semibold text-gray-700">NIK Ortu: <span class="font-normal text-gray-900">{{ $balita->nik_ortu }}</span></p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="font-semibold text-gray-700">HP Ortu: <span class="font-normal text-gray-900">{{ $balita->hp_ortu }}</span></p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="font-semibold text-gray-700">Tanggal Lahir: <span id="tgl_lahir_display" class="font-normal text-gray-900">{{ $balita->tgl_lahir }}</span></p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center">
                    <p class="font-semibold text-gray-700">Terakhir Diedit: <span class="font-normal text-gray-900">{{ \Carbon\Carbon::parse($balita->updated_at)->format('d-m-Y H:i:s') }}</span></p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fas fa-calendar-alt text-2xl text-teal-600"></i>
                        <h3 class="text-2xl font-semibold text-gray-800">Umur Balita</h3>
                    </div>
                    <div class="bg-teal-50 p-4 rounded-lg text-center">
                        <p id="realtime-umur" class="text-4xl font-extrabold text-teal-600">Menghitung...</p>
                    </div>
                    <p id="age-status" class="mt-4 text-center font-bold text-lg"></p>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fas fa-map-marker-alt text-2xl text-lime-600"></i>
                        <h3 class="text-2xl font-semibold text-gray-800">Lokasi</h3>
                    </div>
                    <div class="bg-lime-50 p-4 rounded-lg">
                        <p class="font-semibold text-gray-700">RT/RW: <span class="font-normal text-gray-900">{{ $balita->rt }}/{{ $balita->rw }}</span></p>
                        <p class="font-semibold text-gray-700">Desa/Kel: <span class="font-normal text-gray-900">{{ $balita->desa_kel }}</span></p>
                        <p class="font-semibold text-gray-700">Kecamatan: <span class="font-normal text-gray-900">{{ $balita->kec }}</span></p>
                        <p class="font-semibold text-gray-700">Puskesmas: <span class="font-normal text-gray-900">{{ $balita->puskesmas }}</span></p>
                        <p class="font-semibold text-gray-700">Posyandu: <span class="font-normal text-gray-900">{{ $balita->posyandu }}</span></p>
                        <p class="font-semibold text-gray-700">Kabupaten/Kota: <span class="font-normal text-gray-900">{{ $balita->kab_kota }}</span></p>
                        <p class="font-semibold text-gray-700">Provinsi: <span class="font-normal text-gray-900">{{ $balita->provinsi }}</span></p>
                    </div>
                </div>
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const tglLahirElement = document.getElementById('tgl_lahir_display');
                    const ageStatusElement = document.getElementById('age-status');
                    const realtimeUmurElement = document.getElementById('realtime-umur');

                    // Pastikan elemen-elemen DOM ditemukan sebelum melanjutkan
                    if (!tglLahirElement || !ageStatusElement || !realtimeUmurElement) {
                        console.error("Salah satu elemen DOM tidak ditemukan. Proses kalkulasi umur dibatalkan.");
                        return;
                    }

                    const tanggalLahir = tglLahirElement.textContent.trim();
                    const today = new Date();
                    const birthDate = new Date(tanggalLahir);
        
                    // Hitung selisih tahun, bulan, dan hari
                    let years = today.getFullYear() - birthDate.getFullYear();
                    let months = today.getMonth() - birthDate.getMonth();
                    let days = today.getDate() - birthDate.getDate();
        
                    // Penyesuaian bulan dan tahun jika hari atau bulan kurang dari 0
                    if (days < 0) {
                        months--;
                        const lastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
                        days = lastMonth.getDate() - birthDate.getDate() + today.getDate();
                    }
                    if (months < 0) {
                        years--;
                        months += 12;
                    }

                    // Total bulan untuk penentuan status umur
                    const totalMonths = (years * 12) + months;
                    // Logika untuk menentukan apakah balita sudah melewati batas usia aman (60 bulan)
                    const isOverAge = totalMonths > 59 || (totalMonths === 59 && days > 0);
                    
                    // Tampilkan umur secara real-time
                    realtimeUmurElement.textContent = `${totalMonths} bulan, ${days} hari`;
                    
                    // Tentukan dan tampilkan status umur berdasarkan total bulan
                    if (isOverAge) {
                        ageStatusElement.textContent = 'Usia balita sudah lewat dari batas aman.';
                        ageStatusElement.classList.add('text-red-500');
                    } else if (totalMonths >= 58) {
                        ageStatusElement.textContent = 'Usia balita mendekati batas aman.';
                        ageStatusElement.classList.add('text-yellow-500');
                    } else {
                        ageStatusElement.textContent = 'Usia balita masih dalam batas aman.';
                        ageStatusElement.classList.add('text-blue-500');
                    }
                });
            </script>
        @else
            <p class="text-gray-600 text-center">Data balita tidak ditemukan.</p>
        @endif
    </div>
</body>
</html>