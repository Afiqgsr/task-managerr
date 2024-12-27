<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('task_histories', function (Blueprint $table) {
            $table->id();
            $table->string('status'); // Status baru dari task
            $table->text('description')->nullable(); // Deskripsi perubahan
            $table->morphs('historable'); // Polymorphic fields (model yang berhubungan)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_histories');
    }
}
