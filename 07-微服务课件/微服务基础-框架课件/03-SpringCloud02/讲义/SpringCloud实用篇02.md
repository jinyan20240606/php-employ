# SpringCloud实用篇02

- [SpringCloud实用篇02](#springcloud实用篇02)
- [0.学习目标](#0学习目标)
- [1.Nacos配置管理](#1nacos配置管理)
  - [1.1.统一配置管理](#11统一配置管理)
    - [1.1.1.在nacos中添加配置文件](#111在nacos中添加配置文件)
    - [1.1.2.从微服务拉取配置](#112从微服务拉取配置)
    - [总结](#总结)
  - [1.2.配置热更新](#12配置热更新)
    - [1.2.1.方式一](#121方式一)
    - [1.2.2.方式二](#122方式二)
    - [总结](#总结-1)
  - [1.3.配置共享](#13配置共享)
    - [1）添加一个环境共享配置](#1添加一个环境共享配置)
    - [2）在user-service中读取共享配置](#2在user-service中读取共享配置)
    - [3）运行两个UserApplication，使用不同的profile](#3运行两个userapplication使用不同的profile)
    - [4）配置共享的优先级](#4配置共享的优先级)
      - [共享配置和扩展配置](#共享配置和扩展配置)
      - [总优先级](#总优先级)
  - [1.4.搭建Nacos集群](#14搭建nacos集群)
  - [环境隔离访问](#环境隔离访问)
- [2.Feign远程调用](#2feign远程调用)
  - [2.1.Feign替代RestTemplate](#21feign替代resttemplate)
    - [1）引入依赖](#1引入依赖)
    - [2）添加注解](#2添加注解)
    - [3）编写Feign的客户端](#3编写feign的客户端)
    - [4）测试](#4测试)
    - [5）总结](#5总结)
  - [2.2.自定义配置](#22自定义配置)
    - [2.2.1.配置文件方式](#221配置文件方式)
    - [2.2.2.Java代码方式](#222java代码方式)
  - [2.3.Feign使用优化](#23feign使用优化)
    - [http请求优化手段积累](#http请求优化手段积累)
      - [原理](#原理)
      - [框架](#框架)
  - [2.4.最佳实践](#24最佳实践)
    - [2.4.1.继承方式](#241继承方式)
    - [2.4.2.抽取方式](#242抽取方式)
    - [2.4.3.实现基于抽取的最佳实践](#243实现基于抽取的最佳实践)
      - [1）抽取](#1抽取)
      - [2）在order-service中使用feign-api](#2在order-service中使用feign-api)
      - [3）重启测试](#3重启测试)
      - [4）解决扫描包问题](#4解决扫描包问题)
- [3.Gateway服务网关](#3gateway服务网关)
  - [3.1.为什么需要网关](#31为什么需要网关)
  - [3.2.gateway快速入门](#32gateway快速入门)
    - [1）创建gateway服务，引入依赖](#1创建gateway服务引入依赖)
    - [2）编写启动类](#2编写启动类)
    - [3）编写基础配置和路由规则](#3编写基础配置和路由规则)
    - [4）重启测试](#4重启测试)
    - [5）网关路由的流程图](#5网关路由的流程图)
  - [3.3.断言工厂](#33断言工厂)
  - [3.4.过滤器工厂](#34过滤器工厂)
    - [3.4.1.路由过滤器的种类](#341路由过滤器的种类)
    - [3.4.2.请求头过滤器](#342请求头过滤器)
    - [3.4.3.默认过滤器](#343默认过滤器)
    - [3.4.4.总结](#344总结)
  - [3.5.全局过滤器](#35全局过滤器)
    - [3.5.1.全局过滤器作用](#351全局过滤器作用)
    - [3.5.2.自定义全局过滤器](#352自定义全局过滤器)
    - [3.5.3.过滤器执行顺序](#353过滤器执行顺序)
  - [3.6.跨域问题](#36跨域问题)
    - [3.6.1.什么是跨域问题](#361什么是跨域问题)
    - [3.6.2.模拟跨域问题](#362模拟跨域问题)
    - [3.6.3.解决跨域问题](#363解决跨域问题)
  - [3.7 网关限流(了解)](#37-网关限流了解)
    - [3.7.1 令牌桶算法原理](#371-令牌桶算法原理)
    - [3.7.2 Gateway中限流实现](#372-gateway中限流实现)



# 0.学习目标

# 1.Nacos配置管理

Nacos除了可以做注册中心，同样可以做配置管理来使用。

## 1.1.统一配置管理
![alt text](image.png)

当微服务部署的实例越来越多，达到数十、数百时，逐个修改微服务配置就会让人抓狂，而且很容易出错。我们需要一种统一配置管理方案，可以集中管理所有实例的配置。

![image-20210714164426792](assets/image-20210714164426792.png)



Nacos一方面可以将配置集中管理，另一方可以在配置变更时，及时通知微服务，实现配置的热更新。



### 1.1.1.在nacos中添加配置文件

如何在nacos中管理配置呢？

![image-20210714164742924](assets/image-20210714164742924.png)

然后在弹出的表单中，填写配置信息：

![image-20210714164856664](assets/image-20210714164856664.png)



> 注意：项目的核心配置，需要热更新的配置才有放到nacos管理的必要。基本不会变更的一些配置还是保存在微服务本地比较好。



### 1.1.2.从微服务拉取配置

微服务要拉取nacos中管理的配置，并且与本地的application.yml配置合并，才能完成项目启动。

但如果尚未读取application.yml，又如何得知nacos地址呢？

因此spring引入了一种新的配置文件：bootstrap.yaml文件，会在application.yml之前被读取，流程如下：

![img](assets/L0iFYNF.png)



1）引入nacos-config依赖

首先，在user-service服务中，引入nacos-config的客户端依赖：

```xml
<!--nacos配置管理依赖-->
<dependency>
    <groupId>com.alibaba.cloud</groupId>
    <artifactId>spring-cloud-starter-alibaba-nacos-config</artifactId>
</dependency>
```

2）添加bootstrap.yaml

然后，在user-service中添加一个bootstrap.yaml文件，内容如下：

```yaml
spring:
  application:
    name: userservice # 服务名称
  profiles:
    active: dev #开发环境，这里是dev 
  cloud:
    nacos:
      server-addr: localhost:8848 # Nacos地址
      config:
        file-extension: yaml # 文件后缀名
```

这里会根据spring.cloud.nacos.server-addr获取nacos地址，再根据

`${spring.application.name}-${spring.profiles.active}.${spring.cloud.nacos.config.file-extension}`作为文件id，来读取配置。

本例中，就是去读取`userservice-dev.yaml`：

![image-20210714170845901](assets/image-20210714170845901.png)



3）读取nacos配置

在user-service中的UserController中添加业务逻辑，读取pattern.dateformat配置：

![image-20210714170337448](assets/image-20210714170337448.png)



完整代码：

```java
package cn.itcast.user.web;

import cn.itcast.user.pojo.User;
import cn.itcast.user.service.UserService;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

@Slf4j
@RestController
@RequestMapping("/user")
public class UserController {

    @Autowired
    private UserService userService;

    @Value("${pattern.dateformat}")
    private String dateformat;
    
    @GetMapping("now")
    public String now(){
        return LocalDateTime.now().format(DateTimeFormatter.ofPattern(dateformat));
    }
    // ...略
}
```



在页面访问，可以看到效果：

![image-20210714170449612](assets/image-20210714170449612.png)



### 总结

![alt text](image-1.png)

- 这种方式只是使用配置中心的功能，还并没有实现配置热更新

## 1.2.配置热更新

我们最终的目的，是修改nacos中的配置后，微服务中无需重启即可让配置生效，也就是**配置热更新**。



要实现配置热更新，可以使用两种方式：

### 1.2.1.方式一

在@Value注入的变量所在类上添加注解@RefreshScope：
1. 类级别的装饰器上使用添加@RefreshScope注解
2. 当配置中心里的配置有更新时，类中所有@Value注入的属性都会自动刷新


![image-20210714171036335](assets/image-20210714171036335.png)



### 1.2.2.方式二

上面的@Value一个一个对应写yaml配置中的属性字段，太麻烦，可用用下面的装饰器声明类，直接接管yaml中的配置对象，直接使用里面的字段属性

使用@ConfigurationProperties注解代替@Value注解。

在user-service服务中，添加一个类，读取patterrn.dateformat属性：

```java
package cn.itcast.user.config;

import lombok.Data;
import org.springframework.boot.context.properties.ConfigurationProperties;
import org.springframework.stereotype.Component;

@Component
@Data
@ConfigurationProperties(prefix = "pattern")
public class PatternProperties {
    private String dateformat;
}

// 后面直接引用这个类，使用里面的字段属性了，并且自动更新

```



在UserController中使用这个类代替@Value：

![image-20210714171316124](assets/image-20210714171316124.png)



完整代码：

```java
package cn.itcast.user.web;

import cn.itcast.user.config.PatternProperties;
import cn.itcast.user.pojo.User;
import cn.itcast.user.service.UserService;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

@Slf4j
@RestController
@RequestMapping("/user")
public class UserController {

    @Autowired
    private UserService userService;

    @Autowired
    private PatternProperties patternProperties;

    @GetMapping("now")
    public String now(){
        return LocalDateTime.now().format(DateTimeFormatter.ofPattern(patternProperties.getDateformat()));
    }

    // 略
}
```

### 总结

![alt text](image-2.png)

## 1.3.配置共享

其实微服务启动时，会去nacos读取多个配置文件，例如：

- `[spring.application.name]-[spring.profiles.active].yaml`，例如：userservice-dev.yaml

- `[spring.application.name].yaml`，例如：userservice.yaml

而`[spring.application.name].yaml`不包含环境，因此可以被多个环境共享。

![alt text](image-3.png)

下面我们通过案例来测试配置共享



### 1）添加一个环境共享配置

我们在nacos中添加一个userservice.yaml文件：

![image-20210714173233650](assets/image-20210714173233650.png)



### 2）在user-service中读取共享配置

在user-service服务中，修改PatternProperties类，读取新添加的属性：

![image-20210714173324231](assets/image-20210714173324231.png)

在user-service服务中，修改UserController，添加一个方法：

![image-20210714173721309](assets/image-20210714173721309.png)



### 3）运行两个UserApplication，使用不同的profile

修改UserApplication2这个启动项，改变其profile值：

![image-20210714173538538](assets/image-20210714173538538.png)



![image-20210714173519963](assets/image-20210714173519963.png)



这样，UserApplication(8081)使用的profile是dev，UserApplication2(8082)使用的profile是test。

启动UserApplication和UserApplication2

访问http://localhost:8081/user/prop，结果：

![image-20210714174313344](assets/image-20210714174313344.png)

访问http://localhost:8082/user/prop，结果：

![image-20210714174424818](assets/image-20210714174424818.png)

可以看出来，不管是dev，还是test环境，都读取到了envSharedValue这个属性的值。



### 4）配置共享的优先级

当nacos、服务本地同时出现相同属性时，优先级有高低之分：

![image-20210714174623557](assets/image-20210714174623557.png)


#### 共享配置和扩展配置
1. 共享配置：多个应用或多个环境共享的配置，通过 spring.cloud.nacos.config.shared-configs
2. 扩展配置：或 spring.cloud.nacos.config.extension-configs 配置（如 common.yml 被多个服务共享）。
3. extension-configs 优先级高于 shared-configs（即 extension-configs 会覆盖 shared-configs 中的同名配置）。


实际使用中通常选一种即可，推荐 extension-configs（支持更细粒度的优先级控制）
```YAML
spring:
  cloud:
    nacos:
      config:
        shared-configs:
          - data-id: common.yml    # 共享配置1
            refresh: true
          - data-id: db.yml        # 共享配置2（会覆盖 common.yml 中的同名配置）
            refresh: true
        extension-configs:
          - data-id: common1.yml    # 扩展配置1 (扩展配置增量覆盖共享配置)
            refresh: true

```
#### 总优先级

Nacos 配置加载的核心顺序（优先级从低到高，后面的覆盖前面的）：

默认配置（application.yml） → (共享配置  → 扩展配置)（按配置顺序加载） → 环境配置（application-{profile}.yml）

## 1.4.搭建Nacos集群

Nacos生产环境下一定要部署为集群状态，部署方式参考课前资料中的文档：

![image-20210714174728042](assets/image-20210714174728042.png)

## 环境隔离访问

一、隔离与访问的核心结论

1. 默认行为：
   1. 配置被 “命名空间 + 分组” 双重隔离，应用仅能访问自身配置中指定的命名空间和分组下的配置（默认是 public 命名空间 + DEFAULT_GROUP）。
2. 跨命名空间 / 分组访问的条件：
   1. 必须在应用配置中显式指定目标命名空间的 ID（非名称）和目标分组的 名称，否则无法访问。
3. 实际应用场景：
   1. 隔离场景：生产 / 测试环境用不同命名空间隔离，同一环境的不同业务线用分组隔离（如 PAY_GROUP、ORDER_GROUP）。
   2. 跨访问场景：公共配置（如数据库连接池参数）放在共享命名空间，业务应用通过显式配置跨命名空间加载。


# 2.Feign远程调用



先来看我们以前利用RestTemplate发起远程调用的代码：

![image-20210714174814204](assets/image-20210714174814204.png)

存在下面的问题：

•代码可读性差，编程体验不统一

•参数复杂URL难以维护



Feign是一个声明式的http客户端，官方地址：https://github.com/OpenFeign/feign

其作用就是帮助我们优雅的实现http请求的发送，解决上面提到的问题。

![image-20210714174918088](assets/image-20210714174918088.png)



## 2.1.Feign替代RestTemplate

Fegin的使用步骤如下：

### 1）引入依赖

我们在order-service服务的pom文件中引入feign的依赖：

```xml
<dependency>
    <groupId>org.springframework.cloud</groupId>
    <artifactId>spring-cloud-starter-openfeign</artifactId>
</dependency>
```



### 2）添加注解

在order-service的启动类添加注解开启Feign的功能：
1. @EnableFeignClients 的作用：向 Spring 容器注册一个 FeignClientScanner（Feign 客户端扫描器），告诉 Spring：“启动时需要扫描所有带 @FeignClient 的接口”。
2. 如果不添加 @EnableFeignClients，即使接口上有 @FeignClient，Spring 也不会处理 —— 这进一步说明扫描不是 Java 默认行为，而是需要显式开启的框架功能
3. 筛选目标接口：只保留带有 @FeignClient 注解的接口；
4. 生成代理类定义：对筛选出的接口（如 UserClient），Spring 会创建一个 “BeanDefinition”（Bean 的定义信息），并指定该 Bean 的类型是 “通过 JDK 动态代理生成的代理类”；
5. 注入容器：最后，Spring 会根据这个 BeanDefinition，在容器中创建代理类的实例 —— 这就是控制器能通过 @Autowired UserClient 注入并调用的原因

![image-20210714175102524](assets/image-20210714175102524.png)



### 3）编写Feign的客户端

在order-service中新建一个接口，内容如下：

```java
package cn.itcast.order.client;

import cn.itcast.order.pojo.User;
import org.springframework.cloud.openfeign.FeignClient;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
// 这里运行时会根据这个接口的类型方法，自动生成一个http调用的UserClient代理类，内部用了reflcet和proxy指定以UserCLient接口方式实现的拦截代理，对所有接口方法进行拦截处理，自定义http请求逻辑和降级参数的逻辑

// 通过类对象提供的反射方法获取接口中所有的方法名

@FeignClient("userservice") // 在这告诉要调用的是哪个微服务地址
public interface UserClient {
    @GetMapping("/user/{id}")
    User findById(@PathVariable("id") Long id);
}
```



这个客户端主要是基于SpringMVC的注解来声明远程调用的信息，比如：

- 服务名称：userservice
- 请求方式：GET
- 请求路径：/user/{id}
- 请求参数：Long id
- 返回值类型：User

这样，Feign就可以帮助我们发送http请求，无需自己使用RestTemplate来发送了。





### 4）测试

修改order-service中的OrderService类中的queryOrderById方法，使用Feign客户端代替RestTemplate：

![image-20210714175415087](assets/image-20210714175415087.png)

是不是看起来优雅多了。





### 5）总结

使用Feign的步骤：

① 引入依赖

② 添加@EnableFeignClients注解

③ 编写FeignClient接口

④ 使用FeignClient中定义的方法代替RestTemplate



## 2.2.自定义配置

Feign可以支持很多的自定义配置，如下表所示：

| 类型                     | 作用       | 说明                                |
| ---------------------- | -------- | --------------------------------- |
| **feign.Logger.Level** | 修改日志级别   | 包含四种不同的级别：NONE、BASIC、HEADERS、FULL |
| feign.codec.Decoder    | 响应结果的解析器 | http远程调用的结果做解析，例如解析json字符串为java对象 |
| feign.codec.Encoder    | 请求参数编码   | 将请求参数编码，便于通过http请求发送              |
| feign. Contract        | 支持的注解格式  | 默认是SpringMVC的注解                   |
| feign. Retryer         | 失败重试机制   | 请求失败的重试机制，默认是没有，不过会使用Ribbon的重试    |

一般情况下，默认值就能满足我们使用，如果要自定义时，只需要创建自定义的@Bean覆盖默认Bean即可。



下面以日志为例来演示如何自定义配置。

### 2.2.1.配置文件方式

基于配置文件修改feign的日志级别可以针对单个服务：

```yaml
feign:  
  client:
    config: 
      userservice: # 针对某个微服务的配置
        loggerLevel: FULL #  日志级别 
```

也可以针对所有服务：

```yaml
feign:  
  client:
    config: 
      default: # 这里用default就是全局配置，如果是写服务名称，则是针对某个微服务的配置
        loggerLevel: FULL #  日志级别 
```



而日志的级别分为四种：

- NONE：不记录任何日志信息，这是默认值。
- BASIC：仅记录请求的方法，URL以及响应状态码和执行时间
- HEADERS：在BASIC的基础上，额外记录了请求和响应的头信息
- FULL：记录所有请求和响应的明细，包括头信息、请求体、元数据。


### 2.2.2.Java代码方式

也可以基于Java代码来修改日志级别，先声明一个类，然后声明一个Logger.Level的对象：

```java
public class DefaultFeignConfiguration  {
    @Bean
    public Logger.Level feignLogLevel(){
        return Logger.Level.BASIC; // 日志级别为BASIC
    }
}
```



如果要**全局生效**，将其放到启动类的@EnableFeignClients这个注解中：

```java
@EnableFeignClients(defaultConfiguration = DefaultFeignConfiguration .class) 
```



如果是**局部生效**，则把它放到对应的@FeignClient这个注解中：

```java
@FeignClient(value = "userservice", configuration = DefaultFeignConfiguration .class) 
```







## 2.3.Feign使用优化

Feign底层发起http请求，依赖于其它的框架。其底层客户端实现包括：

•URLConnection：默认实现，不支持连接池

•Apache HttpClient ：支持连接池

•OKHttp：支持连接池



因此提高Feign的性能主要手段就是使用**连接池**代替默认的URLConnection。



这里我们用Apache的HttpClient来演示。

1）引入依赖

在order-service的pom文件中引入Apache的HttpClient依赖：

```xml
<!--httpClient的依赖 -->
<dependency>
    <groupId>io.github.openfeign</groupId>
    <artifactId>feign-httpclient</artifactId>
</dependency>
```



2）配置连接池

在order-service的application.yml中添加配置：

```yaml
feign:
  client:
    config:
      default: # default全局的配置
        loggerLevel: BASIC # 日志级别，BASIC就是基本的请求和响应信息
  httpclient:
    enabled: true # 开启feign对HttpClient的支持
    max-connections: 200 # 最大的连接数
    max-connections-per-route: 50 # 每个路径的最大连接数
```



接下来，在FeignClientFactoryBean中的loadBalance方法中打断点：

![image-20210714185925910](assets/image-20210714185925910.png)

Debug方式启动order-service服务，可以看到这里的client，底层就是Apache HttpClient：

![image-20210714190041542](assets/image-20210714190041542.png)





总结，Feign的优化：

1. 日志级别尽量用basic

2.使用HttpClient或OKHttp代替URLConnection

①  引入feign-httpClient依赖

②  配置文件开启httpClient功能，设置连接池参数

### http请求优化手段积累

问题：HTTP 协议基于 TCP 传输，每次发送 HTTP 请求的完整流程是：
建立 TCP 连接（三次握手）→ 发送 HTTP 请求 → 接收响应 → 关闭 TCP 连接（四次挥手）
如果每次请求都重复这个流程，会存在两大问题
1. 性能损耗：TCP 三次握手（约 1-3 个 RTT 时间）和四次挥手会占用额外时间，尤其在高频请求场景（如微服务间调用、爬虫）中，累计耗时会显著增加接口响应时间。
2. 资源浪费：频繁创建 / 关闭连接会消耗服务器的 CPU、内存资源（每个连接需占用文件描述符等系统资源），高并发下可能导致 “Too many open files” 等错误。

---- 而连接池通过复用已建立的 TCP 连接，省去了 “建立 / 关闭连接” 的步骤，直接发送 HTTP 请求，大幅提升效率

#### 原理
1. 连接池初始化：启动时创建一定数量的 TCP 连接（如 10 个），并将这些连接缓存到 “空闲连接队列” 中，连接处于 “建立但未使用” 状态
2. 请求复用连接：当需要发送 HTTP 请求时，从连接池的 “空闲队列” 中取出一个可用连接，直接用它发送请求，无需重新握手
3. 链接归还：请求完成后，不关闭连接，而是将其放回 “空闲队列”，等待下次复用（前提是连接未超时、未被服务器关闭）
4. 动态扩缩容：若请求量激增，空闲连接不足，连接池会临时创建新连接（不超过最大限制）；若空闲连接过多（超过最小限制），会自动关闭部分连接，释放资源。

#### 框架

1. 服务端：nodejs中的http模块自动封装此功能，可用配链接数等配置
2. 现代浏览器：会自动为 HTTP/HTTPS 请求维护连接池，无需开发者手动配置 —— 这是浏览器内置的优化机制，核心目的是复用 TCP 连接、减少 “三次握手” 的开销，提升网页加载性能
   1. 浏览器会限制对同一域名的最大并发连接数（避免压垮服务器），通常 HTTP/1.1 下是 6-8 个（不同浏览器可能不同，如 Chrome 早期是 6 个，现在部分场景放宽），HTTP/2 则支持 “多路复用”（理论上无此限制）

## 2.4.最佳实践

所谓最近实践，就是使用过程中总结的经验，最好的一种使用方式。

仔细观察可以发现，Feign的客户端与服务提供者的controller代码非常相似：

feign客户端：

![image-20210714190542730](assets/image-20210714190542730.png)

UserController：

![image-20210714190528450](assets/image-20210714190528450.png)



有没有一种办法简化这种重复的代码编写呢？





### 2.4.1.继承方式

一样的代码可以通过继承来共享：

1）定义一个API接口，利用定义方法，并基于SpringMVC注解做声明。

2）Feign客户端和Controller都集成改接口



![image-20210714190640857](assets/image-20210714190640857.png)



优点：

- 简单
- 实现了代码共享

缺点：

- 服务提供方、服务消费方紧耦合

- 参数列表中的注解映射并不会继承，因此Controller中必须再次声明方法、参数列表、注解





### 2.4.2.抽取方式

将Feign的Client抽取为独立模块，并且把接口有关的POJO、默认的Feign配置都放到这个模块中，提供给所有消费者使用。

例如，将UserClient、User、Feign的默认配置都抽取到一个feign-api包中，所有微服务引用该依赖包，即可直接使用。

![image-20210714214041796](assets/image-20210714214041796.png)





### 2.4.3.实现基于抽取的最佳实践

#### 1）抽取

首先创建一个module，命名为feign-api：

![image-20210714204557771](assets/image-20210714204557771.png)

项目结构：

![image-20210714204656214](assets/image-20210714204656214.png)

在feign-api中然后引入feign的starter依赖

```xml
<dependency>
    <groupId>org.springframework.cloud</groupId>
    <artifactId>spring-cloud-starter-openfeign</artifactId>
</dependency>
```



然后，order-service中编写的UserClient、User、DefaultFeignConfiguration都复制到feign-api项目中

![image-20210714205221970](assets/image-20210714205221970.png)



#### 2）在order-service中使用feign-api

首先，删除order-service中的UserClient、User、DefaultFeignConfiguration等类或接口。



在order-service的pom文件中中引入feign-api的依赖：

```xml
<dependency>
    <groupId>cn.itcast.demo</groupId>
    <artifactId>feign-api</artifactId>
    <version>1.0</version>
</dependency>
```



修改order-service中的所有与上述三个组件有关的导包部分，改成导入feign-api中的包



#### 3）重启测试

重启后，发现服务报错了：

![image-20210714205623048](assets/image-20210714205623048.png)



这是因为UserClient现在在cn.itcast.feign.clients包下，

而order-service的@EnableFeignClients注解是在cn.itcast.order包下，不在同一个包，无法扫描到UserClient。



#### 4）解决扫描包问题

方式一：

指定Feign应该扫描的包：

```java
@EnableFeignClients(basePackages = "cn.itcast.feign.clients")
```



方式二：

指定需要加载的Client接口：

```java
@EnableFeignClients(clients = {UserClient.class})
```



# 3.Gateway服务网关

Spring Cloud Gateway 是 Spring Cloud 的一个全新项目，该项目是基于 Spring 5.0，Spring Boot 2.0 和 Project Reactor 等响应式编程和事件流技术开发的网关，它旨在为微服务架构提供一种简单有效的统一的 API 路由管理方式。



## 3.1.为什么需要网关

Gateway网关是我们服务的守门神，所有微服务的统一入口。

网关的**核心功能特性**：

- 请求路由
  - 服务路由，负载均衡
- 权限控制
  - 身份认证和权限校验
- 限流等等

架构图：

![image-20210714210131152](assets/image-20210714210131152.png)



**权限控制**：网关作为微服务入口，需要校验用户是是否有请求资格，如果没有则进行拦截。

**路由和负载均衡**：一切请求都必须先经过gateway，但网关不处理业务，而是根据某种规则，把请求转发到某个微服务，这个过程叫做路由。当然路由的目标服务有多个时，还需要做负载均衡。

**限流**：当请求流量过高时，在网关中按照下流的微服务能够接受的速度来放行请求，避免服务压力过大。



在SpringCloud中网关的实现包括两种：

- 第二代：gateway（目前推荐）
- 第一代：zuul

Zuul是基于Servlet的实现，属于阻塞式编程。而SpringCloudGateway则是基于Spring5中提供的WebFlux，属于异步编程的实现，具备更好的性能。


## 3.2.gateway快速入门

下面，我们就演示下网关的基本路由功能。基本步骤如下：

1. 创建SpringBoot工程gateway，引入网关依赖
2. 编写启动类
3. 编写基础配置和路由规则
4. 启动网关服务进行测试



### 1）创建gateway服务，引入依赖

创建服务：

![image-20210714210919458](assets/image-20210714210919458.png)

引入依赖：
1. 需要gateway依赖
2. 引入nacos服务发现依赖
   1. 它作为个网关，要导航到哪个微服务集群中，也需要通过nacos注册中心获取所有集群所有微服务列表
   2. 所以它自己也需要加入到nacos管理中


```xml
<!--网关-->
<dependency>
    <groupId>org.springframework.cloud</groupId>
    <artifactId>spring-cloud-starter-gateway</artifactId>
</dependency>
<!--nacos服务发现依赖-->
<dependency>
    <groupId>com.alibaba.cloud</groupId>
    <artifactId>spring-cloud-starter-alibaba-nacos-discovery</artifactId>
</dependency>
```



### 2）编写启动类

```java
package cn.itcast.gateway;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class GatewayApplication {

	public static void main(String[] args) {
		SpringApplication.run(GatewayApplication.class, args);
	}
}
```



### 3）编写基础配置和路由规则

创建application.yml文件，内容如下：

```yaml
server:
  port: 10010 # 网关端口
spring:
  application:
    name: gateway # 服务名称
  cloud:
    nacos:
      server-addr: localhost:8848 # nacos地址
    gateway:
      routes: # 网关路由配置
        - id: user-service # 路由id，自定义，只要唯一即可（不一定与微服务名字一样，只是个路由信息标识）
          # uri: http://127.0.0.1:8081 # 路由的目标地址 http就是固定地址
          uri: lb://userservice # 路由的目标地址 lb就是负载均衡，后面跟服务名称
          predicates: # 路由断言，也就是判断请求是否符合路由规则的条件
            - Path=/user/** # 这个是按照路径匹配，只要以/user/开头就符合要求
```



流程链路：我们将符合`Path` 规则的一切请求，都代理到 `uri`参数指定的地址。

本例中，我们将 `/user/**`开头的请求，代理到`lb://userservice`，lb是负载均衡，根据服务名拉取服务列表，实现负载均衡。



### 4）重启测试

重启网关，访问http://localhost:10010/user/1时，符合`/user/**`规则，请求转发到uri：http://userservice/user/1，得到了结果：

![image-20210714211908341](assets/image-20210714211908341.png)





### 5）网关路由的流程图

整个访问的流程如下：

![image-20210714211742956](assets/image-20210714211742956.png)







总结：

网关搭建步骤：

1. 创建项目，引入nacos服务发现和gateway依赖

2. 配置application.yml，包括服务基本信息、nacos地址、路由

路由配置包括：

1. 路由id：路由的唯一标示

2. 路由目标（uri）：路由的目标地址，http代表固定地址，lb代表根据服务名负载均衡

3. 路由断言（predicates）：判断路由的规则，

4. 路由过滤器（filters）：对请求或响应做处理



接下来，就重点来学习路由断言和路由过滤器的详细知识





## 3.3.断言工厂

我们在配置文件中写的断言规则只是字符串，这些字符串会被Predicate Factory读取并处理，转变为路由判断的条件

例如Path=/user/**是按照路径匹配，这个规则是由

`org.springframework.cloud.gateway.handler.predicate.PathRoutePredicateFactory`类来

处理的，像这样的断言工厂在SpringCloudGateway还有十几个:

| **名称**     | **说明**            | **示例**                                   |
| ---------- | ----------------- | ---------------------------------------- |
| After      | 是某个时间点后的请求        | -  After=2037-01-20T17:42:47.789-07:00[America/Denver] |
| Before     | 是某个时间点之前的请求       | -  Before=2031-04-13T15:14:47.433+08:00[Asia/Shanghai] |
| Between    | 是某两个时间点之前的请求      | -  Between=2037-01-20T17:42:47.789-07:00[America/Denver],  2037-01-21T17:42:47.789-07:00[America/Denver] |
| Cookie     | 请求必须包含某些cookie    | - Cookie=chocolate, ch.p                 |
| Header     | 请求必须包含某些header    | - Header=X-Request-Id, \d+               |
| Host       | 请求必须是访问某个host（域名） | -  Host=**.somehost.org,**.anotherhost.org |
| Method     | 请求方式必须是指定方式       | - Method=GET,POST                        |
| Path       | 请求路径必须符合指定规则      | - Path=/red/{segment},/blue/**           |
| Query      | 请求参数必须包含指定参数      | - Query=name, Jack或者-  Query=name        |
| RemoteAddr | 请求者的ip必须是指定范围     | - RemoteAddr=192.168.1.1/24              |
| Weight     | 权重处理              |                                          |



我们只需要掌握Path这种路由工程就可以了。



## 3.4.过滤器工厂

GatewayFilter是网关中提供的一种过滤器，可以对进入网关的请求和微服务返回的响应做处理：

![image-20210714212312871](assets/image-20210714212312871.png)



### 3.4.1.路由过滤器的种类

Spring提供了31种不同的路由过滤器工厂。例如：

| **名称**               | **说明**         |
| -------------------- | -------------- |
| AddRequestHeader     | 给当前请求添加一个请求头   |
| RemoveRequestHeader  | 移除请求中的一个请求头    |
| AddResponseHeader    | 给响应结果中添加一个响应头  |
| RemoveResponseHeader | 从响应结果中移除有一个响应头 |
| RequestRateLimiter   | 限制请求的流量        |



### 3.4.2.请求头过滤器

下面我们以AddRequestHeader 为例来讲解。

> **需求**：给所有进入userservice的请求添加一个请求头：Truth=itcast is freaking awesome!



只需要修改gateway服务的application.yml文件，添加路由过滤即可：

```yaml
spring:
  cloud:
    gateway:
      routes:
      - id: user-service 
        uri: lb://userservice 
        predicates: 
        - Path=/user/** 
        filters: # 过滤器
        - AddRequestHeader=Truth, Itcast is freaking awesome! # 添加请求头 格式key,value
```

当前过滤器写在userservice路由下，因此仅仅对访问userservice的请求有效。

可以在userController方法中 **注入请求头信息**，进行测试

```java
@GetMapping("/{id}")
    public User queryById(@PathVariable("id") Long id,
                          @RequestHeader(value = "Truth",required = false) String name) {
        System.out.println("请求头中携带的name = " + name);
        return userService.queryById(id);
    }
```





### 3.4.3.默认过滤器

如果要对所有的路由都生效，则可以将过滤器工厂写到default下。格式如下：

```yaml
spring:
  cloud:
    gateway:
      routes:
      - id: user-service 
        uri: lb://userservice 
        predicates: 
        - Path=/user/**
      default-filters: # 默认过滤项
      - AddRequestHeader=Truth, Itcast is freaking awesome! 
```



### 3.4.4.总结

过滤器的作用是什么？

① 对路由的请求或响应做加工处理，比如添加请求头

② 配置在路由下的过滤器只对当前路由的请求生效

defaultFilters的作用是什么？

① 对所有路由都生效的过滤器



## 3.5.全局过滤器

上一节学习的过滤器，网关提供了31种，但每一种过滤器的作用都是固定的。如果我们希望拦截请求，做自己的业务逻辑则没办法实现。

### 3.5.1.全局过滤器作用

全局过滤器的作用也是处理一切进入网关的请求和微服务响应，与GatewayFilter的作用一样。区别在于GatewayFilter通过配置定义，处理逻辑是固定的；而GlobalFilter的逻辑需要自己写代码实现。

定义方式是实现GlobalFilter接口。

```java
public interface GlobalFilter {
    /**
     *  处理当前请求，有必要的话通过{@link GatewayFilterChain}将请求交给下一个过滤器处理
     *
     * @param exchange 请求上下文，里面可以获取Request、Response等信息
     * @param chain 用来把请求委托给下一个过滤器 
     * @return {@code Mono<Void>} 返回标示当前过滤器业务结束
     */
    Mono<Void> filter(ServerWebExchange exchange, GatewayFilterChain chain);
}
```



在filter中编写自定义逻辑，可以实现下列功能：

- 登录状态判断
- 权限校验
- 请求限流等





### 3.5.2.自定义全局过滤器

需求：定义全局过滤器，拦截请求，判断请求的参数是否满足下面条件：

- 参数中是否有authorization，

- authorization参数值是否为admin

如果同时满足则放行，否则拦截



实现：

在gateway中定义一个过滤器：

```java
package cn.itcast.gateway.filter;
import org.springframework.cloud.gateway.filter.GatewayFilterChain;
import org.springframework.cloud.gateway.filter.GlobalFilter;
import org.springframework.core.annotation.Order;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Component;
import org.springframework.util.MultiValueMap;
import org.springframework.web.server.ServerWebExchange;
import reactor.core.publisher.Mono;
@Order(-1)
@Component
public class AuthorizeFilter implements GlobalFilter {
    @Override
    public Mono<Void> filter(ServerWebExchange exchange, GatewayFilterChain chain) {
        // 1.获取请求参数
        MultiValueMap<String, String> params = exchange.getRequest().getQueryParams();
        // 2.获取authorization参数
        String auth = params.getFirst("authorization");
        // 3.校验
        if ("admin".equals(auth)) {
            // 放行
            return chain.filter(exchange);
        }
        // 4.拦截
        // 4.1.禁止访问，设置状态码
        exchange.getResponse().setStatusCode(HttpStatus.UNAUTHORIZED);
        // 4.2.结束处理
        return exchange.getResponse().setComplete();
    }
}
```





### 3.5.3.过滤器执行顺序

请求进入网关会碰到三类过滤器：当前路由的过滤器、DefaultFilter、GlobalFilter

请求路由后，会将当前路由过滤器和DefaultFilter、GlobalFilter，合并到一个过滤器链（集合）中，排序后依次执行每个过滤器：

![image-20210714214228409](assets/image-20210714214228409.png)



排序的规则是什么呢？

- 每一个过滤器都必须指定一个int类型的order值，**order值越小，优先级越高，执行顺序越靠前**。
- GlobalFilter通过实现Ordered接口，或者添加@Order注解来指定order值，由我们自己指定
- 路由过滤器和defaultFilter的order由Spring指定，默认是按照声明顺序从1递增。
- 当过滤器的order值一样时，会按照 defaultFilter > 路由过滤器 > GlobalFilter的顺序执行。

![image-20211028222348950](assets/image-20211028222348950.png)

详细内容，可以查看源码：

`org.springframework.cloud.gateway.route.RouteDefinitionRouteLocator#getFilters()`方法是先加载defaultFilters，然后再加载某个route的filters，然后合并。

`org.springframework.cloud.gateway.handler.FilteringWebHandler#handle()`方法会加载全局过滤器，与前面的过滤器合并后根据order排序，组织过滤器链

```java
package com.itheima.sh.gateway.filters;

import lombok.extern.slf4j.Slf4j;
import org.springframework.cloud.gateway.filter.GlobalFilter;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.core.annotation.Order;
import reactor.core.publisher.Mono;

@Slf4j
@Configuration
public class FilterConfiguration {

    @Bean
    @Order(-2)
    public GlobalFilter globalFilter1(){
        return ((exchange, chain) -> {
            log.info("过滤器1的pre阶段！");
              return chain.filter(exchange).then(Mono.fromRunnable(() -> {
                log.info("过滤器1的post阶段！");
            }));
        });
    }

    @Bean
    @Order(-1)
    public GlobalFilter globalFilter2(){
        return ((exchange, chain) -> {
            log.info("过滤器2的pre阶段！");
            return chain.filter(exchange).then(Mono.fromRunnable(() -> {
                log.info("过滤器2的post阶段！");
            }));
        });
    }

    @Bean
    @Order(0)
    public GlobalFilter globalFilter3(){
        return ((exchange, chain) -> {
            log.info("过滤器3的pre阶段！");
            return chain.filter(exchange).then(Mono.fromRunnable(() -> {
                log.info("过滤器3的post阶段！");
            }));
        });
    }
}

```
![alt text](image-4.png)


## 3.6.跨域问题

### 3.6.1.什么是跨域问题

跨域：域名不一致就是跨域，主要包括：

- 域名不同： www.taobao.com 和 www.taobao.org 和 www.jd.com 和 miaosha.jd.com

- 域名相同，端口不同：localhost:8080和localhost8081

跨域问题：浏览器禁止请求的发起者与服务端发生跨域ajax请求，请求被浏览器拦截的问题

解决方案：CORS，这个以前应该学习过，这里不再赘述了。不知道的小伙伴可以查看https://www.ruanyifeng.com/blog/2016/04/cors.html

### 3.6.2.模拟跨域问题

找到课前资料的页面文件：

![image-20210714215713563](assets/image-20210714215713563.png)

放入tomcat或者nginx这样的web服务器中，启动并访问。

可以在浏览器控制台看到下面的错误：

![image-20210714215832675](assets/image-20210714215832675.png)

从localhost:8090访问localhost:10010，端口不同，显然是跨域的请求。

### 3.6.3.解决跨域问题

在gateway服务的application.yml文件中，添加下面的配置：

```yaml
spring:
  cloud:
    gateway:
      # 。。。
      globalcors: # 全局的跨域处理
        add-to-simple-url-handler-mapping: true # 解决options请求被拦截问题
        corsConfigurations:
          '[/**]':
            allowedOrigins: # 允许哪些网站的跨域请求 
              - "http://localhost:8090"
              - "http://localhost"  //80端口要省略不写
              - "http://127.0.0.1"
              - "http://www.itheima.com"
            allowedMethods: # 允许的跨域ajax的请求方式
              - "GET"
              - "POST"
              - "DELETE"
              - "PUT"
              - "OPTIONS"
            allowedHeaders: "*" # 允许在请求中携带的头信息
            allowCredentials: true # 是否允许携带cookie
            maxAge: 360000 # 这次跨域检测的有效期-避免频繁发起跨域检测,服务端返回Access-Control-Max-Age来声明的有效期
```

> 注意：若通过localhost访问nginx，则需要配置localhost允许跨域，对于127.0.0.1则不会生效，需要单独配置。

## 3.7 网关限流(了解)

网关除了请求路由、身份验证，还有一个非常重要的作用：请求限流。当系统面对高并发请求时，为了减少对业务处理服务的压力，需要在网关中对请求限流，按照一定的速率放行请求。

![image-20211028223603290](assets/image-20211028223603290.png)

常见的限流算法包括：

- 计数器算法
- 漏桶算法
- 令牌桶算法

算法介绍: 

https://blog.csdn.net/u012441595/article/details/102483501

### 3.7.1 令牌桶算法原理

SpringGateway中采用的是令牌桶算法，令牌桶算法原理：

- 准备一个令牌桶，有固定容量，一般为服务并发上限
- 按照固定速率，生成令牌并存入令牌桶，如果桶中令牌数达到上限，就丢弃令牌。
- 每次请求调用需要先获取令牌，只有拿到令牌，才继续执行，否则选择选择等待或者直接拒绝。

![image-20211028223627485](assets/image-20211028223627485.png)

### 3.7.2 Gateway中限流实现

SpringCloudGateway是采用令牌桶算法，其令牌相关信息记录在redis中，因此我们需要安装redis，并引入Redis相关依赖。

**1) 引入redis有关依赖：**

```xml
<!--redis-->
<dependency>
    <groupId>org.springframework.boot</groupId>
    <artifactId>spring-boot-starter-data-redis-reactive</artifactId>
</dependency>
```

注意：这里不是普通的redis依赖，而是响应式的Redis依赖，因为SpringGateway是基于WebFlux的响应式

**2) 配置过滤条件key：**

Gateway会在Redis中记录令牌相关信息，我们可以自己定义令牌桶的规则，例如：

- 给不同的请求URI路径设置不同令牌桶

- 给不同的登录用户设置不同令牌桶



- 给不同的请求IP地址设置不同令牌桶

Redis中的一个Key和Value对就是一个令牌桶。因此Key的生成规则就是桶的定义规则。SpringCloudGateway中key的生成规则定义在`KeyResolver`接口中：

```java
public interface KeyResolver {

	Mono<String> resolve(ServerWebExchange exchange);

}
```

这个接口中的方法返回值就是给令牌桶生成的key。API说明：

- Mono：是一个单元素容器，用来存放令牌桶的key
- ServerWebExchange：上下文对象，可以理解为ServletContext，可以从中获取request、response、cookie等信息

比如上面的三种令牌桶规则，生成key的方式如下：

- 给不同的请求URI路径设置不同令牌桶，示例代码：

  ```java
  return Mono.just(exchange.getRequest().getURI().getPath());// 获取请求URI
  ```

- 给不同的登录用户设置不同令牌桶

  ```java
  return exchange.getPrincipal().map(Principal::getName);// 获取用户
  ```

- 给不同的请求IP地址设置不同令牌桶

  ```java
  return Mono.just(exchange.getRequest().getRemoteAddress().getHostName());// 获取请求者IP
  ```

这里我们选择最后一种，使用IP地址的令牌桶key。

我们在` com.itheima.sh.ratelimit`中定义一个类，配置一个KeyResolver的Bean实例：

```java
package cn.itcast.gateway.ratelimit;
import org.springframework.cloud.gateway.filter.ratelimit.KeyResolver;
import org.springframework.stereotype.Component;
import org.springframework.web.server.ServerWebExchange;
import reactor.core.publisher.Mono;
@Component
public class PathKeyResolver implements KeyResolver {
    @Override
    public Mono<String> resolve(ServerWebExchange exchange) {
        return Mono.just(exchange.getRequest().getURI().getPath());// 获取请求URI
    }
}
```

**3) 配置桶参数：**

另外，令牌桶的参数需要通过yaml文件来配置，**参数有2个**：

- `replenishRate`：每秒钟生成令牌的速率，基本上就是每秒钟允许的最大请求数量

- `burstCapacity`：令牌桶的容量，就是令牌桶中存放的最大的令牌的数量

完整配置如下：

```yaml
server:
  port: 10010 # 网关端口
spring:
  application:
    name: gateway # 服务名称
  redis:
    host: localhost
  cloud:
    nacos:
      server-addr: localhost:8848 # nacos地址
    gateway:
      routes: # 网关路由配置
        - id: user-service # 路由id，自定义，只要唯一即可
          # uri: http://127.0.0.1:8081 # 路由的目标地址 http就是固定地址
          uri: lb://userservice # 路由的目标地址 lb就是负载均衡，后面跟服务名称
          predicates: # 路由断言，也就是判断请求是否符合路由规则的条件
            - Path=/user/**
        - id: order-service # 路由id，自定义，只要唯一即可
          uri: lb://orderservice # 路由的目标地址 lb就是负载均衡，后面跟服务名称
          predicates: # 路由断言，也就是判断请求是否符合路由规则的条件
            - Path=/order/**
      default-filters:
        - AddRequestHeader=name,xiaoming
        - name: RequestRateLimiter #请求数限流 名字不能随便写
          args:
            key-resolver: "#{@ipKeyResolver}" # 指定一个key生成器
            redis-rate-limiter.replenishRate: 2 # 生成令牌的速率
            redis-rate-limiter.burstCapacity: 4 # 桶的容量
      globalcors: # 全局的跨域处理
        ........
```

这里配置了一个过滤器：RequestRateLimiter，并设置了三个参数：

- `key-resolver`：`"#{@ipKeyResolver}"`是SpEL表达式，写法是`#{@bean的名称}`，ipKeyResolver就是我们定义的Bean名称
- `redis-rate-limiter.replenishRate`：每秒钟生成令牌的速率
- `redis-rate-limiter.burstCapacity`：令牌桶的容量

这样的限流配置可以达成的效果：

- 每一个IP地址，每秒钟最多发起2次请求
- 每秒钟超过2次请求，则返回429的异常状态码

**4）测试：**

我们快速在浏览器多次访问http://localhost:10010/user/1，就会得到一个错误：

![image-20211028223732800](assets/image-20211028223732800.png)

429：代表请求次数过多，触发限流了。



