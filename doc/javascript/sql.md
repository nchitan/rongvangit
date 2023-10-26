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


## Lấy ngày trong tuần
```sql
SELECT DAYOFWEEK("2017-06-15"); 
```

Lấy thứ
```sql
SELECT
(
  CASE dayofweek(now())
    WHEN 1 THEN '日曜日'
    WHEN 2 THEN '月曜日'
    WHEN 3 THEN '火曜日'
    WHEN 4 THEN '水曜日'
    WHEN 5 THEN '木曜日'
    WHEN 6 THEN '金曜日'
    WHEN 7 THEN '土曜日'
  END
)
AS week
;
```

```sql
        $str_take_dayofweek = 
            "THEN CASE DAYOFWEEK(at_time_records.created_at)  
                WHEN 1 THEN 'CN'
                WHEN 2 THEN 'T2'
                WHEN 3 THEN 'T3'
                WHEN 4 THEN 'T4'
                WHEN 5 THEN 'T5'
                WHEN 6 THEN 'T6'
                WHEN 7 THEN 'T7' 
            END ";
```

## Chuyển giây sang mm:ss
https://stackoverflow.com/questions/37253356/mysql-how-to-convert-seconds-to-mmss-format

```sql
CONCAT(FLOOR(seconds/60), ':', LPAD(MOD(seconds,60), 2, 0)) AS `m:ss`
```

https://www.wakuwakubank.com/posts/335-mysql-sql-function-date/



## Chuyen time thanh mm:ss 
```sql
$str_tmp[$result['id']] = ",  CONCAT(FLOOR(". "(MAX(CASE WHEN at_time_records.created_at >= '" 
.$datetime ."' AND at_time_records.record_type_id = 2 THEN TIME_TO_SEC(at_time_records.time)  ELSE NULL END) - MAX(CASE WHEN at_time_records.created_at >= '" 
. $datetime ."' AND at_time_records.record_type_id = 1 THEN TIME_TO_SEC(at_time_records.time)  ELSE NULL END))" ."/3600)

, ':', 
LPAD("."
FLOOR((


MAX(CASE WHEN at_time_records.created_at >= '" 
. $datetime ."' AND at_time_records.record_type_id = 2 THEN TIME_TO_SEC(at_time_records.time)  ELSE NULL END) 
- MAX(CASE WHEN at_time_records.created_at >= '" 
. $datetime ."' AND at_time_records.record_type_id = 1 THEN TIME_TO_SEC(at_time_records.time)  ELSE NULL END)

)" . "
/60), 2, 0

)
) AS '" 
. $result['name'] . "'"; 
```

## if else trong sql
https://stackoverflow.com/questions/8763310/how-do-write-if-else-statement-in-a-mysql-query

```sql
SELECT col1, col2, (case when (action = 2 and state = 0) 
 THEN
      1 
 ELSE
      0 
 END)
 as state from tbl1;
```


## Tao bang moi
```sql
create table dekita.post_tag_grps (id int, post_item varchar(100), tag_slug varchar(100), status int default 1


    , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP);
```

## Lay 10 ngay tu ngay hien tai
```sql
`Date` > date_sub(now(), interval 10 day)
```



## Kiem tra char co ton tai trong string
https://thispointer.com/mysql-string-contains-query/

```sqp
SELECT name, LOCATE('in',name), LOCATE('in',name,3) FROM metal;
```

## So sanh cac kieu join
https://mode.com/sql-tutorial/sql-outer-joins/#:~:text=In%20an%20outer%20join%2C%20unmatched,unmatched%20rows%20from%20both%20tables.