#!/bin/bash -e

if [ "${CODECOV}" = "true" ] ; then
    pip install --user codecov;
fi

if [ "${CODESNIFF}" = "true" ] ; then
    pyrus install pear/PHP_CodeSniffer
    phpenv rehash
fi

composer install -n
