#!/bin/bash

# tinbuild.sh - The build script that starts the build and captures the
# logfile
#
# Version 0.2 - 22.12.2005
#
# Syntax:
# tinbuild.sh ws buildlog src_path
#
#  Parameter see tin-main.pl.


echo Full build of tree: $1
tree=$1
if [ "$1" = "" ]; then
  echo First parameter is the build tag
  exit 1
fi

logfile=$2
if [ "$2" = "" ]; then
  echo Second parameter is logfile
  exit 1
fi
echo Writing log to: $logfile
echo Logfile name: $logfile > $logfile

builddir=$3
if [ "$3" = "" ]; then
  echo Third parameter is builddir
  exit 1
fi

if [ ! -d $builddir ] ; then
  echo "Build directory is missing"
  exit 1
fi

echo Building in dir: $builddir
echo Building in dir: $builddir >> $logfile

# Build *env.*
echo >> $logfile
echo -------------------------------------------------- >> $logfile
echo buildconf started at: `date +%T` >> $logfile

(
cd $builddir

# -- Things to tweak --
# The values set in this section control the parameters that are used to
# configure the build. Currently they show an example Windows build
# configuration.

# Speed up build, remove pathes.
CYGSYSTEMROOT=`cygpath -u "$SYSTEMROOT"`
CYGPROGRAMFILES=`cygpath -d "$PROGRAMFILES"`
CYGPROGRAMFILES=`cygpath -u "$CYGPROGRAMFILES"`
export PATH="/bin:$CYGSYSTEMROOT/system32:$CYGSYSTEMROOT"
export PATH="$PATH:$CYGPROGRAMFILES/NSIS"

cd config_office
# echo Create a new configure
# touch configure.in
# autoconf

rm -f config.cache

tcshpara="--with-use-shell=tcsh"

buildmoz=""
#buildmoz="--enable-build-mozab --with-mozilla-version=1.7.5"
crashdump=""
#crashdump="--enable-crashdump"
#languages=""
languages="--with-lang=de"

jdk_home="/cygdrive/c/j2sdk1.4.2_05"

./configure $tcshpara $buildmoz $languages $crashdump \
  --with-cl-home="/cygdrive/c/MSVS2003/Vc7" \
  --with-jdk-home="$jdk_home" \
  --with-ant-home=/cygdrive/c/apache-ant-1.6.5 \
  --with-csc-path=/cygdrive/c/WINDOWS/Microsoft.NET/Framework/v1.1.4322 \
  --with-build-version="W32-tcsh on opti" \
 && exit 1

# -- End of Things to tweak --

) >> $logfile 2>&1

echo buildconf ended at: `date +%T` >> $logfile
if [ -e $logfile.err ]; then
  exit 1
fi

#Build OOo
echo >> $logfile
echo -------------------------------------------------- >> $logfile
BUILDSTART="build started at: `date +%T`"
echo $BUILDSTART >> $logfile
BUILDSTARTSEC=`date +%s`

cd $builddir
source winenv.set.sh >> $logfile 2>&1 || touch $logfile.err
./bootstrap >> $logfile 2>&1 || touch $logfile.err
if [ -e $logfile.err ]; then
  exit 1
fi
dmake >> $logfile 2>&1 || touch $logfile.err

sleep 2
echo "build finished"
echo >> $logfile
echo -------------------------------------------------- >> $logfile
echo $BUILDSTART >> $logfile
echo "build ended at: `date +%T`" >> $logfile
BUILDENDSEC=`date +%s`
TOTALSEC=$(($BUILDENDSEC - $BUILDSTARTSEC))
BHOURS=$(($TOTALSEC / 3600))
RESTSEC=$(($TOTALSEC % 3600))
BMINS=$(($RESTSEC / 60))
BSECS=$(($RESTSEC % 60))
echo "Total build time: $TOTALSEC ($BHOURS:$BMINS:$BSECS)" >> $logfile

if [ -e $logfile.err ]; then
  exit 1
fi

echo Ready!
