export VTIGERSYNC_ROOTDIR=`dirname "$0"`/..
export USE_PHP=php

cd $VTIGERSYNC_ROOTDIR

$USE_PHP -q vtigersync.php