#!/bin/bash


#if [ `ps ax | egrep "lt --port" | wc -l` -lt 2 ]
#then
 #export PATH="${PATH}:/home/rafal/node-v18.15.0-linux-x64/bin"
 #export LD_LIBRARY_PATH="${PATH}:/home/rafal/node-v18.15.0-linux-x64/lib"
 #nohup nice -n 19 lt --port 8000 -s scandiweb &> /home/rafal/scandiweb.log &
#fi

if [ `ps ax | egrep "pagekite.py" | wc -l` -lt 2 ]
then
 cd `dirname ${0}`

 python3 pagekite.py 8000 scandiweb2.pagekite.me
fi


exit 0
