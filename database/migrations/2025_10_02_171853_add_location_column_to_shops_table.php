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
        // Add PostGIS geography column for efficient spatial queries
        DB::statement('ALTER TABLE shops ADD COLUMN location geography(POINT, 4326)');

        // Populate the geography column from existing latitude/longitude
        DB::statement("
            UPDATE shops
            SET location = ST_SetSRID(ST_MakePoint(longitude, latitude), 4326)::geography
            WHERE latitude IS NOT NULL AND longitude IS NOT NULL
        ");

        // Create spatial index for fast proximity searches
        DB::statement('CREATE INDEX shops_location_idx ON shops USING GIST (location)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS shops_location_idx');
        DB::statement('ALTER TABLE shops DROP COLUMN IF EXISTS location');
    }
};
