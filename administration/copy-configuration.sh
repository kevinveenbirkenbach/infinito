#!/bin/bash
# Copies the configuration files
cd "$(dirname "$(readlink -f "${0}")")/../" || exit 1
cp -v .env.dist docker-symfony/.env
cp -v ./application/symfony/phpunit.xml.dist ./application/symfony/phpunit.xml
