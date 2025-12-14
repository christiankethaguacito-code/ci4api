@echo off
cd /d "%~dp0"

echo ============================================
echo   Book Library System - Starting Server
echo ============================================
echo.
echo Server running at: http://localhost:8080
echo Press Ctrl+C to stop the server.
echo ============================================
echo.

php spark serve --port 8080
