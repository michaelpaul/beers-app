DC=docker-compose
PHP=$(DC) run --rm php

.PHONY: up clean migrate update sh test

all: vendor up

vendor: composer.json composer.lock
	$(PHP) composer self-update
	$(PHP) composer validate
	$(PHP) composer install

up:
	$(DC) up

clean:
	$(PHP) yii cache/flush-schema --interactive=0
	$(PHP) yii cache/flush-all --interactive=0
	$(PHP) codecept clean
	$(PHP) find runtime -mindepth 1 -not -name .gitignore -delete

migrate:
	$(PHP) ./yii migrate --interactive=0
	$(PHP) ./tests/bin/yii migrate --interactive=0

update:
	$(PHP) composer update --prefer-dist

sh:
	$(DC) exec php bash

test:
	$(PHP) codecept run
