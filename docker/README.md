# Docker dev stack

Run isolated, localhost-only.

```bash
cp .env.docker.example .env
# fill GSA_CLIENT_ID and GSA_CLIENT_SECRET via local editor/secret prompt, not chat
sudo docker compose build app
sudo docker compose run --rm app composer install --no-interaction --prefer-dist
sudo docker compose run --rm app php artisan key:generate --force
sudo docker compose run --rm node
sudo chmod -R a+rwX storage bootstrap/cache public/js public/css public/build
sudo docker compose create web app redis || true
sudo docker compose start redis app web
curl -I http://127.0.0.1:8080
```

Current dev stack notes:
- Web binds `127.0.0.1:8080` only.
- PHP image uses PHP 7.4 because the lockfile contains PHP >=7.4 packages.
- A `424 Calm down!` response means Laravel is running but GSA API credentials/data are not configured yet.

Stop/cleanup:

```bash
sudo docker compose down
# remove redis/cache volumes too
sudo docker compose down -v
```
