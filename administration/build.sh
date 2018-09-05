cp .env.dist docker-symfony/.env
(cd ../docker-symfony/ && docker-compose build && docker-compose up -d)
