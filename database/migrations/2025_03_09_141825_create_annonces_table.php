<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->foreignId('societe_id')->constrained()->onDelete('cascade');
            $table->decimal('prix', 10, 2)->nullable();
            $table->date('date_publication')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('annonces');
    }
};