rebuild:
		cd grammar && php rebuildParser.php

rebuild-debug:
		cd grammar && php rebuildParser.php --debug --keep-tmp-grammar

build: rebuild build-examples
		php-cs-fixer fix ./lib

test:
		vendor/bin/phpunit --coverage-text

build-examples: rebuild
		php examples/run.php
