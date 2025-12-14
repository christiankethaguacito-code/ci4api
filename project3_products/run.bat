@echo off
cd /d "%~dp0"

echo ============================================
echo   Product Inventory - Starting Server
echo ============================================
echo.
echo Server running at: http://localhost:8083
echo Press Ctrl+C to stop the server.
echo ============================================
echo.

php spark serve --port 8083
