<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use rfid\User;

class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'tipo' => 'ADMINISTRADOR',
            'foto' => 'user_default.png',
            'nro_usuario' => 0,
            'estado' => 1
        ]);
    }
}
