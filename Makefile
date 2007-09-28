

include include.mk


ALL_TARGETS = index.html \
	download/index.html \
	discover/index.html \
	discover/comingsoon/index.html \
	developers/index.html \
	about/index.html

all: $(ALL_TARGETS)
