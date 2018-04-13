#!/bin/sh

php -d phar.readonly=0 vendor/bin/phing package_phar
chmod +x magentor.phar
