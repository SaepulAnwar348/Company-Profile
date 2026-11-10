<?php

namespace App\Http\Controllers;

use App\Models\KontakKami;
use Illuminate\Http\Request;

class KontakKamiController extends Controller
{
    /**
     * 1. Menampilkan panel kotak masuk pesan dari pengunjung (Panel Admin).
     * Dilengkapi filter pencarian berdasarkan nama pengirim, email, subjek, atau isi pesan,
     * serta kartu statistik total pesan masuk & pesan hari ini.
     */
    public function index(Request $request)
    {
        $query = KontakKami::latest();

        // Fitur pencarian pesan
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_pengirim', 'like', "%{$search}%")
                  ->orWhere('email_pengirim', 'like', "%{$search}%")
                  ->orWhere('subjek', 'like', "%{$search}%")
                  ->orWhere('isi_pesan', 'like', "%{$search}%");
            });
        }

        $kontak = $query->get();

        // Menentukan pesan aktif yang sedang dipilih untuk dibaca detailnya di sisi kanan
        $selectedId = $request->query('id');
        $selected = null;
        if ($kontak->isNotEmpty()) {
            if ($selectedId) {
                $selected = $kontak->firstWhere('id_kontak', $selectedId) ?? $kontak->first();
            } else {
                $selected = $kontak->first();
            }
        }

        // Menghitung statistik pesan untuk indikator ringkasan
        $totalPesan = KontakKami::count();
        $pesanHariIni = KontakKami::whereDate('created_at', today())->count();

        return view('admin.kontak.index', compact('kontak', 'selected', 'totalPesan', 'pesanHariIni'));
    }

    /**
     * 2. Memproses dan menyimpan pesan yang dikirimkan oleh pengunjung dari landing page publik.
     */
    public function kirim(Request $request)
    {
        // Validasi isian formulir kontak dari pengunjung
        $validated = $request->validate([
            'nama_pengirim'  => 'required|string|max:150',
            'email_pengirim' => 'required|email|max:150',
            'subjek'         => 'required|string|max:200',
            'isi_pesan'      => 'required|string',
        ], [
            'nama_pengirim.required'  => 'Nama lengkap wajib diisi.',
            'nama_pengirim.max'       => 'Nama pengirim maksimal 150 karakter.',
            'email_pengirim.required' => 'Alamat email wajib diisi.',
            'email_pengirim.email'    => 'Format email tidak valid (contoh: nama@domain.com).',
            'subjek.required'         => 'Silakan pilih topik atau subjek kebutuhan.',
            'isi_pesan.required'      => 'Pesan atau pertanyaan wajib diisi.',
        ]);

        // Simpan data pesan ke tabel kontak_kamis
        KontakKami::create($validated);

        // Alihkan kembali ke landing page pada bagian section kontak dengan flash message
        return redirect('/#kontak')->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim ke admin.');
    }

    /**
     * 3. Menghapus pesan kontak dari database (Panel Admin).
     */
    public function destroy($id)
    {
        $item = KontakKami::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus!');
    }
}