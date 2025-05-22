# Migration assistant

```
$ composer require iv-litovchenko/laravel-migration-assistant
$ composer require iv-litovchenko/laravel-migration-assistant --ignore-platform-reqs
$ php artisan massist
```

[![Watch the video](https://img.youtube.com/vi/S0gS01xudsk/maxresdefault.jpg)](https://youtu.be/S0gS01xudsk)
[Video presentation on YouTube](https://youtu.be/S0gS01xudsk)

![Preview](https://raw.githubusercontent.com/iv-litovchenko/laravel-migration-assistant/master/resources/preview.gif)

Route::get('/liapp', function () {
    $liApp = new App();
    return $liApp->main();
});

--
Сделать постановку существующих таблиц и колонок