<?php

namespace App\Contracts;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

interface BrandRepositoryInterface
{
    public function getAll(): Collection;
    public function getActive(): Collection;
    public function find(int $id): ?Brand;
    public function create(array $data): Brand;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}