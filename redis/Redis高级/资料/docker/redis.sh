#!/bin/bash
#在/usr/local/server/redis-cluster下生成conf和data目标，并生成配置信息

#输入信息
read -p "请输入本机IP地址：" Native_IP

# 创建文件夹
mkdir -p /usr/local/server/redis-cluster
# 下载redis配置模板
echo "正在下载redis-cluster.tmpl配置模板，请手动下载redis-cluster.tmpl文件并复制到/usr/local/server/redis-cluster目录";
# 文件下载地址 请手动下载redis-cluster.tmpl文件
#wget -P /usr/local/server/redis-cluster https://srv-file22.gofile.io/download/RoGvVk/redis-cluster.tmpl

echo "正在创建redis-net网络";
#c创建网络
docker network create redis-net

echo "正在创建redis配置文件";
for port in `seq 7001 7006`; 
do 
  mkdir -p /usr/local/server/redis-cluster/${port}/conf && PORT=${port} Native_IP=${Native_IP}  envsubst < /usr/local/server/redis-cluster/redis-cluster.tmpl > /usr/local/server/redis-cluster/${port}/conf/redis.conf && mkdir -p /usr/local/server/redis-cluster/${port}/data;
done
echo "正在启动redis容器";
#创建6个redis容器
for port in `seq 7001 7006`;
do
	docker run -d -it -p ${port}:${port} -p 1${port}:1${port} -v /usr/local/server/redis-cluster/${port}/conf/redis.conf:/usr/local/etc/redis/redis.conf -v /usr/local/server/redis-cluster/${port}/data:/data --privileged=true --restart always --name redis-${port} --net redis-net --sysctl net.core.somaxconn=1024 redis redis-server /usr/local/etc/redis/redis.conf;
done
#查找ip
for port in `seq 7001 7006`;
do
	echo  -n "$(docker inspect --format '{{ (index .NetworkSettings.Networks "redis-net").IPAddress }}' "redis-${port}")":${port}" ";
done
#换行
echo -e "\n"
#输入信息
read -p "请把输入要启动的docker容器名称，默认redis-7001：" DOCKER_NAME
#判断是否为空
if [ ! $DOCKER_NAME ]; 
	then DOCKER_NAME='redis-7001'; 
fi
#进入容器
docker exec -it redis-7001 /bin/bash

# 删除容器
#docker rm -f $(docker ps -a |  grep "redis-*"  | awk '{print $1}')
