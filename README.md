<p align="center"><a href="https://aulario.fi.uncoma.edu.ar" target="_blank" rel="noopener noreferrer"><img width="300" src="https://aulario.fi.uncoma.edu.ar/assets/img/aulario.png" alt="Aulario Logo"></a></p>
<br>
<div align="center">
<a href="https://github.com/matirinfante/Aulario/blob/production/LICENSE"><img alt="GitHub license" src="https://img.shields.io/github/license/matirinfante/Aulario?style=for-the-badge"></a>
<img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/matirinfante/aulario?style=for-the-badge">
<img alt="GitHub contributors" src="https://img.shields.io/github/contributors/matirinfante/aulario?style=for-the-badge">
</div>

## Tech Stack

<div align="center">
<img width="70" src="https://raw.githubusercontent.com/gilbarbara/logos/master/logos/laravel.svg"/>
<img width="70" src="https://github.com/devicons/devicon/blob/master/icons/jquery/jquery-original.svg"/>
<img width="70" src="https://github.com/devicons/devicon/blob/master/icons/bootstrap/bootstrap-plain.svg"/>                 
</div>


## Deployment
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


## Authors

- Augusto Perceval [@mistchenco](https://www.github.com/mistchenco)
- Cristhian Cantero [@CristhianCantero](https://www.github.com/CristhianCantero)
- Eluney Salvaro [@eluneysalvaro1](https://www.github.com/eluneysalvaro1)
- Guido Di Fiore [@guidodf98](https://www.github.com/guidodf98)
- Lucas Villarruel [@AndyVil](https://www.github.com/AndyVil)
- Lucía Landaeta [@Lucia-Landaeta](https://www.github.com/Lucia-Landaeta)
- Matías Infante [@matirinfante](https://www.github.com/matirinfante)
- Matías Peralta [@matiasperaltamacri](https://www.github.com/matiasperaltamacri)
- Pablo Romero [@PabloDamianRomero](https://www.github.com/PabloDamianRomero)
- Rocio Graff [@rociograff](https://www.github.com/rociograff)


## License

[Apache-2.0 license](https://choosealicense.com/licenses/apache-2.0/)

