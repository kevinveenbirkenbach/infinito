#!/bin/bash
# Copies the configuration files
cd "$(dirname "$(readlink -f "${0}")")/../" || exit 1
cp -v .env.dist docker-symfony/.env
cp -v ./application/phpunit.xml.dist ./application/phpunit.xml
