<h1>
    Buana Store - E-Commerce
</h1>

<!-- image thumbnail -->
![Buana Store Thumbnail](thumbnail.jpg)

<a href="https://skripsiku.wikukarno.com">
    Demo Website
</a>

## Description

<p>
Welcome to Buana Store, an advanced e-commerce platform built using Laravel 10. This application offers a seamless shopping experience, allowing customers to browse a wide range of products, add them to their cart, and make purchases with ease.
</p>


## Features

<ul>
    <li><b>Product Catalog</b></li>
    <li><b>Product Search</b></li>
    <li><b>Product Categories</b></li>
    <li><b>Product Details</b></li>
    <li><b>Automatic Payments:</b>Supports bank transfers and e-wallets for hassle-free transactions.</li>
    <li><b>User-Friendly Interface:</b>  Designed for easy navigation and a smooth shopping experience.</li>
    <li><b>User-Friendly Interface:</b>  Secure Transactions: Ensures high security for all your payment and personal details.</li>
    <li><b>Laravel 10 Framework: </b>Leveraging the latest features of Laravel for robust and scalable development.</li>
</ul>

## Installation

### Clone the repository

```
git clone https://github.com/wikukarno/buana-store-skripsi.git
```
    
### Install dependencies

```
composer install
```
### Create a copy of your .env file

```
cp .env.example .env
```

### Generate an app encryption key

```
php artisan key:generate
```

<p>Create an empty database for our application for example</p>

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```
### Migrate the database

```
php artisan migrate --seed
```

### Start the local development server

```
php artisan serve
```
<p>
    You can now access the server at http://127.0.0.1:8000
</p>

## License

<p>
    The Laravel framework is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT">MIT license</a>.
</p>

<p>
    Buana Store is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT">MIT license</a>.
</p>

<p>
    <b>NOTE:</b> This project is for educational purposes only. We are not responsible for any kind of damage caused by any misuse of this project.
</p>
