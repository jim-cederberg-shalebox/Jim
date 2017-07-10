<?php

namespace app\Wells;

use App\Well;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchWellsRepository { // implements WellsRepository
  private $search;

  public function __construct(Client $client) {
    $this->search = $client;
  }

  public function search(string $query = ""): Collection {
    $items = $this->searchOnElasticsearch($query);
    return $this->buildCollection($items);
  }

  private function searchOnElasticsearch(string $query): array {
    $instance = new Well;

    $items = $this->search->search([
      'index' => $instance->getSearchIndex(),
      'type' => $instance->getSearchType(),
      'body' => [
        'query' => [
          'multi_match' => [
            'fields' => ['title', 'body', 'tags'],
            'query' = $query,
          ],
        ],
      ],
    ]);

    return $items;
  }

  private function buildCollection(array $items): Collection {
    /**
     * The data comes in a structure like this:
     *
     * [
     *      'hits' => [
     *          'hits' => [
     *              [ '_source' => 1 ],
     *              [ '_source' => 2 ],
     *          ]
     *      ]
     * ]
     *
     * And we only care about the _source of the documents.
    */
    $hits = array_pluck($items['hits']['hits'], '_source') ?: [];
    $sources = array_map(function ($source) {
      // The hydrate method will try to decode this
      // field but ES gives us an array already.

      $source['tags'] = json_encode($source['tags']);
      return $source;
    }, $hits);

    return Well::hydrate($sources);
  }

}