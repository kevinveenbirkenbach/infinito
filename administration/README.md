# Administration

**You MUST document all administration scripts in this file**

In this folder you will find all necessary scripts to run and configure the application. The purpose of this scripts is to automize the administration process and help programmers to speed up their development and reduce the administration tasks of them.

## Requirements

This scripts are optimized for Ubuntu, but may they will run on MAC OS.

Tested on a Ubuntu 18.04.1 LTS machine.

## Initialization

To initialize the docker environment, please execute in the root:

```
bash administration/init.sh
```

Afterwards you can access the service via http://127.0.0.1:80.

## Scripts
### [build.sh](./build.sh)
This script builds the [docker-compose environment](https://docs.docker.com/compose/) and sets it up.

### [cleanup-ignored.sh](./cleanup-ignored.sh)
This script removes all files and folders which are ignored by git. Be careful with using it.

**ATTENTION:** You MUST study this script before you execute it!

### [clear.sh](./clear.sh)
This folder clears the productive and environment cache of the [Symfony](https://symfony.com/) application.

### [composer-update.sh](./composer-update.sh)
This script updates the composer components.

###  [copy-configuration.sh](./copy-configuration.sh)
This script copies the ***.env.dist*** files to the right locations.

###  [format-code.sh](./format-code.sh)
This script formats the PHP code with [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer).

###  [generate-coverage-report.sh](./generate-coverage-report.sh.sh)
This script generates a coverage report with  [PHPUnit](https://phpunit.de/).

### [init.sh](./init.sh)

This script initialize the whole environment to let the application run local.

### [load-fixtures.sh](./load-fixtures.sh)

This script loads the [Doctrine Fixtures](https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html).

### [mysql.sh](./mysql.sh)
This script offers a CLI to interact with the database.

### [node-container-cli.sh](./node-container-cli.sh)

This script offers a CLI to interact with the node container.

### [recreate-database.sh](./recreate-database.sh)

This script drops and creates the database.

### [router.sh](./router.sh)

This script shows the possible [Symfony routes](https://symfony.com/doc/current/routing.html).


### [schema-update.sh](./schema-update.sh)

This script updates the database schema based on [Doctrines ORM](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/working-with-objects.html)

### [schema-validate.sh](./schema-validate.sh)

This script validates the database schema based on [Doctrines ORM](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/working-with-objects.html)

### [services.sh](./services.sh)

This script shows the possible [Symfony services](https://symfony.com/doc/current/service_container.html).

### [schema-validate.sh](./schema-validate.sh)

This script validates the administration scripts with  [shellcheck](https://www.shellcheck.net/)


### [start.sh](./start.sh)

This script starts the local instance of the software. It can just be executed in an initialized environment.

### [stop.sh](./stop.sh)

This script stops the local instance of the software.

### [submodule.sh](./submodule.sh)

This script pulls the [git submodules](https://git-scm.com/book/en/v2/Git-Tools-Submodules).

### [submodule-init.sh](./submodule-init.sh)

This script initializes the [git submodules](https://git-scm.com/book/en/v2/Git-Tools-Submodules).

### [submodule-sync.sh](./submodule-sync.sh)

This script synchronizes the [git submodules](https://git-scm.com/book/en/v2/Git-Tools-Submodules).

### [symfony-container-cli.sh](./symfony-container-cli.sh)

This script offers a cli for the symfony container.

### [test-code-format.sh](./test-code-format.sh)

This script tests if the PHP code is formated well.

### [test-everything.sh](./test-everything.sh)

This script tests if all of the other test scripts succeed.

### [test.sh](./test.sh)

This script executes the following tests of [PHPUnit](https://phpunit.de/):

- [Functional tests](https://en.wikipedia.org/wiki/Functional_testing)
- [Integration tests](https://de.wikipedia.org/wiki/Integrationstest)
- [Unit Tests](https://en.wikipedia.org/wiki/Unit_testing)

### [total-clean.sh](./total-clean.sh)

This script tests cleans all data of the local environment.

**ATTENTION:** You MUST study this script before you execute it!
