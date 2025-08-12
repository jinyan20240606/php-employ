<?php
// 先连接  再写  报异常失败， 读 异常


// 连接memcached服务器  

/*// 申请一个对象
$mem = new Memcache();

// 连接memcached服务
$mem->addServer('140.143.30.117',11211);*/

class Mem {
	private $handle = null;
	// 检查扩展是否存在
	private $so = true;

	public function  __construct(array $hosts){
		// 检查给定的扩展是否存在
		$this->so = extension_loaded('Memcache');
		if($this->so){
			$this->handle = new Memcache();
		}else{
			$this->handle = new Memcached();
		}
		// 连接memcached服务  '140.143.30.117',11211
		foreach($hosts as $item){
			[$host,$port] = $item;
			$this->handle->addServer($host,$port);
		}
		
	}

	// 获取
	public function get(string $key){
		return $this->handle->get($key);
	}

	// 添加与设置
	public function set(string $key,$value,int $expire=3600){
		if($this->so){
			$this->handle->set($key,$value,MEMCACHE_COMPRESSED,$expire);
		}else{
			$this->handle->set($key,$value,$expire);
		}
	}

	// 删除
	public function del(string $key){
		return $this->handle->delete($key);
	}

}

$hosts = [
	['140.143.30.117',11211],
	['140.143.30.117',11212],
	['140.143.30.117',11213],
	['140.143.30.117',11214]
];
// $key 转为整数 crc32  % 4  3 取余
// 一致性hash 
$mem = new Mem($hosts);
//$mem->set('name','张三');
echo $mem->get('name');

