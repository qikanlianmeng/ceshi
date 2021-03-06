//定义一些常量
　　var x_PI = 3.14159265358979324 * 3000.0 / 180.0;
　　var PI = 3.1415926535897932384626;
　　var a = 6378245.0;
　　var ee = 0.00669342162296594323;
　　/**
　　* 百度坐标系 (BD-09) 与 火星坐标系 (GCJ-02)的转换
　　* 即 百度 转 谷歌、高德
　　* @param bd_lon
　　* @param bd_lat
　　* @returns {*[]}
　　*/
　　function bd09togcj02(bd_lon, bd_lat) { 
　　var x_pi = 3.14159265358979324 * 3000.0 / 180.0;
　　var x = bd_lon - 0.0065;
　　var y = bd_lat - 0.006;
　　var z = Math.sqrt(x * x + y * y) - 0.00002 * Math.sin(y * x_pi);
　　var theta = Math.atan2(y, x) - 0.000003 * Math.cos(x * x_pi);
　　var gg_lng = z * Math.cos(theta);
　　var gg_lat = z * Math.sin(theta);
　　return [gg_lng, gg_lat]
　　}
/**
* 火星坐标系 (GCJ-02) 与百度坐标系 (BD-09) 的转换
* 即谷歌、高德 转 百度
* @param lng
* @param lat
* @returns {*[]}
*/
function gcj02tobd09(lng, lat) { 
var z = Math.sqrt(lng * lng + lat * lat) + 0.00002 * Math.sin(lat * x_PI);
var theta = Math.atan2(lat, lng) + 0.000003 * Math.cos(lng * x_PI);
var bd_lng = z * Math.cos(theta) + 0.0065;
var bd_lat = z * Math.sin(theta) + 0.006;
return [bd_lng, bd_lat]
}