# 開發文件
1. 用git下載
2. 建立自己的`.env`檔案、修改資料庫連線配置
3. 生成新的key `php artisan key:generate`
4. 清除cache `php artisan config:clear`
5. 建立基本資料 `php artisan admin:install`

## 增加api controller
```
php artisan make:controller api\StationController
```

## laravel-admin 相關
1. 建立模型
php artisan make:model Models/Category
2. 建立遷移檔案
php artisan make:migration create_categories_table
3. 建立填充檔案
php artisan make:seeder CategoriesSeeder
3. 先做MIGRATE後面跑的第四步驟就會自動填入欄位
php artisan migrate
4. 建立後端控制器
php artisan admin:make CategoryController --model=App\Models\Category
5. 建立後端路由
app/admin/routes.php ： $router->resource('/web/categories',CategoryController::class);
6. 新增後端選單
/web/categories：選單路徑
7. 其他定義及編輯定製

## 增加admin列表
```
php artisan admin:make StationController --model=App\Station
```

## laravel migration rollback
```
php artisan migrate:rollback
```

## 加入ekeditor(https://github.com/laravel-admin-extensions/ckeditor)
```
composer require laravel-admin-ext/ckeditor
```

## 配置config(config\admin.php)
```
'extensions' => [
    'ckeditor' => [
    
        //Set to false if you want to disable this extension
        'enable' => true,
        
        // Editor configuration
        'config' => [
            'lang'   => 'zh-TW',
            'height' => 500,
        ],
    ],
],
```

## 加入laravel-filemanager()
做完整套的安裝
https://unisharp.github.io/laravel-filemanager/installation
就可以開始串接
https://unisharp.github.io/laravel-filemanager/integration
過程參考
https://bonze.tw/laravel-ckeditor-with-laravel-file-manager/

### 記得做publish
```
php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
```

### Create symbolic link
```
php artisan storage:link
```

### 需另外安裝helper(laravel/helpers)
```
composer require laravel/helpers
```

### 更改config\lfm.php
```
'middlewares' => ['web', 'auth'],
'url_prefix' => 'laravel-filemanager',

// 我們換成

'middlewares' => ['web', 'admin'],
'url_prefix' => '/admin/laravel-filemanager',
```

### 更改config\admin.php(extensions.ckeditor.config)
```
filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images',
filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files'
```

### 關掉多個USER使用
```
// If true, private folders will be created for each signed-in user.
'allow_multi_user' => false,
// If true, share folder will be created when allow_multi_user is true.
'allow_share_folder' => false,
```

### ckeditor目前是標準版，若需要更多功能則需要去官網下載完整版，並將zip檔的內容置換到指定目錄(vendor...)(尚未解決)
https://ckeditor.com/ckeditor-4/download/

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)
- [云软科技](http://www.yunruan.ltd/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
