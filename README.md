## Aulario

⚠️Under construction...⚠️
## How to run it
- Clone project
```
git clone https://github.com/matirinfante/Aulario.git
```
- Install dependencies from composer.json and package.json
```
composer install
npm install && npm run dev
```
- Create a new database and config your .env file (line 11 for reference)
  - Also you can use .env.example 
```
DB_CONNECTION=<your_db_connection>
DB_HOST=<your_host>
DB_PORT=<your_port>
DB_DATABASE=<your_database_name>
DB_USERNAME=<your_username>
DB_PASSWORD=<your_password>
```
- Run migrations to set your db tables structure and seed it with pre-built factories
```
php artisan migrate --seed
```
- Serve it
```
php artisan serve
```
- Default user
```
email: mail@admin.com
pass: admin123
```

- If you have any 500 Server error, try CTRL+C and then
```
php artisan cache:clear
composer dump-autoload
php artisan key:generate
```

## Laravel License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
