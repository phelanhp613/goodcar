Document Root Source

II. Set .env file Clone .env.example to .env and set database info.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=
III. Install laravel in root folder project Run this command:

    composer install
IV. Migrate base table Run this command:

    php artisan migrate
V. Run permission Run this command:

    php artisan permissions:update
VI. Generate Application Key: Run this command:

    php artisan key:generate
VII. Generate Data Fake: Run this command:

    php artisan db:seed
IX. Make migration in module:

    php artisan make:migration {migration_name} {--create=table_name}/{--table=table_name} --path={path}

    php artisan make:migration update_order_details_table --table=order_details --path=modules/Order/Migrations
X. Storage link:

    php artisan storage:link