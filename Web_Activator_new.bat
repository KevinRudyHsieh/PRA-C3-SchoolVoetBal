@echo off
title Website Installation
set "filepath=%cd%"
copy ".env.example" ".env"

tasklist /fi "ImageName eq laragon.exe" /fo csv 2>NUL | find /I "laragon.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo Laragon is running.
) else (
    cd C:\ProgramData\Microsoft\Windows\Start Menu\Programs\laragon
    start Laragon.lnk
)

cd %filepath%
clear
echo Voordat je verder gaat! Zet laragon eerst aan.
echo Welke versie van laragon gebruik je?
echo 1. Oude versie
echo 2. Nieuwe versie
set /p userInput=1/2: 
copy ".env.example" ".env"
cls
echo Installing website
echo Deze window blijft even "frozen" terwijl hij installatie uitvoert, als hij vanuit het niks sluit. Laat mij even weten want dan klopt er iets niet!
if %userInput%==1 goto old
if %userInput%==2 goto new
if %userInput%==3 goto debug


:old
@REM setlocal enabledelayedexpansion
@REM set "file=composer.json"
@REM set "search_variable=composer-runtime-api"
@REM set "new_value=^2.0"

@REM set "tempfile=temp.json"

@REM (for /f "delims=" %%a in ('type %file%') do (
@REM     set "line=%%a"
@REM     set "line=!line:%search_variable%=%new_value%!"
@REM     echo !line!
@REM )) > %tempfile%

@REM move /y %tempfile% %file%

@REM endlocal
start /min /WAIT cmd.exe /k "cd %filepath% & title Composer installer & composer require composer-runtime-api:^2.0 & exit"
goto rest


:new 
start /min /WAIT cmd.exe /k "cd %filepath% & title Composer installer & composer install & exit"
goto rest

:debug
start /min /WAIT cmd.exe /k "cd %appdata%\composer & title Updater & php latest.phar install & exit"
goto rest

:rest
php artisan key:generate
php artisan migrate
start /min /WAIT cmd.exe /k "cd %filepath% & title Package installer & npm install & exit"
php artisan db:seed
echo --------------------
echo Installation Done!
pause