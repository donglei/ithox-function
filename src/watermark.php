<?php
// @author donglei
///图片加文字水印
class WaterMark{
  
	public function waterFontMark($pic, $font, $words, $pos)
	{
		$dst_path = $pic;
		//创建图片的实例
		$dst = imagecreatefromstring(file_get_contents($dst_path));
		//打上文字
		//$font = './华文行楷.ttf';//字体
		$black = imagecolorallocate($dst, 0x00, 0xffff, 0xffff);//字体颜色
		list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
		$xy = $this->imgPos([$dst_w, $dst_h],[350, 40], $pos);
		imagefttext($dst, 30, 15, $xy[0], $xy[1], $black, $font, $words);
		//输出图片
		switch ($dst_type) {
			case 1://GIF
				header('Content-Type: image/gif');
				imagegif($dst, 'xx.gif');
				break;
			case 2://JPG
				header('Content-Type: image/jpeg');
				imagejpeg($dst, 'xxx.jpg');
				break;
			case 3://PNG
				header('Content-Type: image/png');
				imagepng($dst, 'xx.png');
				break;
			default:
                imagegd2($img,$path);
				break;
		}
		imagedestroy($dst);
	}
 
    // 位置为
    // 1 左上 2中上 3右上
    // 4 左中 5中中 6右中
    // 7 左下 8中下 9右下
    // 0 随机位置
    private function imgPos($ground,$water,$pos){
        if($ground[0]<$water[0] || $ground[1]<$water[1])  //判断水印与原图比较 如果水印的高或者宽比原图小 将返回假
            return false;
        switch($pos){
            case 1:
                $x=0;
                $y=0;
                break;
            case 2:
                $x=ceil(($ground[0]-$water[0])/2);
                $y=0;
                break;
            case 3: 
                $x=$ground[0]-$water[0];
                $y=0;
                break;
            case 4:
                $x=0;
                $y=ceil(($ground[1]-$water[1])/2);
                break;
            case 5:
                $x=ceil(($ground[0]-$water[0])/2);
                $y=ceil(($ground[1]-$water[1])/2);
                break;
            case 6:
                $x=$ground[0]-$water[0];
                $y=ceil(($ground[1]-$water[1])/2);
                break;
            case 7:
                $x=0;
                $y=$ground[1]-$water[1];
                break;
            case 8:
                $x=ceil($ground[0]-$water[0]/2);
                $y=$ground[1]-$water[1];
                break;
            case 9:
                $x=$ground[0]-$water[0];
                $y=$ground[1]-$water[1];
                break;
            case 0:
            default:
                $x=rand(0,$ground[0]-$water[0]);
                $y=rand(0,$ground[1]-$water[1]);
        }
        $xy[]=$x;
        $xy[]=$y;
        return $xy; 
    }
 
    
}

// 可以传进一个添加水印后保存的路径，路径相对于类脚本
// 如果为空则默认是脚本当前路径
$water=new WaterMark();     
 
// 参数：
// 1.  源图  
// 2. 水印图 即 LOGO
// 3.  位置 
// 位置为
// 1 左上 2中上 3右上
// 4 左中 5中中 6右中
// 7 左下 8中下 9右下
// 0 随机位置
 // 4. 保存添加水印图片的文件名前缀  
//  5. 透明度
$water->waterFontMark("1.jpg", './huawenxingkai.ttf' , '我的水印', 5);

