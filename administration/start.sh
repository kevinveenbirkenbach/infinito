#!/bin/bash
cd "$(dirname "$(readlink -f "${0}")")/../docker-symfony/" &&
docker-compose up -d
