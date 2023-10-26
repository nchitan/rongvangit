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

## Cách chạy js trước và sau khi load page
https://www.nishishi.com/javascript-tips/onload-page.html

## Cách lấy thuộc tính name của button vừa click

```javascrip
$(document).on('click', '.record-btn button', function (event) {
    var el = $(this)//record-btn 
    action = el.attr('name');
```

## Cách thêm phần tử vào sau phần tử khác
```javascript
var dt = new Date(data['created_at']);
dt = dt.getHours()  + ":" + dt.getMinutes()
_time = '<td align="center" nowrap><div id="timerecorder_txt">'+action.toUpperCase()+'<br/><br/>('+dt+')</div></td>';
el.after(_time);
el.remove();
```

## Cách lấy phần tử lấy từ class 
```javascript
    var el = $('.record-btn button');
    //action = el.attr('name');
    console.log(el);

    $.each(el, function (index, value) {
        console.log(index, value);
    });
```

## Thao tác với db laravel

### Select all
```sql
$posts = DB::table('tmd_record_type')->get();   
```

lấy dưới dạng array
```sql
$posts = DB::table('tmd_record_type')->get()->toArray();  
```

### Select where
```sql
$result= Tmd_time_record::select(
        'm_user_tbl.user_name',
        'tmd_record_type.record_type_name',
        'tmd_time_record.work_date',
        )
        ->join('m_user_tbl', 'm_user_tbl.user_id', '=', 'tmd_time_record.user_id')
        ->join('tmd_record_type', 'tmd_record_type.record_type_id', '=', 'tmd_time_record.record_type_id')
        ->where([['tmd_time_record.user_id', '=', $user_id]])
        ->where([['tmd_time_record.work_date', '=', $date]])
        ->orderBy('tmd_time_record.work_date')->get()->all();
```

### select chay sql
```php
$str_sql ="select * from ss";
return DB::select(DB::raw($str_sql));
```

## Tao debug bar
https://qiita.com/LowSE01/items/b72da1ccd7259ac27253


## Lấy thuộc tính từ foreach trong dom
Phải gói element trong collection vào $
https://stackoverflow.com/questions/4114870/jquery-value-attr-is-not-a-function

```js
var el = $('.record-btn button');
$.each(el, function (index, value) {
    console.log($(value).attr('name'));
});
````


## Cách tạo file seeder

Thêm các nội dung cần nhập vào talbe
tạo file DatabaseSeeder.php và thêm các class vào

https://qiita.com/kuma15/items/1687696bdd6be094c780

```php
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AapHolidayRequests::class);
        $this->call(AapHolidayTypes::class);
        ///
    }
}
```

Sau đó đăng ký autoload taị composer.json
```php
,
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Modules\\": "Modules/"
        },
        "classmap": [
            "database/seeds",
            "database/factories"
        ]
    }
```

Sau đó chạy composer dump để xoá lỗi
```cmd
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload

php artisan migrate
php artisan db:seed
```

## chay seed tu 1 file
```bat
php artisan migrate --path=/database/migrations/2022_03_11_130459_categories.php

php artisan db:seed --class=AhUsers
```

## Tao date tu js
https://bobbyhadz.com/blog/javascript-format-date-yyyy-mm-dd-hh-mm-ss


## Cách chạy dữ án clone gihub
```php
composer install
npm install
```

Tạo file .env

```php
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```


## Kiểm tra record có tồn tại trong mysql
```php
if (Tag::where('slug', strtolower($tag))->exists()) {
                     // exists
}else{

}
```

## Lấy value từ request
```php
        $req = $request->all();
        if ($request->filled('user_id')) {
            $user_id = $req['user_id'];
        }  
        if ($request->filled('title')) {
            $title = $req['title'];
        }  
        if ($request->filled('content')) {
            $content = $req['content'];
        }
        if ($request->filled('tag')) {
            $tags = explode(",",$req['tag']);
        }
```

## Trả lỗi từ control thành 404 not found hoặc 500 lỗi serve
```php
 abort('500');
  abort('404');
```


## join trong laravel
https://www.tutsmake.com/laravel-eloquent-join-2-tables-example/#:~:text=If%20you%20want%20to%20join,relationships%20instead%20of%20laravel%20join.
```php
$users = User::join('posts', 'posts.user_id', '=', 'users.id')
              ->join('comments', 'comments.post_id', '=', 'posts.id')
              ->get(['users.*', 'posts.descrption']);
