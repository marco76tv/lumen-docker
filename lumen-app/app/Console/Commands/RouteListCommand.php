<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Lumen\Application;

class RouteListCommand extends Command
{
    protected $signature = 'route:list';
    protected $description = 'List all registered routes';

    protected $lumen;

    public function __construct(Application $lumen)
    {
        parent::__construct();
        $this->lumen = $lumen;
    }

    public function handle()
    {
        $router = $this->lumen->router;
        $routes = $router->getRoutes();

        $this->info('Available Routes:');
        dd($routes);
        foreach ($routes as $route) {
            $methods = implode(', ', $route->methods());
            $uri = $route->uri();
            $name = $route->getName();
            $this->line("{$methods}\t{$uri}\t{$name}");
        }
    }
}
