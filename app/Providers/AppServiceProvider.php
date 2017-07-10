<?php

namespace App\Providers;

use Elasticsearch\Client;
use App\Wells\WellsRepository;
use Illuminate\Support\ServiceProvider;
use App\Wells\EloquentWellsRepository;
use App\Wells\ElasticsearchWellsRepository;

class AppServiceProvider extends ServiceProvider {
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
      //
  }

  public function register() {
    $this->app->singleton(WellRepository::class, function($app) {
      // This is useful in case we want to turn-off our
      // search cluster or when deploying the search
      // to a live, running application at first.
      if (!config('services.search.enabled')) {
        return new EloquentWellsReposotitory();
      }

      return new ElasticsearchWellsRepository(
        $app->make(Client::class)
      );
    });

    $this->bindSearchClient();
  }

  private function bindSearchClient() {
    $this->app->bind(Client::class, function ($app) {
      return ClientBuilder::create()
        ->setHosts(config('services.search.hosts'))
        ->build();
    });
  }

}