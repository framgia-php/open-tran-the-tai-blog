<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('table_id');
            $table->boolean('addable')->default(0);
            $table->boolean('editable')->default(0);
            $table->boolean('destroyable')->default(0);
            $table->boolean('viewable')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('table_id')
                ->references('id')
                ->on('tables')
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
        Schema::dropIfExists('permissions');
    }
}
