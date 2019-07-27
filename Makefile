DOCKER_COMPOSE = docker-compose

##
## Quality assurance
## -----------------
##
php-cs-fixer:                                          ## php-cs-fixer
	$(DOCKER_COMPOSE) exec php vendor/bin/php-cs-fixer fix --verbose --diff --diff-format=udiff

.PHONY : clean
