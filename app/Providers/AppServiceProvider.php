<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        //
    }

    /* protected function registerLengthAwarePaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, function ($app, $values) {
            return new class(...array_values($values)) extends LengthAwarePaginator
            {
                public function only(...$attributes)
                {
                    return $this->transform(function ($item) use ($attributes) {
                        return $item->only($attributes);
                    });
                }
                public function transform($callback)
                {
                    $this->items->transform($callback);
                    return $this;
                }
                public function toArray()
                {
                    return ['data' => $this->items->toArray(), 'links' => $this->links(),];
                }
                public function links($view = null, $data = [])
                {
                    $this->appends(Request::all());
                    $window = UrlWindow::make($this);
                    $elements = array_filter([$window['first'], is_array($window['slider']) ? '...' : null, $window['slider'], is_array($window['last']) ? '...' : null, $window['last'],]);
                    return Collection::make($elements)->flatMap(function ($item) {
                        if (is_array($item)) {
                            return Collection::make($item)->map(function ($url, $page) {
                                return ['url' => $url, 'label' => $page, 'active' => $this->currentPage() === $page,];
                            });
                        } else {
                            return [['url' => null, 'label' => '...', 'active' => false,],];
                        }
                    })->prepend(['url' => $this->previousPageUrl(), 'label' => 'Previous', 'active' => false,])->push(['url' => $this->nextPageUrl(), 'label' => 'Next', 'active' => false,]);
                }
            };
        });
    } */
}
