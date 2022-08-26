# Laravel Javascript Enums Package

Used in conjunction with [PHP 8 enums](https://www.php.net/manual/en/language.types.enumerations.php) to allow use of enums in javascript.

## Installation

Add the following to your `composer.json`
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/ThorNissen/laravel-javascript-enums"
    }
],
```

Run
```
composer require psydoc/laravel-javascript-enums
```

Add this line to your `config/app.php` under "Package Service Providers"
```
Psydoc\LaravelJavascriptEnums\Providers\LaravelJavascriptEnumsProvider::class,
```

```
php artisan vendor:publish --tag=laravel-javascript-enums-config
```

Add `@enums` to your blade files, before your other javascript files that need access to the enums.

Example:
```
<head>
    ...

    @enums
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
```

Enums are now available in javascript using `enums.{enum}.{key}`

Example:
```
enum UserType: int
{
    case ADMIN = 1;
    case USER = 2;
}
```
```
console.log(enums.UserType.ADMIN); // 1
console.log(enums.UserType.USER);  // 2
```
