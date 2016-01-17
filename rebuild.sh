#!/bin/bash

docker stop symfony-worker
docker build -t symfony-worker .
