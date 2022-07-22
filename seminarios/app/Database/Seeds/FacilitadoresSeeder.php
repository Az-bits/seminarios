<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FacilitadoresSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('facilitadores')->where('id_facilitador >=', 1)->delete();
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data = [
                'id_facilitador' => null,
                'ci' => 10000000 + $i,
                'nombres' => 'User' . $i,
                'paterno' => 'paterno' . $i,
                'materno' => 'materno' . $i,
                'genero' => $i % 2 == 0 ? 'M' : 'F',
                'celular' => $i > 9 ? '00000000' : $i . $i . $i . $i . $i . $i . $i . $i,
                'correo' => 'user' . $i . '@gmail.com',
            ];
            $this->db->table('facilitadores')->insert($data);
        }
        // Using Query Builder
    }
}
