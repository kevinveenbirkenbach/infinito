#!/bin/sh
(cd $(dirname $(readlink -f ${0}))/../docker-symfony/ && docker-compose exec php rm -vr var)
(cd $(dirname $(readlink -f ${0}))/../docker-symfony/ && docker-compose exec php rm -vr vendor )
(cd $(dirname $(readlink -f ${0}))/ && bash cleanup-ignored.sh)
