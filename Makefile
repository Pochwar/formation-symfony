.PHONY: test

test:
	rm -rf var/data.db
	bin/console doctrine:database:create
	bin/console doctrine:schema:create
	bin/phpunit --testdox | more
