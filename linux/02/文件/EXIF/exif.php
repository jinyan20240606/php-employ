<?php
/**
 * @Author 黑马程序员-传智播客旗下高端教育品牌 [itcast.cn]
 * @Date    2019-02-22 17:37:51
 * @Version 1.0.0
 * @Description 根据图片原图获取照片的拍摄地址和设备信息
 * ━━━━━━神兽出没━━━━━━
 * 　　   ┏┓　 ┏┓
 * 　┏━━━━┛┻━━━┛┻━━━┓
 * 　┃              ┃
 * 　┃       ━　    ┃
 * 　┃　  ┳┛ 　┗┳   ┃
 * 　┃              ┃
 * 　┃       ┻　    ┃
 * 　┃              ┃
 * 　┗━━━┓      ┏━━━┛ Code is far away from bugs with the animal protecting.
 *       ┃      ┃     神兽保佑,代码无bug。
 *       ┃      ┃
 *       ┃      ┗━━━┓
 *       ┃      　　┣┓
 *       ┃      　　┏┛
 *       ┗━┓┓┏━━┳┓┏━┛
 *     　  ┃┫┫　┃┫┫
 *     　  ┗┻┛　┗┻┛
 *
 * ━━━━━━感觉萌萌哒━━━━━━
 */

/**
 * @Author      Y
 * @DateTime    2019-04-08
 * @Description 将度分秒转化成度
 */
function getDU($arr){
	$data = 0;
	foreach ($arr as $key => $value) {
		$tmp = explode('/', $value);
		if($key === 0){
			$data += $tmp[0] / $tmp[1];
		}else if($key === 1){
			$data += $tmp[0] / $tmp[1] / 60;
		}else{
			$data += $tmp[0] / $tmp[1] / 3600;
		}
	}
	return $data;
}
// 读取照片信息
$data = exif_read_data('images/IMG_20180430_123953.jpg');
echo "<pre>";
echo "设备型号：{$data['Make']} {$data['Model']}";
echo '<hr/>';
// 经纬度获取
$weidu = getDU($data['GPSLatitude']);
$jingdu = getDU($data['GPSLongitude']);

// api
$api = 'https://api.i-lynn.cn/poi?location=';
$res = json_decode(file_get_contents($api . round($jingdu,6) . ',' . round($weidu,6)),true);
echo 'POI：' . $res['regeocode']['formatted_address'] ? : '查询无果';

