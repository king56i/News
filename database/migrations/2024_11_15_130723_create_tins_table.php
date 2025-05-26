<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tin', function (Blueprint $table) {
            $table->id();
            $table->string('TieuDe',255);
            $table->text('TomTat')->nullable();
            $table->text('NoiDung')->nullable();
            $table->date('NgayDang');
            $table->bigInteger('Xem');
            $table->tinyInteger('NoiBat');
            $table->unsignedBigInteger('idLT');
            $table->foreign('idLT')->references('idLT')->on('loaitin')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin');
    }
};
