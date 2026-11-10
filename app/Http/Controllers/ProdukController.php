<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * 1. Menampilkan daftar seluruh produk & layanan jaringan.
     * Dilengkapi fitur pencarian berdasarkan nama produk atau deskripsi.
     */
    public function index(Request $request)
    {
        $query = Produk::query();

        // Jika form pencarian diisi oleh admin
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('nama_produk', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%");
            });
        }

        // Urutkan berdasarkan yang pertama kali ditambahkan (ID terkecil / pertama dibuat)
        // dan batasi 10 data per slide/halaman
        $produk = $query->orderBy('id_produk', 'asc')->paginate(10)->withQueryString();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * 2. Menampilkan formulir input untuk menambah produk atau layanan baru.
     */
    public function create()
    {
        return view('admin.produk.create');
    }

    /**
     * 3. Menyimpan produk / layanan baru ke database.
     * Termasuk penanganan proses upload berkas gambar ke storage public.
     */
    public function store(Request $request)
    {
        // Validasi data input form penambahan produk
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama_produk.required' => 'Nama produk / layanan wajib diisi.',
            'nama_produk.max'      => 'Nama produk / layanan maksimal 150 karakter.',
            'harga.required'       => 'Harga atau tarif layanan wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka valid.',
            'harga.min'            => 'Harga tidak boleh bernilai negatif.',
            'deskripsi.required'   => 'Deskripsi spesifikasi / cakupan layanan wajib diisi.',
            'gambar.image'         => 'Berkas yang diunggah harus berupa file gambar.',
            'gambar.mimes'         => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'gambar.max'           => 'Ukuran file gambar maksimal 2MB (2048 KB).',
        ]);

        // Simpan file gambar ke folder 'storage/app/public/produk' jika ada yang diunggah
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        // Masukkan data baru ke tabel 'produks' melalui Eloquent
        Produk::create($validated);

        // Alihkan kembali ke daftar produk dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Item produk/layanan berhasil ditambahkan!');
    }

    /**
     * 4. Menampilkan formulir edit data produk berdasarkan ID yang dipilih.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * 5. Memperbarui data produk / layanan di database.
     * Jika admin mengunggah gambar baru, gambar lama akan dihapus dari storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // Validasi input data pada formulir pembaruan
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama_produk.required' => 'Nama produk / layanan wajib diisi.',
            'nama_produk.max'      => 'Nama produk / layanan maksimal 150 karakter.',
            'harga.required'       => 'Harga atau tarif layanan wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka valid.',
            'harga.min'            => 'Harga tidak boleh bernilai negatif.',
            'deskripsi.required'   => 'Deskripsi spesifikasi / cakupan layanan wajib diisi.',
            'gambar.image'         => 'Berkas yang diunggah harus berupa file gambar.',
            'gambar.mimes'         => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'gambar.max'           => 'Ukuran file gambar maksimal 2MB (2048 KB).',
        ]);

        // Jika ada unggahan gambar pengganti baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari disk public agar tidak membebani kapasitas server
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            // Simpan gambar baru
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        // Perbarui record produk di database
        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Data produk/layanan berhasil diperbarui!');
    }

    /**
     * 6. Menghapus produk dari database beserta file gambar fisiknya dari storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        
        // Hapus file gambar dari disk storage jika ada
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        // Hapus record produk dari tabel database
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}