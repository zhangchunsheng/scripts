#!/bin/sh
cd /home/seaking/jasmineTea
nohup /usr/local/bin/node app.js port=8090 ucenter_server > /dev/null 2>&1 &