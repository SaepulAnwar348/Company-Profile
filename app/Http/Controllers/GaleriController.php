<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * 1. Menampilkan seluruh data foto galeri kegiatan dan dokumentasi.
     * Dilengkapi fitur pencarian berdasarkan judul foto.
     */
    public function index(Request $request)
    {
        $query = Galeri::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        // Urutkan berdasarkan yang pertama kali ditambahkan (ID terkecil / pertama dibuat)
        // dan batasi 10 data per slide/halaman
        $galeri = $query->orderBy('id_galeri', 'asc')->paginate(10)->withQueryString();
        return view('admin.galeri.index', compact('galeri'));
    }

    /**
     * 2. Menampilkan formulir penambahan foto galeri baru.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * 3. Menyimpan foto kegiatan baru ke database dan folder storage.
     */
    public function store(Request $request)
    {
        // Validasi judul dan file foto
        $validated = $request->validate([
            'judul'  => 'required|string|max:150',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'judul.required'  => 'Judul kegiatan / foto galeri wajib diisi.',
            'judul.max'       => 'Judul kegiatan maksimal 150 karakter.',
            'gambar.required' => 'File foto kegiatan wajib diunggah.',
            'gambar.image'    => 'Berkas yang diunggah harus berupa file gambar.',
            'gambar.mimes'    => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'gambar.max'      => 'Ukuran file gambar maksimal 3MB (3072 KB).',
        ]);

        // Simpan file gambar ke folder 'storage/app/public/galeri'
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        Galeri::create($validated);
        return redirect()->route('galeri.index')->with('success', 'Foto kegiatan berhasil ditambahkan ke galeri!');
    }

    /**
     * 4. Menampilkan formulir edit judul atau foto galeri berdasarkan ID.
     */
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * 5. Menyimpan perubahan judul atau penggantian foto galeri.
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul'  => 'required|string|max:150',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'judul.required' => 'Judul kegiatan / foto galeri wajib diisi.',
            'judul.max'      => 'Judul kegiatan maksimal 150 karakter.',
            'gambar.image'   => 'Berkas yang diunggah harus berupa file gambar.',
            'gambar.mimes'   => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'gambar.max'     => 'Ukuran file gambar maksimal 3MB (3072 KB).',
        ]);

        // Jika user memilih file gambar pengganti baru
        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($validated);
        return redirect()->route('galeri.index')->with('success', 'Galeri kegiatan berhasil diperbarui!');
    }

    /**
     * 6. Menghapus foto galeri dari database dan file fisiknya dari storage.
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        // Hapus file dari penyimpanan disk public
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        // Hapus rekaman data galeri
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}