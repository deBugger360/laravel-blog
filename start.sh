#!/usr/bin/env bash
set -euo pipefail

PORT="${PORT:-8080}"

# generate APP_KEY if not set
if [ -z "${APP_KEY:-}" ]; then
  echo "Generating APP_KEY..."
  php artisan key:generate --force
fi

# ensure storage link
if [ -d "storage/app/public" ] && [ ! -L "public/storage" ]; then
  echo "Creating storage symlink..."
  php -r "file_exists('storage/app/public') && !file_exists('public/storage') ? symlink('storage/app/public','public/storage') : exit(0);"
fi

# wait for DB (optional) — try to connect a few times
if [ -n "${DB_HOST:-}" ] && [ -n "${DB_DATABASE:-}" ]; then
  echo "Waiting for DB ${DB_HOST}:${DB_PORT:-3306} ..."
  for i in $(seq 1 30); do
    php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . (getenv('DB_PORT')?:3306) . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); echo 'ok'; } catch (Exception \$e) { exit(1); }" && break
    echo "DB not ready yet ($i) — sleeping 2s..."
    sleep 2
  done
fi

# run migrations (force, ignore errors but print)
echo "Running migrations..."
php artisan migrate --force || echo "Migrations failed or were skipped."

# start built-in PHP server bound to PORT
echo "Starting PHP server on 0.0.0.0:${PORT} ..."
exec php -S 0.0.0.0:"${PORT}" -t public