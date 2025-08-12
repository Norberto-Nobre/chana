<?php

namespace App\Contracts;

use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Collection;

interface VehicleModelRepositoryInterface
{
    public function getAll(): Collection;
    public function getActive(): Collection;
    public function getByBrand(int $brandId): Collection;
    public function getByCategory(int $categoryId): Collection;
    public function find(int $id): ?VehicleModel;
    public function create(array $data): VehicleModel;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}