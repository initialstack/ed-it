<?php declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(table: 'intervals',
            callback: function (Blueprint $table): void {
                $table->smallIncrements(column: 'id');
                $table->unsignedInteger(column: 'start');
                $table->unsignedInteger(column: 'end')->nullable();

                $table->index(columns: ['start', 'end']);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'intervals');
    }
};
