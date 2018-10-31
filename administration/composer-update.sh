(cd $(dirname $(readlink -f ${0}))/../docker-symfony/&& docker-compose exec php composer install && docker-compose exec php composer update)
