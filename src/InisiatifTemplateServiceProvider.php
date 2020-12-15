<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;
use Inisiatif\Package\Template\View\Composers\Disclaimer;

final class InisiatifTemplateServiceProvider extends ServiceProvider
{
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function boot(): void
    {
        /** @var Factory $view */
        $view = $this->app->make('view');

        $view->composer('*', Disclaimer::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'inisiatif');
    }
}
