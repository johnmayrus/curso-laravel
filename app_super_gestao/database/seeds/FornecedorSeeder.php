<?php

use Illuminate\Database\Seeder;
use App\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //instanciando o objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'contato@fornecedor100.com.br';
        $fornecedor->save();

        //usando o metodo create(atenção para o atributo filleble da classe)
        Fornecedor::create([
            'nome'=>'Fornecedor 200',
            'site'=>'fornecedor200.com.br',
            'uf'=>'RS',
            'email'=>'contato@fornecedor200.com.br'
        ]);

        // metodo insert
        \Illuminate\Support\Facades\DB::table('fornecedores')->insert([
            'nome'=>'Fornecedor 300',
            'site'=>'fornecedor300.com.br',
            'uf'=>'PA',
            'email'=>'contato@fornecedor300.com.br'
        ]);

    }
}
