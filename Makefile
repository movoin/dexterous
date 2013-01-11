DATE=$(shell date +%I:%M%p)
CHECK=\033[32m✔\033[39m
HR=\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#

#
# Build
#
build:
	@echo "\n${HR}"
	@echo "Building Dexterous..."
	@echo "${HR}\n"
	@mkdir -p runtime/cache
	@mkdir -p runtime/log
	@mkdir -p tests/fixtures
	@mkdir -p tests/functional
	@mkdir -p tests/unit
	@mkdir -p public/assets
	@mkdir -p public/uploads
	@chmod -R 777 runtime/cache runtime/log tests/fixtures tests/functional tests/unit public/assets public/uploads
	@echo "\n${HR}"
	@echo "Dexterous successfully built at ${DATE}."
	@echo "${HR}\n"
	@echo "Thanks for using Dexterous!"

#
# Clean
#
clean:
	rm -Rf runtime/cache
	rm -Rf runtime/log
	rm -Rf public/assets
	rm -Rf public/uploads

clean-test:
	rm -Rf tests/fixtures
	rm -Rf tests/functional
	rm -Rf tests/unit

