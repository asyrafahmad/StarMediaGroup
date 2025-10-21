[TITLE] Star Media Group
Star Media Group Berhad Practical Test

Overview : This project is a Laravel 10 application built using PHP 8.1 and MySQL. Follow the steps below to set up and run the project locally.


Make sure the following are installed on your system:

1.  PHP 8.1+
2.  Composer
3.  Node.js & NPM
4.  MySQL


INSTALLATION STEPS

1.  Clone the Repository
    > git clone https://github.com/yourusername/star.git
    > cd star

2.  Install PHP Dependencies
    > composer install

3.  Install JavaScript Dependencies
    > npm install


ENVIRONMENT SETUP

Copy the example environment file:
> cp .env.example .env

Update your .env file with the correct database credentials:

DB_DATABASE=star_db
DB_USERNAME=root
DB_PASSWORD=


DATABASE SETUP

1.  Create a new MySQL database named:
    > CREATE DATABASE star_db;

2️.  Run Migrations
    > php artisan migrate

3.  Seed Database (to create admin account)
    > php artisan db:seed

4.  Run the Application
    Start the Laravel development server:
    > php artisan serve


Then visit the application in your browser: http://127.0.0.1:8000

To compile and build frontend assets:
> npm run dev


👤 Default Admin Account

After seeding, the admin account will be created automatically.

You can log in using the credentials provided in the seeder file (check DatabaseSeeder.php).

or 

Email       : admin@gmail.com
Password    : Admin123!