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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users', 'id');
            $table->foreignId('following_id')->constrained('users', 'id');
            $table->enum('status', ['requested', 'accepted', 'accept', 'follow_back'])->default('requested');
            $table->tinyInteger('is_accepted_follower')->default(0);
            $table->tinyInteger('is_accepted_following')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
