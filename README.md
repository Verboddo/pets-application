# Pets Application Setup

This README provides instructions on how to set up the Pets Application, a web application built using PHP and Laravel.

## Requirements

- PHP 8.2.4
- Laravel 10.28.0
- Composer (Make sure you have Composer installed)
- Node.js (Make sure you have Node.js installed)

## Installation

1. Navigate to the directory where you want to set up your project and open a commandline. For example, if you are using Xampp, go to `C:\xampp\htdocs`.

2. Clone the project using Git:

   ```bash
   git clone https://github.com/Verboddo/pets-application.git

3. Go to the root directory of the project:
   ```bash
   cd pets-application

4. Run the following command to install Laravel dependencies:
   ```bash
   composer install

5. Run the following command to install JavaScript dependencies:
   ```bash
   npm install

6. Make sure the database credentials in your .env file are correctly configured.

7. Run the following command to migrate and seed the database with dummy data:
   ```bash
   php artisan migrate --seed

8. If there is no database yet, you will be prompted to create one (follow the command line instructions).

9. Start the local development server with:
   ```bash
   php artisan serve

10. Compile the frontend assets with:
    ```bash
    npm run dev

## Login Credentials

You can log in with the following credentials that are created by the seeder:

Email: random@gmail.com
Password: password
