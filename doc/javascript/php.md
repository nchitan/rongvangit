---
title: Cắt chuỗi trong JavaScript (slice)
category:
  - JAVASCRIPT
  - JavaScript cơ bản đến nâng cao
  - Chuỗi trong JavaScript
tags:
  - JAVASCRIPT
  - JavaScript cơ bản đến nâng cao
  - Chuỗi trong JavaScript
date: 2021-07-20 20:57:09
---
Hướng dẫn cách **cắt chuỗi trong JavaScript**. Bạn sẽ học được cách sử dụng phương thức slice() trong JavaScript để cắt một chuỗi nhỏ ra từ chuỗi chỉ định mà không làm thay đổi chuỗi ban đầu sau bài học này.
<escape><!-- more --></escape>



## Tạo datime và format
```php
        //$datetime = date_create_from_format('Y-m-d H:i:s', $datetime);
        $storeData['user_id'] = $user_id;
        $storeData['record_type_id'] = $record_type;      
        // $storeData['date'] = date_format($datetime,'Y-m-d');
        // $storeData['time'] = date_format($datetime,'H:i:s');
```




## Chuyển text h:m sang time
```php
                function taketime($value){
                    $t = explode( ":", $value);
                    $sum = (int)$t[0] * 60 + (int)$t[1];
                    return $sum;
                }


```

## Chuyển giây sang định dạng h:m
```php
                function maketime($num){
                    $hours = floor($num / 60);
                    $minutes = $num % 60;
                    return str_pad($hours, 2, "0", STR_PAD_LEFT).':'.str_pad($minutes, 2, "0", STR_PAD_LEFT);
                }
```
## Lấy thứ từ ngày
```php
//Lấy thứ từ ngày
$year  = date("Y");
$month = date("m");
$day   = 1;
$datetime = new DateTime();
$datetime->setDate($year, $month, $day);
$week = array("CN", "T2", "T3", "T4", "T5", "T6", "T7");
$w = (int)$datetime->format('w');
$day_of_week = $week[$w];
```

## Lấy số ngày trong tháng

```php
$t = date('t)');
```

## Chuyển datetime sang string
```php
$theDate    = new DateTime('2020-03-08');
echo $stringDate = $theDate->format('Y-m-d H:i:s');
```


## Tạo random char từ số
```php
        $user_id = 1;


        $str =$user_id.date('y').date('m').date('d').date('h').date('m').date('s');
        $text =  str_split(strval($str ));
        $item = '';
        foreach ($text as $key => $value){
            if($key%2 == 0){
                $item.=chr(intval($value)+97);
            }else{
                $item.=$value;
            }
```
## in 100 tu dau tien trong chuoi
```php
<?php echo substr($post['content'],0,200).'...'; ?>
```


## Lay url
```php
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
```

## Kiem tra co ton tai trong strin
```php
if (your_string.indexOf('hello') > -1)
{
  alert("hello found inside your_string");
}
```