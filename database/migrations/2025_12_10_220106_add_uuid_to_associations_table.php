<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('associations', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });

        // Remplir automatiquement les uuid existants
        $associations = \App\Models\Association::whereNull('uuid')->get();
        foreach ($associations as $assoc) {
            $assoc->uuid = Str::uuid()->toString();
            $assoc->save();
        }

        // Rendre la colonne unique si tu veux
        Schema::table('associations', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('associations', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }


};
