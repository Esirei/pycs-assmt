<?php

use App\Models\Contact;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('type');
            $table->string('content');
            $table->foreignIdFor(Contact::class)->constrained('contacts', 'uuid')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('information');
    }
};
