<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');  // bài viết nào
            $table->unsignedBigInteger('user_id');  // user nào rate
            $table->unsignedTinyInteger('score');   // điểm 1-5
            
            // 1 user chỉ rate 1 lần/bài → lần sau UPDATE điểm mới
            $table->unique(['blog_id', 'user_id']);

            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
