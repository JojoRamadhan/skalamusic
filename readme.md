## New
Check out online adminpanel generator version - no packages required there, no syntax to learn, it generates Laravel project for you: [SkalaMusic.com](https://skalamusic.com)


## Package Requirements
* Laravel `^5.3`

### Laravel 5.2 users info!
To use Skalamusic with Laravel Laravel 5.2 use branch `1.x.x`

### Laravel 5.1.11 users info!
To use Skalamusic with Laravel Laravel 5.1.11 use branch `0.4.x`

## Skalamusic installation

### Please note: SkalaMusic requires fresh Laravel installation and is not suitable for use on already existing project.

1. Install the package via `composer require Jojoramadhan/skalamusic`.
2. Add `Jojoramadhan\Skalamusic\SkalamusicServiceProvider::class,` to your `\config\app.php` providers **after `App\Providers\RouteServiceProvider::class,`** otherwise you will not be able to add new ones to freshly generated controllers.
3. Configure your .env file with correct database information
4. Run `php artisan skalamusic:install` and fill the required information.
5. Register middleware `'role'       => \Jojoramadhan\Skalamusic\Middleware\HasPermissions::class,` in your `App\Http\Kernel.php` at `$routeMiddleware`
6. Access Skalamusic panel by visiting `http://yourdomain/admin`.

## More information and detailed description
[http://skalamusic.com/packages/skalamusic/](http://skalamusic.com/packages/skalamusic/)

## License
The MIT License (MIT). Please see [License File](license.md) for more information.
