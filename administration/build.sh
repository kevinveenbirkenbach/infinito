(
cd $(dirname $(readlink -f ${0}))/../;
cp -v .env.dist docker-symfony/.env;
cp -v ./application/phpunit.xml.dist ./application/phpunit.xml;
cd docker-symfony;
docker-compose build;
docker-compose up -d;
)
