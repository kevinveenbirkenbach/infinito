#!/bin/sh
cd "$(dirname "$(readlink -f "${0}")")/../docker-symfony/" || exit 1
docker-compose exec php rm -vr var
docker-compose exec php rm -vr vendor
cd "$(dirname "$(readlink -f "${0}")")/" && bash cleanup-ignored.sh
