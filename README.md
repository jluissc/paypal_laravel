### git clone https://github.com/jluissc/paypal_laravel.git

### run  => php artisan migrate

### run => composer require srmklive/paypal:~1.0


Add the service provider to your providers[] array in config/app.php file like:
Srmklive\PayPal\Providers\PayPalServiceProvider::class

Add the alias to your aliases[] array in config/app.php file like:
'PayPal' => Srmklive\PayPal\Facades\PayPal::class

### run => php artisan vendor:publish --provider "Srmklive\PayPal\Providers\PayPalServiceProvider"


Follow this page => https://github.com/srmklive/laravel-paypal/tree/v1.0

### run => php artisan serve