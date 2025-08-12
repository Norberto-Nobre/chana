<?php

namespace App\Repositories;

use App\Contracts\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandRepository implements BrandRepositoryInterface
{
    public function getAll(): Collection
    {
        return Brand::orderBy('name')->get();
    }

    public function getActive(): Collection
    {
        return Brand::where('is_active', true)
                   ->orderBy('name')
                   ->get();
    }

    public function find(int $id): ?Brand
    {
        return Brand::find($id);
    }

    public function create(array $data): Brand
    {
        return Brand::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Brand::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        $brand = Brand::find($id);
        return $brand ? $brand->delete() : false;
    }
}