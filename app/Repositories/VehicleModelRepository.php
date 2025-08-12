<?php

namespace App\Repositories;

use App\Contracts\VehicleModelRepositoryInterface;
use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Collection;

class VehicleModelRepository implements VehicleModelRepositoryInterface
{
    public function getAll(): Collection
    {
        return VehicleModel::with(['brand', 'category'])
                          ->orderBy('name')
                          ->get();
    }

    public function getActive(): Collection
    {
        return VehicleModel::with(['brand', 'category'])
                          ->where('is_active', true)
                          ->orderBy('name')
                          ->get();
    }

    public function getByBrand(int $brandId): Collection
    {
        return VehicleModel::with(['brand', 'category'])
                          ->where('brand_id', $brandId)
                          ->where('is_active', true)
                          ->orderBy('name')
                          ->get();
    }

    public function getByCategory(int $categoryId): Collection
    {
        return VehicleModel::with(['brand', 'category'])
                          ->where('category_id', $categoryId)
                          ->where('is_active', true)
                          ->orderBy('name')
                          ->get();
    }

    public function find(int $id): ?VehicleModel
    {
        return VehicleModel::with(['brand', 'category'])->find($id);
    }

    public function create(array $data): VehicleModel
    {
        return VehicleModel::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return VehicleModel::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        $model = VehicleModel::find($id);
        return $model ? $model->delete() : false;
    }
}