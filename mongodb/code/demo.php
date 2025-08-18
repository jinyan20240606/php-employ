<?php
//连接mongodb数据库，
$manager = new MongoDB\Driver\Manager("mongodb://phpadmin:123456@localhost:27017/php");
/*//1、插入操作；
//创建一个插入对象
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert(['name'=>'刘备','age'=>12,'email'=>'liubei@sohu.com']);
$bulk->insert(['name'=>'关羽','age'=>22,'email'=>'guanyu@sohu.com']);
$bulk->insert(['name'=>'张飞','age'=>18,'email'=>'zhangfei@sohu.com']);
//执行插入操作；
$manager->executeBulkWrite('php.stu', $bulk);
echo 'ok';*/
//2、查询数据
/*$filter = ['age'=>['$gt'=>16]];
$options = [
	'projection'=>['_id'=>0],
	'sort'=>['age'=>1]
];
//创建一个查询对象
$query = new MongoDB\Driver\Query($filter, $options);
$data = $manager->executeQuery('php.stu', $query);
echo '<pre>';
foreach($data as $v){
	print_r($v);
}*/
//3、更新数据
/*$bulk = new MongoDB\Driver\BulkWrite;
$bulk->update(
    ['age' => 12],
    ['$set' => ['name' => '刘备被', 'email' => 'liubeibei@sohu.com']],
    ['multi' => false, 'upsert' => false]
);
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
$result = $manager->executeBulkWrite('php.stu', $bulk, $writeConcern);
echo 'ok';*/
//4、删除数据
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->delete(['age' => 22], ['limit' => 1]);   // limit 为 1 时，删除第一条匹配数据
//$bulk->delete(['x' => 2], ['limit' => 0]);   // limit 为 0 时，删除所有匹配数据
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
$result = $manager->executeBulkWrite('php.stu', $bulk, $writeConcern);
echo 'ok';

?>