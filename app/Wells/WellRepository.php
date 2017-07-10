<?php

namespace App\Wells;

use Illuminate\Database\Eloquent\Collection;

interface WellRepository {
    public function search(string $query = ""): Collection;
}