#!/bin/bash -e

if [ "${CODECOV}" = "true" ] ; then
    pip install --user codecov;
fi

composer install -n
