# Car renting app
Stack used:
 - Svelte
 - Laravel
 - Nginx
 - MySql

Hosted in Docker runtime.

## Setup
Edit `docker-compose.yml` file and change the ports, database credentials to your will but be sure to edit `.env` file inside of `/src` directory afterwards.

## Dev commands

Run docker and build containers:

    docker-compose build && docker-compose up -d
  
  Make migrations:
  

    docker-compose exec /var/www/html/artisan migrate
