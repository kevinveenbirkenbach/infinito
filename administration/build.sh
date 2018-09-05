cp .env.dist docker-symfony/.env
(cd $(dirname $(readlink -f ${0}))/../docker-symfony/ && docker-compose build && docker-compose up -d)
