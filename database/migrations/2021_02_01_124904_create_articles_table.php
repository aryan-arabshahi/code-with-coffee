<?php

use App\Enums\ArticleStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->char('name', 60)->index();
            $table->char('slug', 60)->unique();
            $table->foreignId('category_id');
            $table->longText('content');
            $table->char('description')->index();
            $table->longText('image')->nullable();
            $table->char('status', 20)
                ->default(ArticleStatus::PENDING)
                ->index();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->timestamps();
            $table->index(['name', 'status', 'description']);
            $table->index(['slug', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
