<?php

namespace App\Repositories;

use App\Contracts\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAll(): Collection
    {
        return Customer::orderBy('name')->get();
    }

    public function find(int $id): ?Customer
    {
        return Customer::find($id);
    }

    public function findByEmail(string $email): ?Customer
    {
        return Customer::where('email', $email)->first();
    }

    public function create(array $data): Customer
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return Customer::create($data);
    }

    public function update(int $id, array $data): bool
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        return Customer::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        $customer = Customer::find($id);
        return $customer ? $customer->delete() : false;
    }
}