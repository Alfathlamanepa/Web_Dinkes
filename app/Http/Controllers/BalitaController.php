<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BalitaController extends Controller
{
    // Tampilkan halaman welcome
    public function index()
    {
        return view('welcome');
    }

    // Tampilkan semua data balita dengan paginasi dan filter
    public function data(Request $request)
    {
        $query = Balita::query();

        if ($request->filled('kec')) {
            $query->where('kec', $request->input('kec'));
        }
        if ($request->filled('puskesmas')) {
            $query->where('puskesmas', $request->input('puskesmas'));
        }
        if ($request->filled('desa_kel')) {
            $query->where('desa_kel', $request->input('desa_kel'));
        }

        // Perbaikan: Urutkan data berdasarkan nama balita
        $query->orderBy('nama_balita', 'asc');

        $balitas = $query->paginate(30)->appends($request->query());

        return view('balitas.index', compact('balitas'));
    }

    // Tampilkan form untuk menambah data baru
    public function create()
    {
        return view('balitas.create');
    }

    /**
     * Simpan data baru ke database.
     * Perbaikan: Redirect ke halaman CREATE (tambah data) setelah sukses.
     */
    public function store(Request $request)
    {
        // 1. Bersihkan dan Ubah ke UPPERCASE
        $input = $request->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = strtoupper(trim($value));
            }
        }
        $request->replace($input);

        // 2. Validasi Data
        $validatedData = $request->validate([
            'nik_balita' => 'required|string|unique:balita,nik_balita', // NIK harus unik
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'nomor_kk' => 'nullable|string',
            'nama_balita' => 'required|string',
            'nama_ortu' => 'required|string',
            'nik_ortu' => 'nullable|string',
            'hp_ortu' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'provinsi' => 'required|string',
            'kab_kota' => 'required|string',
            'kec' => 'required|string',
            'puskesmas' => 'required|string',
            'desa_kel' => 'required|string',
            'posyandu' => 'required|string',
        ]);

        try {
            // 3. Buat Data
            $balita = Balita::create($validatedData);

            // 4. Perbaikan: Redirect ke halaman CREATE (tambah data) setelah sukses.
            return redirect()->route('balitas.create')
                             ->with('success', 'Data balita berhasil ditambahkan! Anda dapat menambah data baru.');

        } catch (\Exception $e) {
            // Jika ada error (misal: error database, seperti kolom timestamp yang hilang, dll)
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data balita: ' . $e->getMessage());
        }
    }

    // Tampilkan detail balita
    public function show(Balita $balita)
    {
        return view('balitas.show', compact('balita'));
    }

    // Tampilkan form edit
    public function edit(Balita $balita)
    {
        return view('balitas.edit', compact('balita'));
    }

    /**
     * Update data balita di database.
     * Sudah termasuk perbaikan: Bersihkan input dan validasi unique NIK balita, mengecualikan data saat ini.
     */
    public function update(Request $request, Balita $balita)
    {
        // 1. Bersihkan dan Ubah ke UPPERCASE
        $input = $request->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = strtoupper(trim($value));
            }
        }
        $request->replace($input);
        
        // 2. Validasi Data
        $validatedData = $request->validate([
            // NIK harus unik, kecuali NIK balita yang sedang di-edit
            'nik_balita' => 'required|string|unique:balita,nik_balita,' . $balita->nik_balita . ',nik_balita', 
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'nomor_kk' => 'nullable|string',
            'nama_balita' => 'required|string',
            'nama_ortu' => 'required|string',
            'nik_ortu' => 'nullable|string',
            'hp_ortu' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'provinsi' => 'required|string',
            'kab_kota' => 'required|string',
            'kec' => 'required|string',
            'puskesmas' => 'required|string',
            'desa_kel' => 'required|string',
            'posyandu' => 'required|string',
        ]);

        try {
            $balita->update($validatedData);
            return redirect()->route('balitas.index', ['scroll_to' => $balita->nik_balita])
                             ->with('success', 'Data balita berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data balita: ' . $e->getMessage());
        }
    }

    // Hapus data balita
    public function destroy(Balita $balita)
    {
        try {
            $balita->delete();
            return redirect()->route('balitas.index')->with('success', 'Data balita berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data balita: ' . $e->getMessage());
        }
    }

    /**
     * Menghitung status usia balita (Aman, Mendekati, Lewat Batas).
     * Variabel $aman, $mendekati, $lewat diubah menjadi INT untuk view status.blade.php.
     */
    public function status(Request $request)
    {
        $query = Balita::query();
        
        // Filter berdasarkan kriteria dari request
        if ($request->filled('kec')) {
            $query->where('kec', $request->input('kec'));
        }
        if ($request->filled('puskesmas')) {
            $query->where('puskesmas', $request->input('puskesmas'));
        }
        if ($request->filled('desa_kel')) {
            $query->where('desa_kel', $request->input('desa_kel'));
        }
        
        $balitas = $query->get();
        $aman = collect();
        $mendekati = collect();
        $lewat = collect(); 
        $today = Carbon::now();

        foreach ($balitas as $balita) {
            $tgl_lahir = Carbon::parse($balita->tgl_lahir);
            $totalMonths = $tgl_lahir->diffInMonths($today);
            
            if ($totalMonths < 58) {
                $aman->push($balita);
            } elseif ($totalMonths >= 58 && $totalMonths < 60) {
                $mendekati->push($balita);
            } else { // >= 60 bulan
                $lewat->push($balita);
            }
        }
        
        // Diubah menjadi INT untuk view status.blade.php
        $aman = $aman->count();
        $mendekati = $mendekati->count();
        $lewat = $lewat->count(); 

        return view('balitas.status', compact('aman', 'mendekati', 'lewat'));
    }

    // Tampilkan list balita berdasarkan status
    public function showStatusData(Request $request, $status)
    {
        $query = Balita::query();

        if ($request->filled('kec')) {
            $query->where('kec', $request->input('kec'));
        }
        if ($request->filled('puskesmas')) {
            $query->where('puskesmas', $request->input('puskesmas'));
        }
        if ($request->filled('desa_kel')) {
            $query->where('desa_kel', $request->input('desa_kel'));
        }

        $balitas = $query->get();
        $filteredBalitas = [];
        $title = '';
        $today = Carbon::now();

        foreach ($balitas as $balita) {
            $tgl_lahir = Carbon::parse($balita->tgl_lahir);
            $totalMonths = $tgl_lahir->diffInMonths($today);
            
            if ($status == 'aman' && $totalMonths < 58) {
                $filteredBalitas[] = $balita;
                $title = 'Bayi Sehat (Aman)';
            } elseif ($status == 'mendekati' && $totalMonths >= 58 && $totalMonths < 60) {
                $filteredBalitas[] = $balita;
                $title = 'Bayi Hampir Batas';
            } elseif ($status == 'lewat' && $totalMonths >= 60) {
                $filteredBalitas[] = $balita;
                $title = 'Bayi Lewat Batas Umur';
            }
        }
        return view('balitas.status_list', compact('filteredBalitas', 'title'));
    }

    // Cari balita berdasarkan NIK
    public function search(Request $request)
    {
        $nik = $request->input('nik_balita');
        $balita = null;
        
        // Perbaikan: Gunakan find() untuk mencari berdasarkan primary key (nik_balita)
        if ($nik) {
            $balita = Balita::find($nik); 
        }

        // Ambil pesan sukses yang mungkin dikirim dari fungsi store()
        $success = $request->session()->get('success');

        return view('balitas.search', compact('balita', 'success'));
    }

    // Tampilkan halaman filter & pratinjau data (Mengganti downloadView)
    public function downloadFilter(Request $request)
    {
        $balitas = collect(); // Inisialisasi collection kosong
        
        // Hanya memproses query jika ada filter atau tombol tampilkan diklik
        if ($request->has(['kec', 'puskesmas', 'desa_kel']) || $request->has('filter')) {
            $query = Balita::query();

            if ($request->filled('kec')) {
                $query->where('kec', $request->input('kec'));
            }
            if ($request->filled('puskesmas')) {
                $query->where('puskesmas', $request->input('puskesmas'));
            }
            if ($request->filled('desa_kel')) {
                $query->where('desa_kel', $request->input('desa_kel'));
            }
            
            // Urutkan data berdasarkan nama untuk tampilan yang rapi
            $balitas = $query->orderBy('nama_balita', 'asc')->get();
        }

        // Kirim collection balitas (bisa kosong atau berisi data) ke view
        return view('balitas.download', compact('balitas'));
    }

    // Proses download data berdasarkan filter dan output CSV
    public function downloadCsv(Request $request)
    {
        $query = Balita::query();

        if ($request->filled('kec')) {
            $query->where('kec', $request->input('kec'));
        }
        if ($request->filled('puskesmas')) {
            $query->where('puskesmas', $request->input('puskesmas'));
        }
        if ($request->filled('desa_kel')) {
            $query->where('desa_kel', $request->input('desa_kel'));
        }

        $balitas = $query->get();
        
        if ($balitas->isEmpty()) {
            // Redirect kembali ke halaman filter dengan pesan error
            return redirect()->route('balitas.download.filter', $request->query())
                             ->with('error', 'Tidak ada data balita yang ditemukan berdasarkan filter tersebut.');
        }

        $filename = 'data_balita_' . Carbon::now()->format('Ymd_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($balitas) {
            $file = fopen('php://output', 'w');
            
            // Kolom Header CSV
            fputcsv($file, [
                'NIK Balita', 'Nama Balita', 'Nama Ortu', 'NIK Ortu', 'HP Ortu', 
                'Tgl Lahir', 'Jenis Kelamin', 'Nomor KK', 
                'RT', 'RW', 'Provinsi', 'Kab/Kota', 'Kecamatan', 
                'Puskesmas', 'Desa/Kel', 'Posyandu', 'Dibuat', 'Diubah'
            ]);

            // Isi Data
            foreach ($balitas as $balita) {
                fputcsv($file, [
                    $balita->nik_balita,
                    $balita->nama_balita,
                    $balita->nama_ortu,
                    $balita->nik_ortu,
                    $balita->hp_ortu,
                    $balita->tgl_lahir,
                    $balita->jenis_kelamin,
                    $balita->nomor_kk,
                    $balita->rt,
                    $balita->rw,
                    $balita->provinsi,
                    $balita->kab_kota,
                    $balita->kec,
                    $balita->puskesmas,
                    $balita->desa_kel,
                    $balita->posyandu,
                    $balita->created_at ? $balita->created_at->format('Y-m-d H:i:s') : 'N/A',
                    $balita->updated_at ? $balita->updated_at->format('Y-m-d H:i:s') : 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}