#!/bin/bash

echo "xdebug.remote_autostart=1" | sudo tee -a /etc/php7/conf.d/00_xdebug.ini > /dev/null
echo "xdebug.remote_connect_back=1" | sudo tee -a /etc/php7/conf.d/00_xdebug.ini > /dev/null

/home/ambientum/start.sh