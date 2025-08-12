<?php

namespace App\Repositories;

use App\Contracts\OfficeRepositoryInterface;
use App\Models\Office;
use Illuminate\Database\Eloquent\Collection;

class OfficeRepository implements OfficeRepositoryInterface
{
    public function getAll(): Collection
    {
        return Office::orderBy('name')->get();
    }

    public function getActive(): Collection
    {
        return Office::where('is_active', true)
                    ->orderBy('name')
                    ->get();
    }

    public function find(int $id): ?Office
    {
        return Office::find($id);
    }

    public function create(array $data): Office
    {
        return Office::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Office::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        $office = Office::find($id);
        return $office ? $office->delete() : false;
    }
}