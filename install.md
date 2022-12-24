# Installation Guide

## Install PHP 8.1 and Required Extensions

```shell
sudo apt update
sudo apt install --no-install-recommends php8.1
sudo apt-get install php8.1-xml php8.1-curl php8.1-dom
```

## Install Composer (https://getcomposer.org/download/)
Install composer
```shell
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
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
Copy .env.example file and rename as .env file.
Then run  
```shell
php artisan key:generate
```
Update APP_URL environment variable as below:  
```text
APP_URL=http://localhost:8000
```

## Install NodeJS 16
Install curl if not installed
```shell
sudo apt update
```
```shell
sudo apt install curl
```

Install NodeJS
```shell
curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
```
```shell
sudo apt-get install -y nodejs
```

Make sure NodeJS 16 is installed
```shell
node --version
```

## Install npm Packages
```shell
npm install
```

## Seed 50 Students 
```shell
php artisan student:seed 50
```


## Update crontab
Edit the following line by your project directory, then add to crontab.  
This is required to update selected students periodically.
```text
* * * * * php /path-to-project-directory/artisan schedule:run >> /dev/null 2>&1
```
