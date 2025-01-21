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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('chemin_fichier');
            $table->string('etat_validation')->default('En attente');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
    
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
        });
    }
    // +id: Integer
    // +title: String
    // +chemin_fichier: String
    // +Validation: String "Pending, Approved, Rejected"
    // +date_telechargement: DateTime
    // +etat_validation: String "Not Validated, Validated"
    // +category_id: Integer
    // +created_at: DateTime
    // +updated_at: DateTime
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
