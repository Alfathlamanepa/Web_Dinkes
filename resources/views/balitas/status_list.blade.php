<!DOCTYPE html>
<html>
<head>
    <title>Daftar Balita</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        .card {
            border-left-width: 4px;
            border-left-style: solid;
        }
        .aman-border { border-color: #22c55e; }
        .mendekati-border { border-color: #f59e0b; }
        .lewat-border { border-color: #ef4444; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                            <form action="{{ route('balitas.destroy', $balita->nik_balita) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition duration-200">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const balitaCards = document.querySelectorAll('.card');

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
        });
    </script>
</body>
</html>