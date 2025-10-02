# PostGIS Setup Guide for Snap

PostGIS is a spatial database extension for PostgreSQL that enables location-based queries and geographic data types.

## Why PostGIS?

Snap uses PostGIS to:
- Store shop locations efficiently using the `geography` data type
- Perform fast proximity searches ("find shops near me")
- Calculate distances between user location and shops
- Support spatial indexing for better query performance

## Installation Instructions

### Windows

1. **Download PostGIS**
   - PostGIS is included with PostgreSQL 17 installer from EnterpriseDB
   - If you didn't install it during PostgreSQL setup, use Stack Builder:
     - Open "Stack Builder" from Start Menu → PostgreSQL 17
     - Select your PostgreSQL installation
     - Navigate to "Spatial Extensions"
     - Check "PostGIS X.X Bundle for PostgreSQL 17"
     - Click Next and follow the installation wizard

2. **Alternative: Manual Installation**
   - Download from: https://postgis.net/windows_downloads/
   - Choose the version matching your PostgreSQL 17
   - Run the installer and select your PostgreSQL installation directory

3. **Verify Installation**
   ```bash
   "C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -h localhost -d snap -c "CREATE EXTENSION postgis;"
   ```

4. **Run Migration**
   ```bash
   php artisan migrate
   ```

### macOS (Homebrew)

```bash
# Install PostGIS
brew install postgis

# Enable extension in snap database
psql -U postgres -d snap -c "CREATE EXTENSION postgis;"

# Run migration
php artisan migrate
```

### Linux (Ubuntu/Debian)

```bash
# Install PostGIS
sudo apt-get update
sudo apt-get install postgresql-17-postgis-3

# Enable extension
sudo -u postgres psql -d snap -c "CREATE EXTENSION postgis;"

# Run migration
php artisan migrate
```

## Verification

After installation, verify PostGIS is working:

```bash
psql -U postgres -d snap -c "SELECT PostGIS_version();"
```

You should see output like:
```
              postgis_version
---------------------------------------------
 3.4 USE_GEOS=1 USE_PROJ=1 USE_STATS=1
```

## Migration Details

The migration `2025_10_02_170103_enable_postgis_extension.php` will:
- Enable the PostGIS extension in your database
- Add necessary spatial functions and data types

## Future Updates

Once PostGIS is installed, we can update the shops table to use:
- `geography(POINT, 4326)` type instead of separate latitude/longitude columns
- Spatial indexes for faster proximity queries
- Distance calculations using `ST_Distance_Sphere()`

## Troubleshooting

### Error: "could not open extension control file"
- PostGIS is not installed in your PostgreSQL installation
- Follow installation instructions above

### Error: "permission denied to create extension"
- Your database user doesn't have SUPERUSER privileges
- Run: `ALTER USER postgres WITH SUPERUSER;`

### Error: "library not found"
- PostGIS library files are missing
- Reinstall PostGIS using the appropriate method for your OS

## Resources

- PostGIS Official Documentation: https://postgis.net/documentation/
- PostGIS Download: https://postgis.net/install/
- PostgreSQL Extensions: https://www.postgresql.org/docs/17/external-extensions.html
