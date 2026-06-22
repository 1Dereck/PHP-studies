<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('produtos')->insert([
            'tipo' => 'Cafés da manhã',
            'nome' => 'Cappuccino Cremoso',
            'descricao' => 'Cappuccino cremoso feito com cacau premium, especiarias e leite vaporizado.',
            'imagem' => 'cappuccino-cremoso.jpg',
            'preco' => 16.90,
        ]);

        DB::table('produtos')->insert([
            'tipo' => 'Cafés da manhã',
            'nome' => 'Chá Gelado',
            'descricao' => 'Chá gelado delicioso feito com frutas naturais.',
            'imagem' => 'cha-gelado.jpg',
            'preco' => 12.90,
        ]);

        DB::table('produtos')->insert([
            'tipo' => 'Cafés da manhã',
            'nome' => 'Chocolate Quente',
            'descricao' => 'Chocolate quente feito com cacau premium, especiarias e leite vaporizado.',
            'imagem' => 'chocolate-quente.jpg',
            'preco' => 12.90,
        ]);

        DB::table('produtos')->insert([
            'tipo' => 'Cafés da manhã',
            'nome' => 'Pão de Queijo',
            'descricao' => 'Pão de queijo feito com queijo minas e polvilho azedo.',
            'imagem' => 'pao-de-queijo.jpg',
            'preco' => 8.90,
        ]);

        DB::table('produtos')->insert([
            'tipo' => 'Cafés da manhã',
            'nome' => 'Cuscuz com calabresa e catupiry',
            'descricao' => 'Cuscuz com calabresa e catupiry feito com ingredientes frescos.',
            'imagem' => 'cuscuz-calabresa-catupiry.jpg',
            'preco' => 13.90,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('produtos')->where('nome', 'Cappuccino Cremoso')->delete();
        DB::table('produtos')->where('nome', 'Chá Gelado')->delete();
        DB::table('produtos')->where('nome', 'Chocolate Quente')->delete();
        DB::table('produtos')->where('nome', 'Pão de Queijo')->delete();
        DB::table('produtos')->where('nome', 'Cuscuz com calabresa e catupiry')->delete();
    }
};
