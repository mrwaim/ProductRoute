<?php

namespace Klsandbox\ProductRoute;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ProductRouteServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot(Router $router)
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../../../routes/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/../../../views/', 'product-route');

        $this->publishes([
            __DIR__ . '/../../../views/' => base_path('resources/views/vendor/product-route'),
        ], 'views');

        \Blade::extend(function ($view, $compiler) {
            $pattern = "/(?<!\w)(\s*)@(products)-link\(\s*(.*?)\)/";

            return preg_replace($pattern, '$1'
                . '<?php if($auth->admin) {?>' . PHP_EOL
                . '<a href="/$2/edit/<?php echo $3->id ?>"><?php echo $3->name ?></a>' . PHP_EOL
                . '<?php } else { ?>' . PHP_EOL
                . '<?php echo $3->name ?>' . PHP_EOL
                . '<?php }?>', $view);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
