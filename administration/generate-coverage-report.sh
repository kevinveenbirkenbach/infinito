#!/bin/bash
cd "$(dirname "$(readlink -f "${0}")")/../docker-symfony/" || exit 1
docker-compose exec php php -d memory_limit=128M /var/www/symfony/vendor/bin/phpunit --coverage-html var/test-coverage-report
