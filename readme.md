# URL shortener API

Simple API made in Laravel Framework.

## Installation

You must have composer installed, if not, get it [here](https://getcomposer.org/download/).

- Clone the repo:

```bash
git clone https://github.com/frgz922/shorturl.git
```

- Go to project folder:

```bash
cd shorturl
```

- Install dependencies:

```bash
composer update
```

- Generate .env file:

```bash
cp .env.example .env
```

- Generate Application Key:

```bash
php artisan key:generate
```

- Configure .env file with your DB credentials.

```bash
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user_name
DB_PASSWORD=your_db_password
```

- Configure .env file with your APP URL.

```bash
APP_URL= your_app_url #i.e. shorturl.test
```

- Run Migrations:

```bash
php artisan migrate
```

## Usage

```laravel
GET  api/shorturl #returns Top 100 most visited URLs.
POST api/shorturl #creates and returns short url, param to pass: url, i.e. url=https://www.google.com/
```

## App on Heroku

The App has been deployed to Heroku, it can be accessed [here](https://terashorturl.herokuapp.com/).

## Challenges

- Choose the best way to generate the aliases to create the shorter URL. After a while of research i decided to use base_convert and crc32 on the ID generated to save the URL record on the DB.

## Reasoning behind decisions

- After some tests, i chose the best methods to acomplish the challenge.

## Future improvements

- Optimize the way the shoter URL is being redirected to the original one.

