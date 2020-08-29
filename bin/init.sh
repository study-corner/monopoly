#!/usr/bin/env bash

rm -rf .env

export eth_interface=$(ip token | grep -v lo | grep -v br- | grep -v veth | grep -v docker | grep -v wlan | grep -v wlp | awk '{print $4}')
export host_ip=$(ifconfig $eth_interface | grep inet | grep -v inet6 | awk '{print $2}')

echo 'HOST_IP='$host_ip >> .env
echo '' >> .env

echo 'Host ip' $host_ip 'added to .env file.'

cat .env.dist >> .env
echo '.env.dist content added to .env file.'

docker-compose down || true
docker-compose build
docker-compose up -d
