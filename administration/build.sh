#!/bin/bash
cd "$(dirname "$(readlink -f "${0}")")/" &&
bash ./copy-configuration.sh &&
cd ../docker-symfony &&
docker-compose build &&
docker-compose up -d
