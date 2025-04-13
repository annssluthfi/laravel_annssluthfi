<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\RumahSakit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@sisteminformasirs.com',
            'password' => bcrypt('12345678'),
        ]);

        //create Rumah Sakit
        $rsBahagia = RumahSakit::factory()->create([
                'nama'=>'RS Bahagia',
                'alamat' => 'Jl. Tusuk Sate No.1, Jakarta',
                'email' => 'RSBahagia@sisteminformasirs.com',
                'telp' => '+6281234567'
            ]);

        $rsAntiSakit = RumahSakit::factory()->create([
                'nama' => 'RS Anti Sakit',
                'alamat' => 'Jl. Bunga No.3, Jakarta',
                'email' => 'RSAntiSakit@sisteminformasirs.com',
                'telp' => '+6281234567',
        ]);

        $rumahSakits = array($rsAntiSakit, $rsBahagia);

        //create Pasien
        $pasienCount = 20;
        for ($i = 1; $i <= $pasienCount; $i++) {
            $rs = $rumahSakits[$i % 2];

            Pasien::factory()->create([
                'nama' => "Pasien $i",
                'alamat' => "Jl. Lancar No. $i, Jakarta",
                'no_telp' => "+6281234567890$i",
                'rumah_sakit_id' => $rs->getKey(),
            ]);
        }
    }
}
