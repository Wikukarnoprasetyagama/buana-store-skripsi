<h1>
    Buana Store - E-Commerce
</h1>

<!-- image thumbnail -->
![Buana Store Thumbnail](thumbnail.jpg)

<h2>
    <a href="https://skripsiku.wikukarno.com">Demo</a>
</h2>

<h3>
    Description
</h3>
<p>
Welcome to Buana Store, an advanced e-commerce platform built using Laravel 10. This application offers a seamless shopping experience, allowing customers to browse a wide range of products, add them to their cart, and make purchases with ease.
</p>

<h3>
    Features
</h3>
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

<h3>
    Installation
</h3>

<p>
    <b>Step 1:</b> Clone the repository to your local machine using the command below:
</p>

    ```bash
    git clone https://github.com/wikukarno/buana-store-skripsi.git
    ```
<p>
    <b>Step 2:</b> Install dependencies
</p>

    ```bash
    composer install
    ```
<p>
    <b>Step 3:</b> Create a copy of your .env file
</p>

    ```bash
    cp .env.example .env
    ```
<p>
    <b>Step 4:</b> Generate an app encryption key
</p>

    ```bash
    php artisan key:generate
    ```
<p>
    <b>Step 5:</b> Create an empty database for our application

<p>
    <b>Step 6:</b> In the .env file, add database information to allow Laravel to connect to the database
</p>

<p>
    <b>Step 7:</b> Migrate the database
</p>

    ```bash
    php artisan migrate --seed
    ```
<p>
    <b>Step 8:</b> Start the local development server
</p>

    ```bash
    php artisan serve
    ```
<p>
    You can now access the server at http://localhost:8000 or http://127.0.0.1:8000
</p>

<h3>
    License
</h3>

<p>
    The Laravel framework is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT">MIT license</a>.
</p>

<p>
    Buana Store is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT">MIT license</a>.
</p>

<p>
    <b>NOTE:</b> This project is for educational purposes only. We are not responsible for any kind of damage caused by any misuse of this project.
</p>