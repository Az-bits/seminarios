<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ParticipantesSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('participantes')->where('id_participante >=', 1)->delete();
        for ($i = 1; $i <= 10; $i++) {
            $data = [
                'id_participante' => null,
                'ci' => 10000000 + $i,
                'nombres' => 'Participante' . $i,
                'paterno' => 'paterno' . $i,
                'materno' => 'materno' . $i,
                'genero' => $i % 2 == 0 ? 'M' : 'F',
                'celular' => $i > 9 ? '00000000' : $i . $i . $i . $i . $i . $i . $i . $i,
                'correo' => 'user' . $i . '@gmail.com',
            ];
            $this->db->table('participantes')->insert($data);
        }
        // Usin
    }
}
