#!/bin/bash
set -e

if [ ! -d "vendor" ] 
then
    echo "instalando dependencias"
else
    echo "dependencias já instaladas"
fi


echo "[ ****************** ] Starting Endpoint of Application"
rm -f /var/run/apache2/apache2.pid
apache2ctl -D FOREGROUND
echo "[ ****************** ] Ending Endpoint of Application"
exec "$@"
