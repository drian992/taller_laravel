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
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'role')) {
                // minimal change.
                $table->string('role')->default('user')->after('password');
            }

            if (! Schema::hasColumn('users', 'nombre')) {
                // minimal change.
                $table->string('nombre')->nullable()->after('role');
            }

            if (! Schema::hasColumn('users', 'dni')) {
                // minimal change.
                $table->string('dni')->nullable()->unique()->after('nombre');
            }

            if (! Schema::hasColumn('users', 'fecha_nacimiento')) {
                // minimal change.
                $table->date('fecha_nacimiento')->nullable()->after('dni');
            }

            if (! Schema::hasColumn('users', 'domicilio')) {
                // minimal change.
                $table->string('domicilio')->nullable()->after('fecha_nacimiento');
            }

            if (! Schema::hasColumn('users', 'telefono')) {
                // minimal change.
                $table->string('telefono')->nullable()->after('domicilio');
            }

            if (! Schema::hasColumn('users', 'profile_locked')) {
                // minimal change.
                $table->boolean('profile_locked')->default(false)->after('telefono');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'profile_locked')) {
                // minimal change.
                $table->dropColumn('profile_locked');
            }

            if (Schema::hasColumn('users', 'telefono')) {
                // minimal change.
                $table->dropColumn('telefono');
            }

            if (Schema::hasColumn('users', 'domicilio')) {
                // minimal change.
                $table->dropColumn('domicilio');
            }

            if (Schema::hasColumn('users', 'fecha_nacimiento')) {
                // minimal change.
                $table->dropColumn('fecha_nacimiento');
            }

            if (Schema::hasColumn('users', 'dni')) {
                // minimal change.
                $table->dropColumn('dni');
            }

            if (Schema::hasColumn('users', 'nombre')) {
                // minimal change.
                $table->dropColumn('nombre');
            }

            if (Schema::hasColumn('users', 'role')) {
                // minimal change.
                $table->dropColumn('role');
            }
        });
    }
};
