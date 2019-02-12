# laravel-vue

> A Laravel RESTfull API project

## Build Setup

``` bash
# Clone the repository
git clone https://github.com/emreeeaykut/app-laravel.git

# Switch to the repo folder
cd app-laravel

# Install all the dependencies using composer
composer install

# Copy the example env file and make the required configuration changes in the .env file
cp .env.example .env

# Run the database migrations (Set the database connection in .env before migrating)
php artisan migrate

# This command will create the encryption keys needed to generate secure access tokens
php artisan passport:install

# Start the local development server
php artisan serve
```

