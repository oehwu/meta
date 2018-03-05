#!/usr/bin/env bash

# We need to install dependencies only for Docker
[[ ! -e /.dockerenv ]] && [[ ! -e /.dockerinit ]] && exit 0

set -xe

apt-get update -yqq
apt-get install git wget -yqq

pecl install xdebug > /dev/null
docker-php-ext-enable xdebug > /dev/null
