## 集群安装

1、首先将tar文件和docker-compose-kafka.yml上传到linux服务器

2、把tar文件恢复成为一个镜像

```
docker load -i zookeeper.tar
docker load -i kafka.tar
docker load -i efak.tar
```

3、查看镜像

```
docker images
```

4、在 docker-compose文件所在的目录中运行以下命令

```
docker compose -f docker-compose-kafka.yml up -d

#重启
docker compose -f docker-compose-kafka.yml restart
```

5、验证服务是否运行

```
docker ps
```
### 补充
```js
1. 核心依赖关系：ZooKeeper 是 Kafka 的 “基础设施”
ZooKeeper（zookeeper.tar）：
是 Kafka 集群的 “分布式协调中心”，负责管理 Kafka 的元数据：
记录 broker 节点的注册信息（哪些节点在线）；
管理主题（Topic）的分区信息（分区数量、副本分布）；
协调分区的 leader 选举（确保分区故障时自动切换 leader）。
简单说：Kafka 集群必须依赖 ZooKeeper 才能正常启动和运行，没有 ZooKeeper，Kafka 无法完成集群协同。

2. 核心功能关系：Kafka 是 “业务核心”，依赖 ZooKeeper 运行
Kafka（kafka.tar）：
是整个体系的 “消息引擎核心”，负责消息的生产、存储、消费：
接收生产者发送的消息，持久化到磁盘；
向消费者提供消息订阅和拉取服务；
但 Kafka 自身不存储集群元数据（如节点列表、分区信息），必须从 ZooKeeper 中读取和更新这些数据。
简单说：Kafka 是业务功能的载体，ZooKeeper 是其 “幕后协调者”，二者配合完成消息的分布式处理。


---- kafka服务实例就是broker服务实例


3. 辅助关系：EFAK 是 Kafka 的 “监控工具”
EFAK（efak.tar，即 Kafka Eagle）：
是 Kafka 集群的可视化监控工具，本身不参与消息处理，仅用于 “观察和管理” Kafka：
连接 ZooKeeper 获取 Kafka 集群的元数据（如主题列表、分区分布）；
监控 Kafka 的运行状态（消息吞吐量、消费延迟、broker 负载）；
提供管理功能（如创建主题、调整分区、查看消费组进度）。
简单说：EFAK 是 “旁观者” 和 “管理者”，依赖 Kafka 和 ZooKeeper 提供的数据，帮助用户了解集群状态。
```

- 三者协同流程
  - 启动 ZooKeeper：先启动协调中心，为 Kafka 提供元数据存储服务；
  - 启动 Kafka：Kafka 节点启动后，向 ZooKeeper 注册自身信息，并从 ZooKeeper 读取集群配置，形成可用的 Kafka 集群；
  - 启动 EFAK：EFAK 连接 ZooKeeper，获取 Kafka 集群的元数据和运行数据，提供可视化监控界

## docker-compose说明

这个 `docker-compose.yml` 文件定义了一个包含 Zookeeper 和三个 Kafka 实例以及一个管理工具 (Kafka Eagle) 的多服务 Docker Compose 配置。以下是对每个部分的逐行解释：

### 文件版本

```
version: '3'
```



- **version: ‘3’**：指定使用 Docker Compose 文件格式的版本 3。这个版本支持多种功能，适用于定义多服务应用。



### 服务定义

#### Zookeeper 服务

```
services:
  zookeeper:
    image: wurstmeister/zookeeper
    container_name: zookeeper
    ports:
      - 2181:2181
    volumes:
      - "zookeeper-data:/data"
      - "zookeeper-datalog:/datalog"
      - "zookeeper-logs:/logs"
    restart: always
```



- **services**：定义 Docker Compose 文件中的服务。
- **zookeeper**：服务名称，包含 Zookeeper ，用于管理 Kafka 集群的元数据。
- **image: wurstmeister/zookeeper**：使用 `wurstmeister/zookeeper` 镜像。
- **container_name: zookeeper**：容器命名为 `zookeeper`。
- **ports**：
  - `2181:2181`：将主机 2181 端口映射到容器 2181 端口。
- **volumes**：
  - `"zookeeper-data:/data"`：挂载名为 `zookeeper-data` 的卷到容器内的 `/data` 目录。
  - `"zookeeper-datalog:/datalog"`：挂载名为 `zookeeper-datalog` 的卷到容器内的 `/datalog` 目录。
  - `"zookeeper-logs:/logs"`：挂载名为 `zookeeper-logs` 的卷到容器内的 `/logs` 目录。
