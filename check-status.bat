@echo off
echo ================================================
echo  Snap - System Status Check
echo ================================================
echo.

echo Checking PHP...
php --version | find "PHP" >nul
if %errorlevel%==0 (
    php --version | findstr "PHP"
) else (
    echo ✗ PHP not found
)

echo.
echo Checking Composer...
composer --version 2>nul | find "Composer" >nul
if %errorlevel%==0 (
    composer --version | findstr "Composer"
) else (
    echo ✗ Composer not found
)

echo.
echo Checking Node.js...
node --version >nul 2>&1
if %errorlevel%==0 (
    echo Node: && node --version
    echo NPM: && npm --version
) else (
    echo ✗ Node.js not found
)

echo.
echo Checking PostgreSQL...
"C:\Program Files\PostgreSQL\17\bin\psql.exe" --version 2>nul
if %errorlevel%==0 (
    "C:\Program Files\PostgreSQL\17\bin\psql.exe" --version
) else (
    echo ✗ PostgreSQL not found
)

echo.
echo Checking PostgreSQL Service Status...
sc query "postgresql-x64-17" | find "RUNNING" >nul
if %errorlevel%==0 (
    echo ✓ PostgreSQL service is RUNNING
) else (
    echo ✗ PostgreSQL service is NOT RUNNING
    echo   Start it with: net start postgresql-x64-17 ^(run as Admin^)
)

echo.
echo Checking Laravel installation...
if exist "artisan" (
    echo ✓ Laravel project found
    php artisan --version 2>nul
) else (
    echo ✗ Not in Laravel project directory
)

echo.
echo Checking .env configuration...
if exist ".env" (
    echo ✓ .env file exists
    findstr /C:"DB_CONNECTION" .env
    findstr /C:"DB_DATABASE" .env
) else (
    echo ✗ .env file not found
)

echo.
echo Checking vendor directory...
if exist "vendor" (
    echo ✓ Composer dependencies installed
) else (
    echo ✗ Run: composer install
)

echo.
echo Checking node_modules...
if exist "node_modules" (
    echo ✓ NPM dependencies installed
) else (
    echo ✗ Run: npm install
)

echo.
echo ================================================
echo  Status Check Complete
echo ================================================
echo.

pause
