#!/bin/bash

docker-compose up -d

# Wait for services to start
sleep 10

docker logs -f smart-supply-app-1

