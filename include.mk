# set the php command here.
PHP ?= php

%.html: %.php $(PWD)/template.php
	@echo "Processing $<"
	cd `dirname $<` ; $(PHP) `basename $<` $(OOO_BUILD)> `basename $@`
