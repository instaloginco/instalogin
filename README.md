### Code for Chrome Extension, Firefox extension, backend of https://instalogin.co.


To run BE:
```
git clone git@github.com:instaloginco/instalogin.git
cd instalogin
cp instalogin/.env.example instalogin/.env
cp services/.env.example services/.env
cd services
docker-compose up
```

Run composer:
```
docker exec -it instalogin_app composer install
```

Run migrations:
```
docker exec -it instalogin_app php artisan migrate:fresh 
```

Visit: http://127.0.0.1:7256

---

Todo: instructions how to set up postfix etc.

Have any questions? Join discord: https://discord.com/invite/9uaap4YxkZ
