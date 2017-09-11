rebuild:
		cd grammar && php rebuildParser.php --debug

build: rebuild
		php-cs-fixer fix ./lib
