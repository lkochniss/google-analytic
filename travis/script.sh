#!/bin/bash -e

php bin/console security:check

if [ "${CODESNIFF}" = "true" ] ; then
    vendor/bin/phpcs --standard=PSR1,PSR2 src -s;
fi

if [ "${CODECOV}" = "true" ] ; then
   vendor/bin/phpunit --coverage-clover=coverage.xml;
else
   vendor/bin/phpunit;
fi