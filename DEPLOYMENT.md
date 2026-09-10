# Deploy to DockHosting

## Before deployment

1. Commit and push the latest project files to GitHub.
2. Do not upload or commit `.env`. The Docker image deliberately excludes it.
3. In DockHosting, create a PostgreSQL database and attach it to this project.

## Project settings

Create a project from the GitHub repository. Keep the root directory as `/` and let DockHosting use the repository `Dockerfile`.

Add these environment variables in the DockHosting project settings:

```text
APP_NAME="DK Academy"
APP_ENV=production
APP_KEY=base64:replace-with-your-generated-key
APP_DEBUG=false
APP_URL=https://your-project.dockhosting.dev
DB_CONNECTION=pgsql
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
MAIL_MAILER=log
WHATSAPP_ADMIN_PHONE=6281210669659
```

When the attached database exposes `DATABASE_URL`, no additional database variable is needed because the application reads it automatically. Check the database Connection tab for its exact variable name. If it shows a different name, copy the full `postgres://...` connection string into a project variable named `DB_URL`.

Generate the application key locally with:

```powershell
php artisan key:generate --show
```

Copy the complete `base64:...` output into `APP_KEY` in DockHosting. Do not generate a new key after users have registered, because it invalidates encrypted cookies.

## Deploy

Click Deploy after the variables and database attachment are ready. The Dockerfile builds Vite assets, starts FrankenPHP on DockHosting's assigned port, and runs `php artisan migrate --force` automatically before serving the application.

## If a deploy fails

1. Open Deployment Logs and copy the first error line, not only the final failure summary.
2. If the error mentions `APP_KEY`, add the generated key above.
3. If it mentions PostgreSQL authentication or host lookup, confirm the database is attached and that `DB_URL` references the injected connection-string variable.
4. If it is a readiness timeout, ensure the project is using this repository's current `Dockerfile` and has not overridden its start command.
