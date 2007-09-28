
# set the php command here.
PHP ?= php

%.html: %.php $(PWD)/template.php
	(cd `dirname $<` ; $(PHP) `basename $<` > `basename $@`)
