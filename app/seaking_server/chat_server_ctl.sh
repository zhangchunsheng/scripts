#!/bin/sh
cd /home/seaking/chat-server/game-server
#pomelo start production --daemon
#node_modules/pomelo/bin/pomelo start production --daemon
#nohup /usr/local/bin/node /usr/local/lib/node_modules/forever/bin/monitor app.js > /dev/null 2>&1 &
#nohup /usr/local/bin/node /home/seaking/chat-server/game-server/app.js env=production > /dev/null 2>&1 &
#nohup /usr/local/bin/node /home/seaking/chat-server/game-server/app.js env=production id=connector-server-1 host=127.0.0.1 port=4150 clientPort=3060 frontend=true auto-restart=true serverType=connector > /dev/null 2>&1 &
#nohup /usr/local/bin/node /home/seaking/chat-server/game-server/app.js env=production id=chat-server-1 host=127.0.0.1 port=4101 auto-restart=true serverType=chat > /dev/null 2>&1 &