- **restart: always**：docker重启后容器总是重启。
- **networks**：
  - `cluster_net`：将服务连接到名为 `cluster_net` 的网络。



#### Kafka 实例 

```
  kafka1:
    image: wurstmeister/kafka
    depends_on:
      - zookeeper
    container_name: kafka1
    ports:
      - "9092:9092"
    environment:
      - "KAFKA_BROKER_ID=1"
      - "KAFKA_ZOOKEEPER_CONNECT=192.168.100.102:2181"
      - "KAFKA_ADVERTISED_LISTENERS=PLAINTEXT://192.168.100.102:9092"
      - "KAFKA_LISTENERS=PLAINTEXT://0.0.0.0:9092"
      - "KAFKA_LOG_DIRS=/data/kafka-data"
    volumes:
      - "kafka1-data:/data/kafka-data"
      - "kafka1-config:/opt/kafka/config"
    restart: always
```



- **kafka1**：第一个 Kafka 服务实例。
- **depends_on：**
  - `zookeeper`：表示该服务依赖于 `zookeeper` 服务。
- **container_name: kafka1**：容器命名为 `kafka1`。
- **ports：**
  - `"9092:9092"`：将主机 9092 端口映射到容器 9092 端口。
- **environment：**
  - `"KAFKA_BROKER_ID=1"`：Kafka broker 的 ID 为 1。
  - `"KAFKA_ZOOKEEPER_CONNECT=192.168.100.102:2181"`：指定 Zookeeper 的连接地址和端口。
  - `"KAFKA_ADVERTISED_LISTENERS=PLAINTEXT://192.168.100.102:9092"`：客户端链接 Kafka 的地址。
  - `"KAFKA_LISTENERS=PLAINTEXT://0.0.0.0:9092"`：表示 Kafka broker 在所有网络接口的 9092 端口上监听连接，用于Kafka 集群的内部通信。
  - `"KAFKA_LOG_DIRS=/data/kafka-data"`：Kafka 日志目录为 `/data/kafka-data`。
- **volumes：**
  - `"kafka1-data:/data/kafka-data"`：挂载名为 `kafka1-data` 的卷到容器内的 `/data/kafka-data` 目录。
  - `"kafka1-config:/opt/kafka/config"`：挂载名为 `kafka1-config` 的卷到容器内的 `/opt/kafka/config` 目录。
- **restart: always**：docker重启后容器总是重启。



#### Kafka Eagle 服务

```
  eagle:
    container_name: eagle
    image: nickzurich/efak:latest
    restart: always
    ports:
      - "8048:8048"
    environment:
      - "EFAK_CLUSTER_ZK_LIST=192.168.100.102:2181"
    volumes:
      - "kafka-eagle:/hadoop/kafka-eagle/db"
```



- **eagle**：Kafka Eagle 服务，一个用于 Kafka 集群管理的工具。
- **container_name: eagle**：容器命名为 `eagle`。
- **image: nickzurich/efak:latest**：使用 `nickzurich/efak:latest` 镜像。
- **restart: always**：docker重启后容器总是重启。
- **ports：**
  - `"8048:8048"`：将主机 8048 端口映射到容器 8048 端口。
- **environment：**
  - `"EFAK_CLUSTER_ZK_LIST=192.168.100.102:2181"`：配置 Kafka Eagle 连接到 Zookeeper 的地址。
- **volumes：**
  - `"kafka-eagle:/hadoop/kafka-eagle/db"`：挂载名为 `kafka-eagle` 的卷到容器内的 `/hadoop/kafka-eagle/db` 目录。



### 数据卷定义

```
volumes:
  kafka1-data: {}
  kafka2-data: {}
  kafka3-data: {}
  zookeeper-data: {}
  zookeeper-datalog: {}
  zookeeper-logs: {}
  kafka-eagle: {}
  kafka1-config: {}
  kafka2-config: {}
  kafka3-config: {}
```



- **volumes**：定义容器会使用的命名卷。
- **kafka1-data**、**kafka2-data**、**kafka3-data**、**zookeeper-data**、**zookeeper-datalog**、**zookeeper-logs**、**kafka-eagle**、**kafka1-config**、**kafka2-config**、**kafka3-config**：各个自定义卷用于持久化存储 Kafka 和 Zookeeper 的数据和配置。