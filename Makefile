all: clean
	[ ! -d build ] && mkdir build || true
	php -c php.ini bin/phar.php
clean:
	[ -d build ] && rm -rf build || true
install:
	[ ! -d $$HOME/bin ] && mkdir $$HOME/bin || true
	[ -f $$HOME/bin/git-package ] && rm $$HOME/bin/git-package || true
	cp build/git-package.phar $$HOME/bin/git-package
	chmod +x $$HOME/bin/git-package
