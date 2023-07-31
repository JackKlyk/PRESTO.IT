<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
            $table->string('gender')->after('password');
            $table->datetime('birthday')->after('gender')->nullable();
            $table->string('img')->after('birthday')->nullable();
            $table->string('phone')->after('img');
        });

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'gender' => 'Non specificato',
            'phone' => 1234567890,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('img');
            $table->dropColumn('phone');
        });
    }
};
