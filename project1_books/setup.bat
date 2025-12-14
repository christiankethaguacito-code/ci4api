@echo off
:: ============================================
:: Book Library System - Admin Auto Setup
:: Automatically elevates to admin if needed
:: ============================================

:: Check for admin rights and self-elevate if needed
>nul 2>&1 "%SYSTEMROOT%\system32\cacls.exe" "%SYSTEMROOT%\system32\config\system"
if '%errorlevel%' NEQ '0' (
    echo Requesting Administrator privileges...
    goto UACPrompt
) else ( goto gotAdmin )

:UACPrompt
    echo Set UAC = CreateObject^("Shell.Application"^) > "%temp%\getadmin.vbs"
    echo UAC.ShellExecute "%~s0", "", "", "runas", 1 >> "%temp%\getadmin.vbs"
    "%temp%\getadmin.vbs"
    exit /B

:gotAdmin
    if exist "%temp%\getadmin.vbs" ( del "%temp%\getadmin.vbs" )
    pushd "%CD%"
    CD /D "%~dp0"

setlocal enabledelayedexpansion

echo.
echo ============================================
echo   Book Library System - Full Auto Setup
echo   Running as Administrator
echo ============================================
echo.

set "DEVTOOLS=%USERPROFILE%\DevTools"
set "PHP_PATH=%DEVTOOLS%\php"
set "COMPOSER_PATH=%DEVTOOLS%\composer"
set "PROJECT_DIR=%~dp0"
set "DB_NAME=book_library_db"
set "DB_USER=root"
set "DB_PASS="

:: ==========================================
:: STEP 1: Install PHP
:: ==========================================
echo [1/6] Setting up PHP...
where php >nul 2>nul
if %errorlevel% neq 0 (
    if not exist "%PHP_PATH%\php.exe" (
        echo [INFO] Installing PHP 8.3...
        
        if not exist "%DEVTOOLS%" mkdir "%DEVTOOLS%"
        if not exist "%PHP_PATH%" mkdir "%PHP_PATH%"
        
        :: Download PHP
        echo [INFO] Downloading PHP...
        powershell -Command "& {[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12; try { Invoke-WebRequest -Uri 'https://windows.php.net/downloads/releases/php-8.3.14-Win32-vs16-x64.zip' -OutFile '%TEMP%\php.zip' -UseBasicParsing } catch { Invoke-WebRequest -Uri 'https://windows.php.net/downloads/releases/archives/php-8.3.0-Win32-vs16-x64.zip' -OutFile '%TEMP%\php.zip' -UseBasicParsing }}"
        
        if exist "%TEMP%\php.zip" (
            echo [INFO] Extracting PHP...
            powershell -Command "Expand-Archive -Path '%TEMP%\php.zip' -DestinationPath '%PHP_PATH%' -Force"
            del "%TEMP%\php.zip" 2>nul
            
            :: Configure php.ini
            if exist "%PHP_PATH%\php.ini-development" (
                copy "%PHP_PATH%\php.ini-development" "%PHP_PATH%\php.ini" >nul
                powershell -Command "(Get-Content '%PHP_PATH%\php.ini') -replace ';extension=curl', 'extension=curl' -replace ';extension=mbstring', 'extension=mbstring' -replace ';extension=openssl', 'extension=openssl' -replace ';extension=pdo_mysql', 'extension=pdo_mysql' -replace ';extension=mysqli', 'extension=mysqli' -replace ';extension=intl', 'extension=intl' -replace ';extension=fileinfo', 'extension=fileinfo' -replace ';extension=gd', 'extension=gd' -replace ';extension_dir = \"ext\"', 'extension_dir = \"%PHP_PATH%\\ext\"' | Set-Content '%PHP_PATH%\php.ini'"
                powershell -Command "(Get-Content '%PHP_PATH%\php.ini') -replace 'extension_dir = \"%PHP_PATH%\\ext\"', ('extension_dir = \"' + '%PHP_PATH%' + '\\ext\"') | Set-Content '%PHP_PATH%\php.ini'"
            )
            echo [OK] PHP installed.
        ) else (
            echo [ERROR] Failed to download PHP.
            pause
            exit /b 1
        )
    ) else (
        echo [OK] PHP found at %PHP_PATH%
    )
    
    :: Add PHP to System PATH
    call :AddToSystemPath "%PHP_PATH%"
    set "PATH=%PATH%;%PHP_PATH%"
) else (
    for /f "tokens=*" %%i in ('php -r "echo PHP_VERSION;"') do echo [OK] PHP %%i already installed.
)
echo.

