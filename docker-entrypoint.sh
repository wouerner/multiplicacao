#!/bin/bash
set -e
echo "[ ****************** ] Starting Endpoint of Application"
apache2ctl -D FOREGROUND
echo "[ ****************** ] Ending Endpoint of Application"
exec "$@"
