<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::insert([
            ['user_id'=>1,'title'=>'Configurar Laravel API','done'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['user_id'=>1,'title'=>'Crear proyecto React','done'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['user_id'=>1,'title'=>'Conectar front y back','done'=>false,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
