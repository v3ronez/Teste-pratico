<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 1)->states('admin')->create([
            'name'  => 'Administrador',
            'email' => 'admin@teste.com.br',
            'phone' => '(62) 99999-0000',
            'cpf'   => '99193133197'
        ]);

        factory(\App\User::class, 1)->states('user')->create([
            'name'  => 'Usuario Teste',
            'email' => 'user@teste.com.br',
            'phone' => '(62) 00000-0000',
            'cpf'   => '21429528109'
        ]);

        factory(\App\User::class, 40)->states('user')->create();
    }
}
