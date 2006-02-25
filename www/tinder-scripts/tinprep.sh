#!/bin/bash

# tinprep.sh - Prepare the workspace.
#
# Version 0.2 - 24.02.2006
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

patdir="/cygdrive/d/w1/ooopatches"
cd $builddir

# Copy some files that are needed for the build
cp ${patdir}/unicows/unicows.dll external/unicows/
cp ${patdir}/dbghelp/dbghelp.dll external/dbghelp/
cp -rf ${patdir}/gpc external/
cp --preserve=timestamps ${patdir}/moz/mozilla-source-1.7.5.tar.gz moz/download/
cp --preserve=timestamps ${patdir}/moz/vc71-glib-1.2.10-bin.zip moz/download/
cp --preserve=timestamps ${patdir}/moz/vc71-libIDL-0.6.8-bin.zip moz/download/
cp --preserve=timestamps ${patdir}/moz/wintools.zip moz/download/

cp -rf --preserve=timestamps ${patdir}/zipped moz/

cp -rf --preserve=timestamps ${patdir}/msvcp71 external/
