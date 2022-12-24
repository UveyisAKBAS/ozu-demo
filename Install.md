# Installation Guide

## Install PHP 8.1 and Required Extensions

```shell
sudo apt update
```

```shell
sudo apt install --no-install-recommends php8.1
```

```shell
sudo apt-get install php8.1-xml php8.1-curl php8.1-dom
```

## Install Composer (https://getcomposer.org/download/)
Install composer
```shell
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```

```shell
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```

```shell
php composer-setup.php
```

```shell
php -r "unlink('composer-setup.php');"
```

Add composer to PATH
```shell
sudo mv composer.phar /usr/local/bin/composer
```

Make sure composer installed
```shell
composer --version
```

## Install PHP Dependencies
```shell
composer install
```

## Setup .env File
Copy `.env.example` file to the same directory and rename as `.env` file.
Then run:
```shell
php artisan key:generate
```

## Seed 50 Randomly Generated Students
```shell
php artisan student:seed 50
```

## Update crontab
This is required to update selected students periodically.  
Edit the following line according to your project directory.
```text
* * * * * php /path-to-project-directory/artisan schedule:run >> /dev/null 2>&1
```
Then add this line to the crontab.


## Run Demo
Run following command:  
```shell
php artisan serve
```
Then go to: http://127.0.0.1:8000
