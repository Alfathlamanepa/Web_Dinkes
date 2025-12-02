<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Verifikasi Data Balita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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

        .login-card {
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            background-color: white;
            transition: transform 0.3s ease-in-out;
            max-width: 450px;
            width: 100%;
        }

        .login-card:hover {
            transform: scale(1.02);
        }
        
        .btn-login {
            background-color: #008080;
            color: white;
            font-weight: bold;
            border-radius: 0.75rem;
            transition: transform 0.2s ease-in-out;
        }

        .btn-login:hover {
            transform: scale(1.03);
            background-color: #0a4545ff;
        }

        .input-field {
            border-radius: 0.75rem;
            border-width: 2px;
            border-color: #d1d5db;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease-in-out;
            padding: 0.5rem 1rem;
            width: 100%;
        }

        .input-field:focus {
            outline: none;
            border-color: #008080;
            box-shadow: 0 0 0 3px rgba(5, 111, 102, 0.5);
        }

        /* Perbaikan untuk mobile */
        @media (max-width: 640px) {
            .login-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="p-8">

    <div class="login-card">
        <div class="text-center mb-8">
            <i class="fas fa-user-shield text-6xl text-teal-600 mb-2"></i>
            <h1 class="text-3xl font-bold text-gray-800">Login Admin</h1>
            <h2 class="text-lg text-gray-500">Verifikasi Data Balita DINKES</h2>
        </div>

        {{-- Form Login: Menggunakan route 'login' --}}
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            {{-- PERBAIKAN: Input hanya untuk Email --}}
            <div>
                {{-- Label diubah menjadi hanya Email --}}
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                {{-- Tipe input diubah ke email dan placeholder diubah --}}
                <input type="email" id="username" name="username" class="input-field" placeholder="Masukkan Email Anda" required autofocus>
                
                {{-- Menampilkan error untuk field 'username' (yang di-map ke email di Controller) --}}
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Input --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" class="input-field" placeholder="Masukkan Password" required>
                
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Login --}}
            <button type="submit" class="btn-login w-full px-6 py-3 shadow-lg flex items-center justify-center">
                <i class="fas fa-sign-in-alt mr-2"></i> MASUK
            </button>
        </form>
        
    </div>
</body>
</html>