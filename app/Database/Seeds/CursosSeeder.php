<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CursosSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('cursos')->where('id_curso >=', 1)->delete();
        for ($i = 1; $i <= 10; $i++) {
            $data = [
                'id_curso' => null,
                'nombre_curso' => 'Curso' . $i,
                'precio' => $i * 100,
                'modalidad' => $i % 2 == 0 ? 'VIRTUAL' : 'PRESENCIAL',
                'id_facilitador' => $i,
            ];
            $this->db->table('cursos')->insert($data);
        }
    }
}
