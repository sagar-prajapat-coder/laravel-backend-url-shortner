<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('short_urls', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->text('original_url');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->boolean('is_public')->default(false);
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('short_urls'); }
}
