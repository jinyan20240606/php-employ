#!/bin/bash
echo "正在停止所有redis容器";
docker stop $(docker ps -a |  grep "redis-*"  | awk '{print $1}')
echo "正在删除所有redis容器";
docker rm -f $(docker ps -a |  grep "redis-*"  | awk '{print $1}')
echo "正在删除redis-net网络";
docker network rm redis-net
echo "正在删除/usr/local/server目录";
rm -rf /usr/local/server

