<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('role_id')->constrained('roles');
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->foreignId('invited_by')->constrained('users');
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('invitations'); }
}
