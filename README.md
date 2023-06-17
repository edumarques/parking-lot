<div align="center">

# Parking Lot Manager

Simple software solution that enables management of a parking lot.

![GitHub](https://img.shields.io/github/license/edumarques/parking-lot)
[![edumarques](https://circleci.com/gh/edumarques/parking-lot.svg?style=shield)](https://app.circleci.com/pipelines/github/edumarques)
[![codecov](https://codecov.io/gh/edumarques/parking-lot/branch/main/graph/badge.svg?token=ABGMyvr355)](https://codecov.io/gh/edumarques/parking-lot)

</div>

## Installation

The project can be installed and run using *Docker* and *docker-compose*.
To install *Docker*, visit its [official page](https://docs.docker.com/engine/install/).
And to install *docker-compose*, follow [these steps](https://docs.docker.com/compose/install/).
To help manage the project and execute commands in an quicker way,
there is a set of [Make](https://www.gnu.org/software/make/) targets already configured.

Set up and run the project just by running one of the following sets of commands:

```sh
make start
```

or

```sh
docker-compose build --pull --no-cache
docker-compose up --detach
```

## Useful tips

#### List of available commands using *Make*:

```text
 --- Makefile ---            
help                           Outputs this help screen
 --- Docker ---              
build                          Builds container(s)
up                             Start container(s)
up-d                           Start container(s) in detached mode (no logs)
start                          Set up, build and start the containers
stop                           Stop container(s)
down                           Stop and remove container(s)
logs                           Show logs
logs-f                         Show live logs
ps                             Show containers' statuses
sh                             Connect to a container via SH
php-sh                         Connect to the PHP FPM container via SH
 --- Code Quality ---        
phpcs                          Run PHP Code Sniffer
phpcs-fix                      Run PHP Code Sniffer (fix)
phpstan                        Run PHPStan
lint                           Run PHP Code Sniffer and PHPStan
test                           Run tests, pass the parameter "args=" to run the command with arguments or options
test-pretty                    Run tests in a pretty way, pass the parameter "args=" to run the command with arguments or options
test-cov                       Run tests and generate coverage report
 --- Composer ---            
composer                       Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
 --- App ---                 
console                        List all application commands or pass the parameter "c=" to run a given command, example: make command c=about
parking-lot-manager            Run the Parking Lot Manager
```
