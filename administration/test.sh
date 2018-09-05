(cd ../docker-symfony/ && docker-compose exec php php -d memory_limit=128M /var/www/symfony/vendor/bin/phpunit)
