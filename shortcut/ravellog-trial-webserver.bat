@echo off
echo Open up ravellog-trial-webserver
cd C:\Kantor\ravellog\trial\ravellog-trial\webserver
php artisan serve --host 0.0.0.0 --port 8000
:exit