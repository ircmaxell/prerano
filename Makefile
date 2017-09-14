rebuild:
		cd grammar && php rebuildParser.php

rebuild-debug:
		cd grammar && php rebuildParser.php --debug --keep-tmp-grammar

build: rebuild
		php-cs-fixer fix ./lib

test:
		vendor/bin/phpunit --coverage-text

run: rebuild
		php examples/run.php 00-basic-usage
