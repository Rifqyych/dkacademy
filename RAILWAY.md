# Deploy to Railway

Railway detects the root `Dockerfile` and reads `railway.toml`. The pre-deploy
step runs `php artisan migrate --force`; it does not delete existing data.

## Railway services

1. Create a project and add a PostgreSQL service.
2. Add a GitHub service from this repository.
3. In the app service Variables, add the following values:

```text
APP_NAME="DK Academy"
APP_ENV=production
APP_KEY=base64:your-existing-key
APP_DEBUG=false
APP_URL=https://your-generated-domain.up.railway.app
DB_CONNECTION=pgsql
DATABASE_URL=${{Postgres.DATABASE_URL}}
LOG_CHANNEL=stderr
LOG_LEVEL=error
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
MAIL_MAILER=log
WHATSAPP_ADMIN_PHONE=6281210669659
```

Use the actual PostgreSQL service name in the `DATABASE_URL` reference if it
is not named `Postgres`. The `DATABASE_URL` reference must appear in the
Laravel service, not only in the PostgreSQL service. Generate a public domain
in the Railway Networking settings after the first successful deployment.

Do not add `.env` to Git or upload it to the repository. Keep `APP_KEY` the
same across deployments so existing encrypted sessions remain valid.
