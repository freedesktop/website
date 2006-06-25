#!/bin/bash

# tinbuild.sh - The build script that starts the build and captures the
# logfile
#
# Version 0.5 - 25.06.2006
#
# Syntax:
# tinbuild.sh ws buildlog src_path [buildshell]
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
echo Logfile name: $logfile >> $logfile

builddir=$3
if [ "$3" = "" ]; then
  echo Third parameter is builddir
  exit 1
fi

buildshell=$4
if [ "$4" = "" ]; then
  echo Fourth parameter is missing
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

cd config_office
# echo Create a new configure
# touch configure.in
# autoconf

rm -f config.cache

if [ $buildshell = "tcsh" ]; then
tcshpara="--with-use-shell=tcsh"
ziphome=""
elif [ $buildshell = "bash" ]; then
tcshpara="--with-use-shell=bash"
ziphome=""
else
# This enables 4nt build
tcshpara="--with-use-shell=4nt"
ziphome="--with-zip-home=/cygdrive/c/zipnt"
fi

buildmoz=""
#buildmoz="--enable-build-mozab --with-mozilla-version=1.7.5"
crashdump=""
#crashdump="--enable-crashdump"
#languages=""
languages=--with-lang="de en-GB"
vc=""
#vc="--enable-cl-standard"

jdk_home="/cygdrive/c/j2sdk1.4.2_05"
#jdk_home="/cygdrive/c/Program Files/Java/jdk1.5.0_03"

./configure $tcshpara $buildmoz "$languages" $crashdump $ziphome \
  --with-cl-home="/cygdrive/c/MSVS2003/Vc7" $vc \
  --with-jdk-home="$jdk_home" \
  --with-ant-home=/cygdrive/c/apache-ant-1.6.5 \
  --with-csc-path=/cygdrive/c/WINDOWS/Microsoft.NET/Framework/v1.1.4322 \
  --with-build-version="W32-tcsh on opti" \
  --with-nsis-path="$CYGPROGRAMFILES/NSIS" \
 || touch $logfile.err

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

if [ $buildshell = "tcsh" -o $buildshell = "bash" ]; then

cd $builddir
./bootstrap >> $logfile 2>&1 || touch $logfile.err
source winenv.set.sh >> $logfile 2>&1 || touch $logfile.err
if [ -e $logfile.err ]; then
  exit 1
fi

#dmake >> $logfile 2>&1 || touch $logfile.err
cd instsetoo_native
build.pl --all -- -P2  >> $logfile 2>&1 || touch $logfile.err
#build.pl --all  >> $logfile 2>&1 || touch $logfile.err
cd ..

else
# 4nt build shell

/cygdrive/c/4NT401/4NT.EXE /c tinb_4nt.btm `cygpath -w $builddir` `cygpath -w $logfile` || touch $logfile.err

fi

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
