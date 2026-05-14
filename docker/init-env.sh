#!/usr/bin/env bash
set -euo pipefail
cp .env.docker.example .env
php artisan key:generate --force
