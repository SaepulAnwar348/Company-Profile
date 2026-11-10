<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Profil;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        Profil::create([
            'nama_perusahaan' => 'PT Solusi Koneksi Anda',
            'tentang_kami' => 'Solusi IT',
            'visi' => 'Visi IT',
            'misi' => 'Misi IT',
            'alamat' => 'Bogor',
            'email' => 'info@solusikoneksi.co.id',
            'no_hp' => '081234567890'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
