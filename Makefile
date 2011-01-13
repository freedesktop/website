ALL_TARGETS = \
	index.html\
	lgpl/index.html\
	foundation/index.html\
	foundation/newindex.html\
	foundation/bios.html\
	develop/index.html\
	contribution/index.html\
	supporters/index.html\
	contact/index.html\
	faq/index.html\
	imprint/index.html\
	privacy/index.html\
	petition/index.html

# set the php command here.
PHP ?= php

%.html: %.php template.php
	@echo "Processing $<"
	cd `dirname $<` ; $(PHP) `basename $<` $(OOO_BUILD)> `basename $@`

all: $(ALL_TARGETS) 

clean:
	rm -f $(ALL_TARGETS)

