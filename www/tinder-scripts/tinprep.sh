#!/bin/bash

# tinprep.sh - Prepare the workspace.
#
# Version 0.1 - 22.12.2005
#
# Syntax:
# tinprep.sh src_path
#
#  Parameter see tin-main.pl.

echo Builddir: $1
builddir=$1
if [ "$1" = "" ]; then
  echo First parameter is the build dir
  exit
fi

# -- Things to tweak --
# OOo needs some things prepared before it can be build. Things like that
# can go into this file. Currently the commands here show an example for a
# Windows build configuration.

cd $builddir

# Copy some files that are needed for the build
cp ../ooopatches/unicows/unicows.dll external/unicows/
cp ../ooopatches/dbghelp/dbghelp.dll external/dbghelp/
cp -rf ../ooopatches/gpc external/
cp ../ooopatches/moz/mozilla-source-1.7.5.tar.gz moz/download/
cp ../ooopatches/moz/vc71-glib-1.2.10-bin.zip moz/download/
cp ../ooopatches/moz/vc71-libIDL-0.6.8-bin.zip moz/download/
cp ../ooopatches/moz/wintools.zip moz/download/

cp -rf ../ooopatches/zipped moz/

cp -rf ../ooopatches/msvcp71 external/

