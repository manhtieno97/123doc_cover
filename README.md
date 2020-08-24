# Bài tập Get Cover

## Tìm hiểu về Get Cover.

 Đầu vào là đường dẫn folder quét tất cả folder con, lấy cover tất cả các file psd, tif,jpeg lớn.

Thực hiện bởi [Nguyễn Mạnh Tiến](https://github.com/manhtieno97)

## Liên kết

- Liên kết đề bài :https://www.php.net/manual/en/book.imagick.php
- Liên kết học liệu :https://gist.github.com/ivanhoe011/4115733bd21ec988b1f6

## Hướng dẫn cài đặt test/sử dụng nếu có

**Cài đặt magick**:https://mlocati.github.io/articles/php-windows-imagick.html

**Hướng dẫn hoạt động**: Vào config\filetype :

    'fileTypes' => explode(",", env('FILE_TYPE_COVER', 'psd,tif,jpeg')) ,
    
"fileType" là mảng chứa các loại file cần cover. 
    
    'fileSize' => [
        'lagger' => [
            'width' => env('IMAGE_COVER_WIDTH_LG', 720),
            'height' => env('IMAGE_COVER_HEIGHT_LG', 720),
            'url' => env('IMAGE_COVER_URL_LG', 'images/lagger'),
        ],
        'medium' => [
            'width' => env('IMAGE_COVER_WIDTH_MD', 500),
            'height' => env('IMAGE_COVER_HEIGHT_MD', 500),
            'url' => env('IMAGE_COVER_URL_MD', 'images/medium'),
        ],
        'small' => [
            'width' => env('IMAGE_COVER_WIDTH_SM', 250),
            'height' => env('IMAGE_COVER_HEIGHT_SM', 250),
            'url' => env('IMAGE_COVER_URL_SM', 'images/small'),
        ],
       
    ],
        
- "fileSize" là mảng chứa kích thước ảnh cover và đường dẫn lưu ảnh cover. 


- **Hoặc** vào .env để cấu hình
    
      FILE_TYPE_COVER=psd,tif,jpeg
      IMAGE_COVER_WIDTH_MD=500
      IMAGE_COVER_HEIGHT_MD=500
      IMAGE_COVER_URL_MD=images/medium


## Kiến thức nắm được

 - Biết thêm về magick và cách sử dụng, một số function của nó.
 
 - Hiểu thêm về cách lấy các folder


## Todo

Sử dụng để convert các file thành hình ảnh để hiển thị cho người dùng nhận biết.

## Credit

- https://github.com/manhtieno97/123doc_cover

- https://www.php.net/manual/en/book.imagick.php





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

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
