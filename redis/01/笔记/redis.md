# 字符串

set key value [ex/px nx/xx]

get key

mset key value key value

mget key1 key2 key3

ttl key

expire key time

incrby key step

append key value

getset key newValue

# 列表 list

lpush  rpop

rpush lpop

rpoplpush oldlist newlist item

llen

lrange key start end   索引

# hash

hset

hmset

hget

hmget

hgetall

hlen

hexists

hdel

hincrby  浏览量

# 无序集合 set

sadd 

smembers

scards

sismember

smove

srem

spop

sinter

sunion

sdiff set1 set2

# 有序集合 zset

zadd key score value

zrange key start end  索引 升序

zrevrange 降序

zrem

zcards

zincrby  给分值添加数值

zremrangebyscore  分值区间来删除

zcount 分值区间总数

zscore 元素分值

