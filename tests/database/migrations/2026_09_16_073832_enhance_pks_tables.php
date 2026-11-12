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
        // Berita: add kategori
        if (Schema::hasTable('berita')) {
            Schema::table('berita', function (Blueprint $table) {
                if (!Schema::hasColumn('berita', 'kategori')) {
                    $table->string('kategori', 50)->default('Kegiatan')->after('penulis');
                }
            });
        }

        // Galeri: add kategori
        if (Schema::hasTable('galeri')) {
            Schema::table('galeri', function (Blueprint $table) {
                if (!Schema::hasColumn('galeri', 'kategori')) {
                    $table->string('kategori', 50)->default('Kegiatan')->after('foto');
                }
            });
        }

        // Prestasi: add tahun & foto
        if (Schema::hasTable('prestasi')) {
            Schema::table('prestasi', function (Blueprint $table) {
                if (!Schema::hasColumn('prestasi', 'tahun')) {
                    $table->string('tahun', 10)->nullable()->after('juara');
                }
                if (!Schema::hasColumn('prestasi', 'foto')) {
                    $table->string('foto', 255)->nullable()->after('deskripsi');
                }
            });
        }

        // User: add email & role
        if (Schema::hasTable('user')) {
            Schema::table('user', function (Blueprint $table) {
                if (!Schema::hasColumn('user', 'email')) {
                    $table->string('email', 100)->nullable()->after('username');
                }
                if (!Schema::hasColumn('user', 'role')) {
                    $table->string('role', 50)->default('Administrator')->after('email');
                }
            });
        }

        // Profil: add visi, misi, sejarah, logo
        if (Schema::hasTable('profil')) {
            Schema::table('profil', function (Blueprint $table) {
                if (!Schema::hasColumn('profil', 'visi')) {
                    $table->text('visi')->nullable()->after('isi');
                }
                if (!Schema::hasColumn('profil', 'misi')) {
                    $table->text('misi')->nullable()->after('visi');
                }
                if (!Schema::hasColumn('profil', 'sejarah')) {
                    $table->text('sejarah')->nullable()->after('misi');
                }
                if (!Schema::hasColumn('profil', 'logo')) {
                    $table->string('logo', 255)->nullable()->after('sejarah');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe reverse
    }
};
