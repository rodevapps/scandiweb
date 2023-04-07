#!/bin/bash


if [ `ps ax | egrep "lt --port" | wc -l` -lt 2 ]
then
 export PATH="${PATH}:/home/rafal/node-v18.15.0-linux-x64/bin"
 export LD_LIBRARY_PATH="${PATH}:/home/rafal/node-v18.15.0-linux-x64/lib"
 nohup nice -n 19 lt --port 8000 -s scandiweb &> /home/rafal/scandiweb.log &
fi


exit 0
