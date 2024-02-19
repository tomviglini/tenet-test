## Setup

```bash
docker-compose up
docker-compose exec api composer install
```

## Run Migration

```bash
docker-compose exec api php artisan migrate
```

## Run Seeds

```bash
docker-compose exec api php artisan db:seed
```
