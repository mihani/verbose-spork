DOCKER_COMPOSE = docker-compose

##
## Env Dev
##--------
install:
	touch docker/data/history
	cp .env .env.local
	$(DOCKER_COMPOSE) up -d

.PHONY : clean

##
## Quality assurance
## -----------------
cs-fixer:
	$(DOCKER_COMPOSE) exec php vendor/bin/php-cs-fixer fix --verbose

.PHONY : clean

##
## Env Test
## ---------
install-test:
	cp .env.test .env.test.local

phpunit:
	$(DOCKER_COMPOSE) exec php bin/phpunit

.PHONY : clean