:: ==========================================
:: STEP 2: Install Composer
:: ==========================================
echo [2/6] Setting up Composer...
where composer >nul 2>nul
if %errorlevel% neq 0 (
    if not exist "%COMPOSER_PATH%\composer.phar" (
        echo [INFO] Installing Composer...
        
        if not exist "%COMPOSER_PATH%" mkdir "%COMPOSER_PATH%"
        
        powershell -Command "& {[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12; Invoke-WebRequest -Uri 'https://getcomposer.org/download/latest-stable/composer.phar' -OutFile '%COMPOSER_PATH%\composer.phar' -UseBasicParsing}"
        
        if exist "%COMPOSER_PATH%\composer.phar" (
            :: Create composer.bat
            (
                echo @echo off
                echo "%PHP_PATH%\php.exe" "%COMPOSER_PATH%\composer.phar" %%*
            ) > "%COMPOSER_PATH%\composer.bat"
            echo [OK] Composer installed.
        ) else (
            echo [ERROR] Failed to download Composer.
            pause
            exit /b 1
        )
    ) else (
        echo [OK] Composer found at %COMPOSER_PATH%
    )
    
    :: Add Composer to System PATH
    call :AddToSystemPath "%COMPOSER_PATH%"
    set "PATH=%PATH%;%COMPOSER_PATH%"
) else (
    echo [OK] Composer already installed.
)
echo.

:: ==========================================
:: STEP 3: Setup MySQL
:: ==========================================
echo [3/6] Setting up MySQL...
set "MYSQL_PATH="
set "MYSQL_FOUND=0"

:: Check if mysql is in PATH
where mysql >nul 2>nul
if %errorlevel% equ 0 (
    set "MYSQL_FOUND=1"
    echo [OK] MySQL CLI already in PATH.
) else (
    :: Check XAMPP
    if exist "C:\xampp\mysql\bin\mysql.exe" (
        set "MYSQL_PATH=C:\xampp\mysql\bin"
        set "MYSQL_FOUND=1"
        echo [OK] Found MySQL in XAMPP.
    )
    :: Check WAMP
    if exist "C:\wamp64\bin\mysql\mysql8.0.31\bin\mysql.exe" (
        set "MYSQL_PATH=C:\wamp64\bin\mysql\mysql8.0.31\bin"
        set "MYSQL_FOUND=1"
        echo [OK] Found MySQL in WAMP.
    )
    :: Check MySQL Server
    if exist "C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe" (
        set "MYSQL_PATH=C:\Program Files\MySQL\MySQL Server 8.0\bin"
        set "MYSQL_FOUND=1"
        echo [OK] Found MySQL Server.
    )
    :: Check MariaDB
    if exist "C:\Program Files\MariaDB 10.11\bin\mysql.exe" (
        set "MYSQL_PATH=C:\Program Files\MariaDB 10.11\bin"
        set "MYSQL_FOUND=1"
        echo [OK] Found MariaDB.
    )
    
    if defined MYSQL_PATH (
        call :AddToSystemPath "!MYSQL_PATH!"
        set "PATH=%PATH%;!MYSQL_PATH!"
    )
)

if "!MYSQL_FOUND!"=="0" (
    echo [WARNING] MySQL not found. Will skip database auto-setup.
    echo [INFO] Please install MySQL/MariaDB or use XAMPP/WAMP.
)
echo.

:: ==========================================
:: STEP 4: Install Dependencies
:: ==========================================
echo [4/6] Installing Composer dependencies...
cd /d "%PROJECT_DIR%"

:: Use the installed PHP and Composer
if exist "%COMPOSER_PATH%\composer.phar" (
    "%PHP_PATH%\php.exe" "%COMPOSER_PATH%\composer.phar" install --no-interaction
) else (
    call composer install --no-interaction
)

if %errorlevel% neq 0 (
    echo [WARNING] Composer install had issues. Trying again...
    call composer install --no-interaction --ignore-platform-reqs
)
echo [OK] Dependencies installed.
echo.

:: ==========================================
:: STEP 5: Environment Configuration
:: ==========================================
echo [5/6] Configuring environment...
cd /d "%PROJECT_DIR%"

