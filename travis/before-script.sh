#!/bin/bash -e

cp app/config/parameters.yml.dist app/config/parameters.yml
php bin/console ca:c --env=test
