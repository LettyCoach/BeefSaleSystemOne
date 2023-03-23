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
        Schema::create('oxen', function (Blueprint $table) {
            $table->id();
            $table->string('registerNumber')->unique();
            $table->string('name');
            $table->date('birthday');
            $table->integer('sex');
            $table->foreignId('market_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('purchaseDate')->nullable();
            $table->decimal('purchasePrice',11,2)->nullable();
            $table->foreignId('purchaseTransport_Company_id')
                ->nullable()
                ->constrained('transport_companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('loadDate')->nullable();
            $table->date('unloadDate')->nullable();
            $table->foreignId('pastoral_id')
                ->nullable()    
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('accessDate')->nullable();
            $table->date('exportDate')->nullable();
            $table->text('appendInfo')->nullable();
            $table->foreignId('slaughterTransport_Company_id')
                ->nullable()
                ->constrained('transport_companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('slaughterHouse_id')
                ->nullable()
                ->constrained('slaughter_houses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('acceptedDateSlaughterHouse')->nullable();
            $table->date('slaughterFinishedDate')->nullable();
            $table->decimal('acceptedWeight',11,2)->nullable();
            $table->integer('acceptedLevel')->nullable();
            $table->integer('finishedState')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oxen');
    }
};
