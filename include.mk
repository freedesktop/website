
# set the php command here.
PHP ?= php

# set path to the ooo-build checkout here.
OOO_BUILD ?= $(shell cd ../HEAD && pwd)

%.html: %.php $(PWD)/template.php
	@echo "Processing $<"
	cd `dirname $<` ; $(PHP) `basename $<` $(OOO_BUILD)> `basename $@`
