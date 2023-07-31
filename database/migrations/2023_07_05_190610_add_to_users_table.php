<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->decimal('wallet', 8, 2)->default(0,00)->nullable();
            $table->boolean('is_admin')->default(false)->nullable();
        });

        $admin = User::where('email', 'admin@mail.com')->first();

        if ($admin) {
            $admin->update([
                'is_admin' => true,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('wallet');
            $table->dropColumn('is_admin');
        });
    }
};