```

## Loi nothing to migrate
You don't need to move the migration file anywhere, just change its filename; for example, increase time integer and then run the migrate command with the path pointing to the migration. e.g: php artisan migrate --path="database/migrations/2019_07_06_145857_create_products_table.php"

## redicrect sau khi luu post bang form va quay ve post
```php
        return redirect() -> route('user.showQuestion', ['username' => $username, 'quetion' => $item]);
```

```php
Route::get('/{username}/questions/{quetion}','UserController@showQuestion')->name('user.showQuestion');;;
Route::post('/{username}/questions/{quetion}','UserController@storeQuestion');
```


## Jestream khong hien anh profile

Thay
```php
        // 'url' => 'http://localhost/storage',

        'url' => 'http://127.0.0.1:8000/storage',
```

Trong file config.php cua boot trap
/Users/ChisThanh/_dev/dekita/bootstrap/cache/config.php


## Push 
https://www.webprofessional.jp/add-real-time-notifications-laravel-pusher/

## Tao face databale bang factory
```php
https://dev.to/shanisingh03/generate-dummy-laravel-data-with-model-factories-seeder-gg4
```


## Lỗi khi notification 

Khi tạo __construct, cần chuyển biến protected vào như đối số.
Và thông thường, notification sẽ dùng model User ở ngay sau App,
nên phải khai báo using App/Models

```php
use App\Models\User;

    public function __construct($follower)
    {
  
        $this->follower = $follower;
    }
```

## Cài webpad để mix css và js

Viết trong webpack.mix.js
```js
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    // .js('resources/assets/js/app.js', 'public/js')



    ;
```
Sau đó chạy lệnh mix
```cmd
npm run dev
```
Sau khi mix, phải load file mix vào web
```php
<script src="{{ asset('js/app.js') }}" defer></script>
```

## Cach cai dat rongvangit
1. Cài laravel
2. Cài Jetstream
3. Cài nwidart
https://nwidart.com/laravel-modules/v6/introduction
4. Cài Toc
https://github.com/caseyamcl/toc
```cmd
composer require caseyamcl/toc
```


## Gui lai noi dung khi validate bi loi
```php
        if($validated->fails())
        {
            return redirect()->back()->withErrors($validated)->withInput();
        }
```
Sau do su dung old input tai các vị trí cần
```php
value="{{ old('title') }}">
<textarea>{{ old('editor') }}</textarea>
```

Luu y lay value của textarea
```js
$("#editor").val()
```


## Tạo migrate table với key không trùng lặp xác định bởi nhiều cột
```php
$table->unique(['category_id', 'username', 'sub_category_name'], 'sub_category_unique_key');
```

validate
```php
'template_id' => 'required|unique:product_template_options, template_id, NULL, NULL, option_id, ' . $request['option_id'],
'option_id.*' => 'required|unique:product_template_options, option_id, NULL, NULL, template_id, ' . $request['template_id'],
``

https://stackoverflow.com/questions/68934060/how-to-stop-duplicate-entries-to-be-inserted-while-updating-in-database-in-larav
```

## Update nhieu field 
https://leben.mobi/blog/laravel_multi_update/php/

```php
$update_column = [
        'colour' => 'black',
        'size' => 'XL', 
        'price' => 10000 // Add as many as you need
];
 
$itemTypes = [1, 2, 3, 4, 5];
 
ItemTable::whereIn('item_type_id', $itemTypes)
    ->update($update_column);
```

## increrement nhieu field
```php
\App\User::increment('ordered_count', 5, ['name' => '新しい名前']);
```
https://blog.capilano-fw.com/?p=699#increment



## Up laravel len host

1. Tao storage link 
https://stackoverflow.com/questions/45825889/how-to-create-laravel-storage-symbolic-link-for-production-or-sub-domain-system

https://www.pinlaz.com/vi/huong-dan-dua-project-laravel-len-hosting_5.html

```php
ln -s $HOME/public_html/rongvangit.com/storage/app/public $HOME/public_html/rongvangit.com/public/storage
```


## Cai sitemap laravel
https://codelapan.com/post/how-to-create-a-dynamic-sitemap-in-laravel-8