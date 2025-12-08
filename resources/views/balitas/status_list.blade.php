<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- FontAwesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* --- GAYA DASAR --- */
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            position: relative;
            background: linear-gradient(-45deg, #008080, #4BCFCA, #87D9D6, #99E600);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            padding: 0.5rem; /* Padding body dikurangi untuk HP */
        }

        @media (min-width: 640px) {
            body { padding: 1rem; }
        }

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
        .header-logos img {
            height: 40px; width: auto; /* Ukuran mobile default */
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }
        @media (min-width: 640px) {
            .header-logos { top: 25px; left: 25px; gap: 15px; }
            .header-logos img { height: 80px; }
        }

        /* Back Button */
        .back-container {
            position: absolute;
            top: 15px; right: 15px;
            z-index: 20;
        }
        @media (min-width: 640px) {
            .back-container { top: 25px; right: 25px; }
        }

        /* Page Title */
        .page-title {
            text-align: center;
            padding-top: 80px;
            margin-bottom: 1.5rem;
            position: relative; z-index: 10;
        }
        .page-title h1 {
            font-size: 1.5rem; /* Font judul lebih kecil di HP */
            font-weight: 900; color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-transform: uppercase; letter-spacing: 1px;
            line-height: 1.2;
            padding: 0 1rem;
        }
        @media (min-width: 640px) {
            .page-title { padding-top: 120px; margin-bottom: 2rem; }
            .page-title h1 { font-size: 2.5rem; }
        }

        /* Main Card Container */
        .index-card {
            background-color: white;
            border-radius: 1.5rem;
            padding: 1rem; /* Padding container lebih kecil di HP */
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1100px;
            margin: 0 auto 50px auto;
            position: relative; z-index: 10;
            min-height: 500px;
        }
        @media (min-width: 640px) {
            .index-card { border-radius: 2rem; padding: 2.5rem; }
        }

        .custom-outer-shadow {
            box-shadow: 4px 4px 10px -2px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }
        .custom-outer-shadow:active { transform: scale(0.95); }

        /* Animation */
        .fade-in { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    {{-- HEADER LOGOS --}}
    <div class="header-logos">
        <img src="{{ asset('images/Logo Batu.png') }}" alt="Logo Kota Batu">
        <img src="{{ asset('images/Germas.png') }}" alt="Logo Germas">
    </div>

    {{-- TOMBOL KEMBALI --}}
    <div class="back-container">
        <a href="{{ route('balitas.status', request()->all()) }}" class="bg-white/20 hover:bg-white/40 text-white rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center transition backdrop-blur-sm border border-white/30 custom-outer-shadow">
            <i class="fas fa-arrow-left text-lg sm:text-xl"></i>
        </a>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="w-full">
        <div class="page-title">
            <h1>{{ $title }}</h1>
        </div>

        <div class="index-card">
            
            {{-- GRID CONTAINER --}}
            <div id="data-container" class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 min-h-[400px]">
                @if(count($filteredBalitas) > 0)
                    @foreach($filteredBalitas as $balita)
                        
                        {{-- Logic Warna --}}
                        @php
                            $borderColor = 'border-gray-200';
                            $bgColor = 'bg-white';
                            $iconColor = 'text-gray-500';
                            $bgIcon = 'bg-gray-100';

                            if(str_contains($title, 'Aman')) {
                                $borderColor = 'border-l-4 sm:border-l-8 border-green-500';
                                $bgColor = 'hover:bg-green-50';
                                $iconColor = 'text-green-600';
                                $bgIcon = 'bg-green-100';
                            } elseif(str_contains($title, 'Hampir Batas')) {
                                $borderColor = 'border-l-4 sm:border-l-8 border-yellow-400';
                                $bgColor = 'hover:bg-yellow-50';
                                $iconColor = 'text-yellow-600';
                                $bgIcon = 'bg-yellow-100';
                            } elseif(str_contains($title, 'Lewat Batas')) {
                                $borderColor = 'border-l-4 sm:border-l-8 border-red-500';
                                $bgColor = 'hover:bg-red-50';
                                $iconColor = 'text-red-600';
                                $bgIcon = 'bg-red-100';
                            }
                        @endphp

                        {{-- CARD ITEM --}}
                        <div class="card-item relative bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 sm:p-6 {{ $borderColor }} {{ $bgColor }} border border-gray-100 flex flex-col justify-between" style="display: none;" data-tgl-lahir="{{ $balita->tgl_lahir }}">
                            
                            {{-- HEADER KARTU (Layout Mobile Optimized) --}}
                            <div class="mb-3 border-b border-gray-100 pb-3">
                                <div class="flex items-start gap-3 w-full">
                                    {{-- Icon Bayi --}}
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full {{ $bgIcon }} flex items-center justify-center shrink-0 mt-1">
                                        <i class="fas fa-baby {{ $iconColor }} text-lg sm:text-2xl"></i>
                                    </div>

                                    {{-- Nama & NIK (Gunakan min-w-0 agar text wrap berfungsi) --}}
                                    <div class="flex-1 min-w-0">
                                        {{-- break-words penting agar nama panjang turun ke bawah --}}
                                        <h2 class="text-base sm:text-xl font-black text-gray-800 uppercase break-words leading-tight mb-1">
                                            {{ $balita->nama_balita }}
                                        </h2>
                                        <span class="text-gray-500 text-xs sm:text-sm font-semibold tracking-wide flex items-center">
                                            <i class="fas fa-id-card mr-1 text-xs"></i> {{ $balita->nik_balita }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Kotak Umur (Full Width di Mobile agar terbaca) --}}
                                <div class="mt-3 w-full bg-gray-50 border border-gray-200 px-3 py-2 rounded-lg flex justify-between items-center sm:hidden">
                                    <span class="text-xs text-gray-400 font-bold uppercase">UMUR</span>
                                    <span class="text-gray-800 font-bold age-display text-sm">...</span>
                                </div>
                                
                                {{-- Kotak Umur (Tampilan Desktop - Hidden di Mobile) --}}
                                <div class="hidden sm:block absolute top-6 right-6 bg-white border border-gray-200 px-3 py-1.5 rounded-lg shadow-sm text-center">
                                    <span class="block text-[10px] text-gray-400 font-bold uppercase">Umur</span>
                                    <span class="text-gray-700 font-bold age-display text-base">...</span>
                                </div>
                            </div>

                            {{-- DETAIL DATA --}}
                            <div class="grid grid-cols-1 gap-2 text-sm text-gray-600">
                                <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-white/50 transition">
                                    <div class="w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 text-xs shrink-0"><i class="fas fa-calendar-alt"></i></div>
                                    <div class="min-w-0">
                                        <span class="block text-[10px] text-gray-400 uppercase font-bold leading-none mb-0.5">Lahir</span>
                                        <span class="font-bold text-gray-700 text-xs sm:text-sm truncate block">{{ \Carbon\Carbon::parse($balita->tgl_lahir)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-white/50 transition">
                                    <div class="w-6 h-6 rounded-full bg-purple-50 flex items-center justify-center text-purple-500 text-xs shrink-0"><i class="fas fa-user-friends"></i></div>
                                    <div class="min-w-0">
                                        <span class="block text-[10px] text-gray-400 uppercase font-bold leading-none mb-0.5">Orang Tua</span>
                                        <span class="font-bold text-gray-700 text-xs sm:text-sm truncate block">{{ $balita->nama_ortu }}</span>
                                    </div>
                                </div>
                            </div>

                            @if(str_contains($title, 'Lewat Batas'))
                                <div class="mt-4 pt-3 border-t border-gray-100 flex justify-end">
                                    <form action="{{ route('balitas.destroy', $balita->nik_balita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="w-full sm:w-auto">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full sm:w-auto justify-center bg-red-50 text-red-600 px-4 py-2.5 rounded-lg text-sm font-bold hover:bg-red-600 hover:text-white transition duration-200 flex items-center gap-2">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="col-span-1 lg:col-span-2 text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 mx-2">
                        <i class="fas fa-clipboard-list text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 font-bold text-lg">Tidak ada data balita.</p>
                    </div>
                @endif
            </div>

            {{-- PAGINATION CONTROLS --}}
            <div id="pagination-controls" class="mt-8 flex justify-center items-center gap-2 flex-wrap px-2"></div>
            <div class="text-center mt-4 text-xs text-gray-400 font-semibold" id="page-info"></div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card-item');
            
            // Konfigurasi: 10 Data per halaman
            const itemsPerPage = 10; 
            
            let currentPage = 1;
            const totalPages = Math.ceil(cards.length / itemsPerPage);
            
            const container = document.getElementById('data-container');
            const paginationContainer = document.getElementById('pagination-controls');
            const pageInfo = document.getElementById('page-info');

            // 1. Hitung Umur
            cards.forEach(card => {
                const tanggalLahir = card.dataset.tglLahir;
                if (!tanggalLahir) return;
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
                if (months < 0) { years--; months += 12; }
                const totalMonths = (years * 12) + months;
                
                // Update tampilan umur (Mobile & Desktop class age-display)
                const ageDisplays = card.querySelectorAll('.age-display');
                ageDisplays.forEach(el => {
                    el.textContent = `${totalMonths} Bln ${days} Hr`;
                    // Hapus class warna lama jika ada
                    el.classList.remove('text-red-600', 'text-yellow-600', 'text-green-600');
                    
                    if(totalMonths >= 60) el.classList.add('text-red-600');
                    else if (totalMonths >= 58) el.classList.add('text-yellow-600');
                    else el.classList.add('text-green-600');
                });
            });

            // 2. Pagination Logic
            function showPage(page) {
                if (cards.length === 0) return;
                
                cards.forEach(card => {
                    card.style.display = 'none';
                    card.classList.remove('fade-in');
                });

                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;

                for (let i = start; i < end; i++) {
                    if (cards[i]) {
                        // Tambahkan flex agar layout card benar saat dimunculkan
                        cards[i].style.display = 'flex'; 
                        void cards[i].offsetWidth; 
                        cards[i].classList.add('fade-in');
                    }
                }
                
                renderPaginationButtons();
                updateInfo();
            }

            function renderPaginationButtons() {
                paginationContainer.innerHTML = '';
                if (totalPages <= 1) return;

                const prevBtn = createButton('<i class="fas fa-chevron-left"></i>', currentPage > 1, () => changePage(currentPage - 1));
                paginationContainer.appendChild(prevBtn);

                // Logic dot-dot (...) untuk pagination banyak
                for (let i = 1; i <= totalPages; i++) {
                     if (totalPages > 5 && (i !== 1 && i !== totalPages && Math.abs(currentPage - i) > 1)) {
                         if (i === 2 || i === totalPages - 1) {
                            const dots = document.createElement('span');
                            dots.className = 'px-1 text-gray-400 text-xs';
                            dots.innerText = '...';
                            paginationContainer.appendChild(dots);
                         }
                         continue;
                     }
                     
                     const btn = createButton(i, true, () => changePage(i));
                     if (i === currentPage) {
                         btn.classList.add('bg-[#009688]', 'text-white', 'border-[#009688]');
                         btn.classList.remove('bg-white', 'text-gray-600', 'hover:bg-gray-100');
                     }
                     paginationContainer.appendChild(btn);
                }

                const nextBtn = createButton('<i class="fas fa-chevron-right"></i>', currentPage < totalPages, () => changePage(currentPage + 1));
                paginationContainer.appendChild(nextBtn);
            }

            function createButton(content, isEnabled, onClick) {
                const btn = document.createElement('button');
                btn.innerHTML = content;
                // Tombol sedikit lebih kecil di HP
                btn.className = `w-8 h-8 sm:w-10 sm:h-10 rounded-lg font-bold border border-gray-300 transition flex items-center justify-center custom-outer-shadow text-sm ${isEnabled ? 'bg-white text-gray-600 hover:bg-gray-100 cursor-pointer' : 'bg-gray-100 text-gray-300 cursor-not-allowed'}`;
                if (isEnabled) {
                    btn.addEventListener('click', onClick);
                } else {
                    btn.disabled = true;
                }
                return btn;
            }

            function changePage(newPage) {
                if (newPage < 1 || newPage > totalPages) return;
                currentPage = newPage;
                showPage(currentPage);
                // Scroll sedikit ke atas kontainer data agar user sadar halaman berubah
                const yOffset = -100; 
                const y = container.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({top: y, behavior: 'smooth'});
            }
            
            function updateInfo() {
                if(cards.length > 0) {
                    pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages} (${cards.length} Data)`;
                }
            }

            showPage(1);
        });
    </script>
</body>
</html>