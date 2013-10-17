#!/bin/sh
cd /home/seaking/seaking_server
nohup /usr/local/bin/node app.js port=4012 seaking_server > /dev/null 2>&1 &
nohup /usr/local/bin/node app.js port=4013 seaking_server > /dev/null 2>&1 &