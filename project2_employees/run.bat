@echo off
cd /d "%~dp0"

set "DEV_PHP=%USERPROFILE%\DevTools\php\php.exe"

if exist "%DEV_PHP%" (
    set "PHP_CMD=%DEV_PHP%"
) else (
    where php >nul 2>nul
    if %errorlevel% equ 0 (
        set "PHP_CMD=php"
    ) else (
        echo [ERROR] PHP not found. Please run setup.bat first.
        pause
        exit /b 1
    )
)

echo ============================================
echo   Employee Management - Starting Server
echo ============================================
echo Using PHP: %PHP_CMD%
echo.
echo Server running at: http://localhost:8082
echo Press Ctrl+C to stop the server.
echo ============================================
echo.

"%PHP_CMD%" spark serve --port 8082
