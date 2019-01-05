#!/bin/bash
cd "$(dirname "$(readlink -f "${0}")")/../docker-symfony/" || exit 1
docker-compose exec php php bin/console doctrine:database:drop --force &&
docker-compose exec php php bin/console doctrine:database:create
