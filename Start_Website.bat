@echo off
set "filepath=%cd%"

start /min cmd.exe /k "cd %filepath% & npm run dev"
start /min cmd.exe /k "cd %filepath% & php artisan serve"
timeout /t 1 /nobreak
start http://127.0.0.1:8000

tasklist /fi "ImageName eq laragon.exe" /fo csv 2>NUL | find /I "laragon.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo Laragon is running.
) else (
    cd C:\ProgramData\Microsoft\Windows\Start Menu\Programs\laragon
    start Laragon.lnk
)

exit