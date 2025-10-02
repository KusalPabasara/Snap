@echo off
echo ================================================
echo  Snap - Local Testing Starter
echo ================================================
echo.

echo [1/5] Checking PostgreSQL Service...
sc query "postgresql-x64-17" | find "RUNNING" >nul
if %errorlevel%==0 (
    echo ✓ PostgreSQL is running
) else (
    echo ✗ PostgreSQL is NOT running
    echo.
    echo Please start PostgreSQL service manually:
    echo 1. Open Services ^(Win+R, type services.msc^)
    echo 2. Find "postgresql-x64-17"
    echo 3. Right-click and select "Start"
    echo.
    echo Or run as Administrator:
    echo    net start postgresql-x64-17
    echo.
    pause
    exit /b 1
)

echo.
echo [2/5] Checking if database exists...
"C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -h localhost -c "SELECT 1 FROM pg_database WHERE datname = 'snap';" | find "1 row" >nul 2>&1
if %errorlevel%==0 (
    echo ✓ Database 'snap' exists
) else (
    echo Creating database 'snap'...
    "C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -h localhost -c "CREATE DATABASE snap;"
    if %errorlevel%==0 (
        echo ✓ Database created successfully

        echo Enabling PostGIS extension...
        "C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -h localhost -d snap -c "CREATE EXTENSION postgis;"
        if %errorlevel%==0 (
            echo ✓ PostGIS enabled
        )
    ) else (
        echo ✗ Failed to create database
        pause
        exit /b 1
    )
)

echo.
echo [3/5] Running database migrations...
php artisan migrate --force
if %errorlevel%==0 (
    echo ✓ Migrations completed
) else (
    echo ✗ Migrations failed
    pause
    exit /b 1
)

echo.
echo [4/5] Building frontend assets...
call npm run build
if %errorlevel%==0 (
    echo ✓ Assets built successfully
) else (
    echo ✗ Asset build failed
    pause
    exit /b 1
)

echo.
echo [5/5] Starting Laravel development server...
echo.
echo ================================================
echo  🚀 Snap is ready!
echo ================================================
echo.
echo  Visit: http://localhost:8000
echo.
echo  Press Ctrl+C to stop the server
echo ================================================
echo.

php artisan serve

pause
