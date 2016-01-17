#!/bin/bash

echo "stop symfony worker"
docker stop symfony-worker

echo "close project volume"
docker rm -f symfony-worker 2> /dev/null
docker rm -f symfony-volume 2> /dev/null

echo "check container status"
docker ps
