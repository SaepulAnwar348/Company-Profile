<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Menampilkan formulir untuk mengubah informasi profil perusahaan.
     * Mengarahkan ke file view resources/views/admin/profil/edit.blade.php.
     */
    public function edit()
    {
        // Mengambil data profil perusahaan utama yang pertama (id_profil = 1)
        $profil = Profil::first();

        // Mengirimkan data profil ke halaman view edit
        return view('admin.profil.edit', compact('profil'));
    }

    /**
     * Menyimpan perubahan informasi profil perusahaan ke dalam database.
     * Melakukan validasi kelengkapan data sesuai struktur rancangan database.
     */
    public function update(Request $request, $id)
    {
        // Mencari record profil berdasarkan ID, jika tidak ditemukan akan menghasilkan error 404
        $profil = Profil::findOrFail($id);

        // Validasi input data dari formulir profil perusahaan
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:250',
            'tentang_kami'    => 'required|string',
            'visi'            => 'required|string',
            'misi'            => 'required|string',
            'alamat'          => 'required|string',
            'email'           => 'required|email|max:150',
            'no_hp'           => 'required|string|max:25',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'tentang_kami.required'    => 'Deskripsi tentang perusahaan wajib diisi.',
            'visi.required'            => 'Visi perusahaan wajib diisi.',
            'misi.required'            => 'Misi perusahaan wajib diisi.',
            'alamat.required'          => 'Alamat kantor wajib diisi.',
            'email.required'           => 'Email perusahaan wajib diisi.',
            'email.email'              => 'Format alamat email tidak valid (contoh: info@perusahaan.com).',
            'no_hp.required'           => 'Nomor telepon / WhatsApp wajib diisi.',
        ]);

        // Menyimpan pembaruan data ke tabel 'profils' di database
        $profil->update($validated);

        // Mengarahkan kembali ke formulir edit dengan pesan notifikasi sukses
        return redirect()->route('admin.profil.edit')->with('success', 'Profil perusahaan berhasil diperbarui!');
    }
}