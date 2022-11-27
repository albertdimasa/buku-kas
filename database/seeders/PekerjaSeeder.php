<?php

namespace Database\Seeders;

use App\Models\Pekerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PekerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $id_absen = array('001', '002', '003', '004', '005', '006', '007', '008', '009', '010');
        $nama = array('asih', 'rahmat', 'nano', 'yana', 'mika', 'hania', 'ruri', 'lukas', 'adi', 'tita');
        for ($i = 0; $i < count($id_absen); $i++) {
            Pekerja::create([
                'id_absen'          => $id_absen[$i],
                'nama'              => $nama[$i],
                'nomor_hp'          => "0856212543{$i}",
                'tanggal_bergabung' => '2022-11-26',
            ]);
        }
    }
}
