### Requirement
    - PHP 8.2
    - Composer
    - Mysql

<br>

### Configuration
    - copy .env.example file : 
        - run : cp env.example .env
    - change your db setting inside .env file :
        - DB_CONNECTION=mysql
        - DB_DATABASE=your_db
        - DB_USERNAME=your_username
        - DB_PASSWORD=your_password

<br>

### Setup
#### run this command
    - composer install
    - php artisan key:generate
    - php artisan migrate
    - php artisan db:seed
