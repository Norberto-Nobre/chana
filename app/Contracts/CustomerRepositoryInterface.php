<?php

namespace App\Contracts;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface
{
    public function getAll(): Collection;
    public function find(int $id): ?Customer;
    public function findByEmail(string $email): ?Customer;
    public function create(array $data): Customer;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}