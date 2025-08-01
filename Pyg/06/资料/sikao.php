<?php

$one = [
    ['id' => 1, 'auth_name' => '权限管理', 'pid'=>0],
    ['id' => 2, 'auth_name' => '商品管理', 'pid'=>0],
    ['id' => 3, 'auth_name' => '订单管理', 'pid'=>0],
];

$two = [
    ['id' => 4, 'auth_name' => '管理员列表', 'pid'=>1],
    ['id' => 5, 'auth_name' => '管理员新增', 'pid'=>1],
    ['id' => 6, 'auth_name' => '角色管理', 'pid'=>1],
    ['id' => 7, 'auth_name' => '权限管理', 'pid'=>1],
    ['id' => 8, 'auth_name' => '商品列表', 'pid'=>2],
    ['id' => 9, 'auth_name' => '商品新增', 'pid'=>2],
    ['id' => 10, 'auth_name' => '订单列表', 'pid'=>3],
    ['id' => 11, 'auth_name' => '订单新增', 'pid'=>3],
];



//将以上两个数组  合并成$res 结构
/*
     $res = [
        ['id' => 1, 'auth_name' => '权限管理', 'pid'=>0, 'son' => [
            ['id' => 4, 'auth_name' => '管理员列表', 'pid'=>1],
            ['id' => 5, 'auth_name' => '管理员新增', 'pid'=>1],
            ['id' => 6, 'auth_name' => '角色管理', 'pid'=>1],
            ['id' => 7, 'auth_name' => '权限管理', 'pid'=>1],
        ]],
        ['id' => 2, 'auth_name' => '商品管理', 'pid'=>0, 'son' => [
            ['id' => 8, 'auth_name' => '商品列表', 'pid'=>2],
            ['id' => 9, 'auth_name' => '商品新增', 'pid'=>2],
        ]],
        ['id' => 3, 'auth_name' => '订单管理', 'pid'=>0, 'son' => [
            ['id' => 10, 'auth_name' => '订单列表', 'pid'=>3],
            ['id' => 11, 'auth_name' => '订单新增', 'pid'=>3],
        ]],
    ];
*/

//写法一: 遍历次数比较多
/*$res = [];
foreach($one as $v){
    //$v['id']   $v['son']=[]
    $v['son'] = [];
    foreach($two as $value){
        //判断 $value['pid'] == $v['id']
        if($value['pid'] == $v['id']){
            //找到一个
            $v['son'][] = $value;
        }
    }
    $res[] = $v;
}

echo '<pre>';
var_dump($res);*/

//写法二

/*
$new_two = [
    '1' => [
        ['id' => 4, 'auth_name' => '管理员列表', 'pid'=>1],
        ['id' => 5, 'auth_name' => '管理员新增', 'pid'=>1],
        ['id' => 6, 'auth_name' => '角色管理', 'pid'=>1],
        ['id' => 7, 'auth_name' => '权限管理', 'pid'=>1],
    ],
    '2' => [
        ['id' => 8, 'auth_name' => '商品列表', 'pid'=>2],
        ['id' => 9, 'auth_name' => '商品新增', 'pid'=>2],
    ],
    '3' => [
        ['id' => 10, 'auth_name' => '订单列表', 'pid'=>3],
        ['id' => 11, 'auth_name' => '订单新增', 'pid'=>3],
    ],
];*/
//转化$two结构   将二维数组，按照某一个键进行分组
$new_two = [];
foreach($two as $v){
    //$v['pid']
    $new_two[$v['pid']][] = $v;
}
unset($v);
/*$new_two = [];
$new_two[1][] = ['id' => 4, 'auth_name' => '管理员列表', 'pid'=>1];
$new_two[1][] = ['id' => 5, 'auth_name' => '管理员新增', 'pid'=>1];
$new_two[1][] = ['id' => 6, 'auth_name' => '角色管理', 'pid'=>1];
$new_two[1][] = ['id' => 7, 'auth_name' => '权限管理', 'pid'=>1];
$new_two[2][] = ['id' => 8, 'auth_name' => '商品列表', 'pid'=>2];
$new_two[2][] = ['id' => 9, 'auth_name' => '商品新增', 'pid'=>2];
$new_two[3][] = ['id' => 10, 'auth_name' => '订单列表', 'pid'=>3];
$new_two[3][] = ['id' => 11, 'auth_name' => '订单新增', 'pid'=>3];*/

$res = [];
foreach($one as $v){
    $v['son'] = $new_two[$v['id']];
    $res[] = $v;
}