#!/bin/bash
cd "$(dirname "$(readlink -f "${0}")")/../docker-symfony/" || exit 1
docker-compose exec node /bin/bash
