<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('summary');
            $table->longText('content');
            $table->string('image');
            $table->integer('hot')->default(0);
            $table->integer('views')->default(0);
            $table->unsignedInteger('news_type_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('news_type_id')
                ->references('id')
                ->on('news_type')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
