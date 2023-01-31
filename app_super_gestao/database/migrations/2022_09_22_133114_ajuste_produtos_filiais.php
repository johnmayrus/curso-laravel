<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AjusteProdutosFiliais extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasTable('filiais')) {
                Schema::create('filiais', function (Blueprint $table) {
                    $table->id();
                    $table->string('filial', 30);
                    $table->timestamps();
                });
            }
            if (!Schema::hasTable('produto_filiais')) {
                Schema::create('produto_filiais', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('filial_id');
                    $table->unsignedBigInteger('produto_id');
                    $table->decimal('preco_venda', 8, 2);
                    $table->integer('estoque_maximo');
                    $table->integer('estoque_minimo');
                    $table->timestamps();
                    $table->foreign('filial_id')->references('id')->on('filiais');
                    $table->foreign('produto_id')->references('id')->on('produtos');

                });
            }

            Schema::table('produtos', function (Blueprint $table) {
                $table->dropColumn(['preco_venda', 'estoque_maximo', 'estoque_minimo']);

            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public
        function down()
        {
            Schema::create('produtos', function (Blueprint $table) {
                $table->decimal('preco_venda', 8, 2);
                $table->decimal('estoque_maximo', 8, 2);
                $table->decimal('estoque_minimo', 8, 2);
            });
            Schema::dropIfExists('produto_filiais');

            Schema::dropIfExists('filiais');
        }
    }
