# Өмнөговь IPM вэбсайтыг локалд ажиллуулах
# Ашиглах:  ./run.ps1
$ErrorActionPreference = 'Stop'
Set-Location $PSScriptRoot

# PHP-г олох (PATH → түгээмэл байршлууд). intl өргөтгөлтэй PHP 8.3+ шаардлагатай.
function Resolve-Php {
    $c = Get-Command php -ErrorAction SilentlyContinue
    if ($c) { return $c.Source }
    foreach ($p in @(
        "$env:USERPROFILE\.local\php85\php.exe",
        "$env:USERPROFILE\.config\herd-lite\bin\php.exe",
        'C:\php\php.exe', 'C:\laragon\bin\php\php.exe', 'C:\xampp\php\php.exe'
    )) { if (Test-Path $p) { return $p } }
    throw 'PHP олдсонгүй. https://php.new/install/windows/8.5 -ээр суулгана уу.'
}

$php = Resolve-Php
$phpDir = Split-Path $php
$env:PATH = "$phpDir;$env:PATH"
$composer = if (Get-Command composer -ErrorAction SilentlyContinue) { 'composer' }
    elseif (Test-Path "$env:USERPROFILE\.config\herd-lite\bin\composer.phar") { "$php `"$env:USERPROFILE\.config\herd-lite\bin\composer.phar`"" }
    else { 'composer' }

if (-not (Test-Path 'vendor'))      { Invoke-Expression "$composer install" }
if (-not (Test-Path '.env'))        { Copy-Item '.env.example' '.env'; & $php artisan key:generate }
if (-not (Test-Path 'node_modules')){ npm install }
if (-not (Test-Path 'database\database.sqlite')) { New-Item -ItemType File 'database\database.sqlite' | Out-Null }

& $php artisan migrate --force
& $php artisan storage:link 2>$null

# Vite dev server (арын процесс) + Laravel server
Start-Process -NoNewWindow -FilePath 'cmd.exe' -ArgumentList '/c', 'npm', 'run', 'dev'
& $php artisan serve --host=127.0.0.1 --port=8000
