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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('host');
            $table->string('installed_os')->default('ubuntu');
            $table->text('description')->nullable();
            $table->string('ssh_login_type')->nullable();
            $table->string('ssh_user')->nullable();
            $table->string('ssh_port')->nullable();
            $table->string('ssh_password')->nullable();
            $table->string('ssh_private_key')->nullable();
            $table->dateTime('agent_installed_at')->nullable();
            $table->string('status')->default('offline');// online , offline
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
