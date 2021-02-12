<?php

use App\Enums\PageStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->char('name', 60)->index();
            $table->longText('content');
            $table->char('description')->index();
            $table->char('status', 20)->default(PageStatus::PENDING)->index();
            $table->timestamps();
            $table->index(['name', 'status', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
