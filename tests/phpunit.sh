#!/bin/sh

clear
../vendor/bin/phpunit --configuration ./config/all-tests.xml
../vendor/bin/coveralls -v