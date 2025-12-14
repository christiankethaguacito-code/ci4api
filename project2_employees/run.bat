@echo off
cd /d "%~dp0"

echo ============================================
echo   Employee Management - Starting Server
echo ============================================
echo.
echo Server running at: http://localhost:8082
echo Press Ctrl+C to stop the server.
echo ============================================
echo.

php spark serve --port 8082
