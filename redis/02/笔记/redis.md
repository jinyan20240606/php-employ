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

del key

# 列表 list

lpush  rpop

rpush lpop

rpoplpush

llen

lrange key start end

# hash

hset

hmset

hget key fileld

hmget key f1 f2 f3

hgetall key

hlen

hexists

hdel

hincrby

# 无序集合 set

sadd 

smembers

scards

sismember

smove  sset  dset value

srem

spop

sinter 交集

sunion 并集

sdiff set1 set2  差集

# 有序集合 zset

zadd key score value

zrange key start end

zrevrange

zrem

zcard

zincrby 分值添加

zremrangebyscore  分值区间来删除

zcount 分值区间总数

zscore 元素分值

