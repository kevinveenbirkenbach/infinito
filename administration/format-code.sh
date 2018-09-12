(cd $(dirname $(readlink -f ${0}))/../docker-symfony/ && docker-compose exec php php vendor/bin/php-cs-fixer fix .)