if not exist ".env" (
    copy env .env >nul 2>&1
    if exist ".env" (
        :: Update .env with database settings
        powershell -Command "(Get-Content '.env') -replace '# database.default.hostname = localhost', 'database.default.hostname = localhost' -replace '# database.default.database = ci4', 'database.default.database = %DB_NAME%' -replace '# database.default.username = root', 'database.default.username = %DB_USER%' -replace '# database.default.password = root', 'database.default.password = %DB_PASS%' -replace '# database.default.DBDriver = MySQLi', 'database.default.DBDriver = MySQLi' -replace '# CI_ENVIRONMENT = production', 'CI_ENVIRONMENT = development' | Set-Content '.env'"
        echo [OK] Environment configured.
    )
) else (
    echo [OK] .env already exists.
)
echo.

:: ==========================================
:: STEP 6: Database Setup
:: ==========================================
echo [6/6] Setting up database...

if "!MYSQL_FOUND!"=="1" (
    echo [INFO] Creating database '%DB_NAME%'...
    
    :: Try to execute SQL file
    if defined MYSQL_PATH (
        "!MYSQL_PATH!\mysql.exe" -u %DB_USER% -e "SELECT 1" >nul 2>&1
    ) else (
        mysql -u %DB_USER% -e "SELECT 1" >nul 2>&1
    )
    
    if !errorlevel! equ 0 (
        :: MySQL is accessible without password
        if defined MYSQL_PATH (
            "!MYSQL_PATH!\mysql.exe" -u %DB_USER% < "%PROJECT_DIR%database_setup.sql" 2>nul
        ) else (
            mysql -u %DB_USER% < "%PROJECT_DIR%database_setup.sql" 2>nul
        )
        
        if !errorlevel! equ 0 (
            echo [OK] Database '%DB_NAME%' created successfully.
        ) else (
            echo [WARNING] Could not create database. You may need to:
            echo          1. Start MySQL/XAMPP/WAMP service
            echo          2. Import database_setup.sql manually via phpMyAdmin
        )
    ) else (
        echo [WARNING] Cannot connect to MySQL. Please ensure:
        echo          1. MySQL/XAMPP/WAMP service is running
        echo          2. Import database_setup.sql via phpMyAdmin
    )
) else (
    echo [SKIPPED] MySQL not found. Import database_setup.sql manually.
)
echo.

:: ==========================================
:: COMPLETE
:: ==========================================
echo ============================================
echo   SETUP COMPLETE!
echo ============================================
echo.
echo   PHP installed:      %PHP_PATH%
echo   Composer installed: %COMPOSER_PATH%
echo   Project directory:  %PROJECT_DIR%
echo   Database:           %DB_NAME%
echo.
echo   To start the server, run: run.bat
echo   Or: php spark serve --port 8080
echo.
echo   Visit: http://localhost:8080
echo.
echo   NOTE: Close and reopen any terminals
echo         for PATH changes to take effect.
echo ============================================
echo.

pause
exit /b 0

:: ==========================================
:: FUNCTION: Add to System PATH
:: ==========================================
:AddToSystemPath
set "NEW_PATH=%~1"

:: Get current System PATH
for /f "tokens=2*" %%a in ('reg query "HKLM\SYSTEM\CurrentControlSet\Control\Session Manager\Environment" /v Path 2^>nul') do set "SYS_PATH=%%b"

:: Check if already in PATH
echo !SYS_PATH! | findstr /i /c:"%NEW_PATH%" >nul
if %errorlevel% equ 0 (
    goto :eof
)

:: Add to System PATH (requires admin)
reg add "HKLM\SYSTEM\CurrentControlSet\Control\Session Manager\Environment" /v Path /t REG_EXPAND_SZ /d "%SYS_PATH%;%NEW_PATH%" /f >nul 2>&1
if %errorlevel% equ 0 (
    echo [OK] Added to System PATH: %NEW_PATH%
    :: Broadcast environment change
    powershell -Command "[Environment]::SetEnvironmentVariable('Path', [Environment]::GetEnvironmentVariable('Path', 'Machine') + ';%NEW_PATH%', 'Machine')" >nul 2>&1
) else (
    :: Fallback to User PATH
    for /f "tokens=2*" %%a in ('reg query "HKCU\Environment" /v Path 2^>nul') do set "USR_PATH=%%b"
    setx PATH "%USR_PATH%;%NEW_PATH%" >nul 2>&1
    echo [OK] Added to User PATH: %NEW_PATH%
)
goto :eof
