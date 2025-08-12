<?php

namespace App\Contracts;

use App\Models\Office;
use Illuminate\Database\Eloquent\Collection;

interface OfficeRepositoryInterface
{
    public function getAll(): Collection;
    public function getActive(): Collection;
    public function find(int $id): ?Office;
    public function create(array $data): Office;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}