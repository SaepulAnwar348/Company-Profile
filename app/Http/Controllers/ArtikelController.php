<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * 1. Menampilkan daftar seluruh artikel wawasan teknologi dan berita.
     * Dilengkapi fitur pencarian berdasarkan judul, penulis, atau isi artikel.
     */
    public function index(Request $request)
    {
        $query = Artikel::query();

        // Filter pencarian berdasarkan input teks search admin
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('penulis', 'like', "%{$keyword}%")
                  ->orWhere('isi_artikel', 'like', "%{$keyword}%");
            });
        }

        // Urutkan berdasarkan yang pertama kali ditambahkan (ID terkecil / pertama dibuat)
        // dan batasi 10 data per slide/halaman
        $artikel = $query->orderBy('id_artikel', 'asc')->paginate(10)->withQueryString();
        return view('admin.artikel.index', compact('artikel'));
    }

    /**
     * 2. Menampilkan formulir penambahan artikel baru.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * 3. Menyimpan artikel baru ke tabel artikels.
     * Termasuk penanganan proses upload gambar sampul (thumbnail).
     */
    public function store(Request $request)
    {
        // Validasi kelengkapan data artikel
        $validated = $request->validate([
            'judul'       => 'required|string|max:250',
            'penulis'     => 'required|string|max:100',
            'isi_artikel' => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'judul.required'       => 'Judul artikel wajib diisi.',
            'judul.max'            => 'Judul artikel maksimal 250 karakter.',
            'penulis.required'     => 'Nama penulis artikel wajib diisi.',
            'penulis.max'          => 'Nama penulis maksimal 100 karakter.',
            'isi_artikel.required' => 'Konten isi artikel wajib diisi.',
            'gambar.image'         => 'Berkas sampul harus berupa file gambar.',
            'gambar.mimes'         => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'gambar.max'           => 'Ukuran file gambar maksimal 2MB (2048 KB).',
        ]);

        // Simpan file sampul ke direktori 'storage/app/public/artikel'
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        // Simpan ke database
        Artikel::create($validated);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    /**
     * 4. Menampilkan formulir pengubahan (edit) artikel berdasarkan ID.
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    /**
     * 5. Menyimpan pembaruan data artikel ke database.
     * Jika diunggah gambar baru, gambar lama dihapus dari storage.
     */
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $validated = $request->validate([
            'judul'       => 'required|string|max:250',
            'penulis'     => 'required|string|max:100',
            'isi_artikel' => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'judul.required'       => 'Judul artikel wajib diisi.',
            'judul.max'            => 'Judul artikel maksimal 250 karakter.',
            'penulis.required'     => 'Nama penulis artikel wajib diisi.',
            'penulis.max'          => 'Nama penulis maksimal 100 karakter.',
            'isi_artikel.required' => 'Konten isi artikel wajib diisi.',
            'gambar.image'         => 'Berkas sampul harus berupa file gambar.',
            'gambar.mimes'         => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'gambar.max'           => 'Ukuran file gambar maksimal 2MB (2048 KB).',
        ]);

        // Ganti file gambar jika ada berkas baru yang diunggah
        if ($request->hasFile('gambar')) {
            if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($validated);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * 6. Menghapus artikel beserta file sampul gambar dari storage.
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        // Hapus berkas gambar dari disk storage
        if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        // Hapus data dari tabel
        $artikel->delete();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}