### Code for Chrome Extension, Firefox extension and Backend of https://InstaLogin.co


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

To process emails:
```
docker exec -it instalogin_app php artisan make:command ProcessEmail base64_encoded_email
```

http://127.0.0.1:7256

---

Set up postfix for incoming email:

https://docs.gitlab.com/ee/administration/reply_by_email_postfix_setup.html

---

Have any questions? Join discord: https://discord.com/invite/9uaap4YxkZ
