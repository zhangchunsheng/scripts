#!/bin/sh
for sid in `ps -ef |grep your process info|grep -v grep|awk '{print$2}'`
do
kill -9 $sid
done