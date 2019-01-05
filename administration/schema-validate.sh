#!/bin/bash
cd "$(dirname "$(readlink -f "${0}")")/../docker-symfony/" && 
docker-compose exec php bin/console doctrine:schema:validate
