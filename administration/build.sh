(
cd $(dirname $(readlink -f ${0}))/../;
cp -v .env.dist docker-symfony/.env;
cd docker-symfony;
docker-compose build;
docker-compose up -d;
)
