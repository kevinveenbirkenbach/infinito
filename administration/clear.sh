#!/bin/bash
(
cd "$(dirname "$(readlink -f "${0}")")/../docker-symfony/" && 
docker-compose exec php php /var/www/symfony/bin/console cache:clear &&
docker-compose exec php php /var/www/symfony/bin/console cache:clear --env=prod
)
