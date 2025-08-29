```yaml
docker run -id -p 3306:3306 --name=mysql -v /root/mysql/conf:/etc/mysql/conf.d -v /root/mysql/logs:/logs -v /root/mysql/data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=root mysql:5.7.25


docker update --restart always mysql
```



```
docker run -d \
-e PREFER_HOST_MODE=hostname \
-e MODE=standalone \
-e SPRING_DATASOURCE_PLATFORM=mysql \
-e MYSQL_SERVICE_HOST=192.168.200.130 \
-e MYSQL_SERVICE_PORT=3306 \
-e MYSQL_SERVICE_USER=root \
-e MYSQL_SERVICE_PASSWORD=root \
-e MYSQL_SERVICE_DB_NAME=nacos_config \
-e NACOS_SERVER_IP=192.168.200.130 \
-e JVM_XMS=512m \
-e JVM_XMX=512m \
-e JVM_XMN=128m \
-p 8848:8848 --restart=always \
--name nacos  \
nacos/nacos-server:1.3.2
```

