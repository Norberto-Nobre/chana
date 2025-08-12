<?php

namespace App\Services;

use App\Contracts\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ) {}

    public function getAllCustomers(): Collection
    {
        return $this->customerRepository->getAll();
    }

    public function findCustomer(int $id): ?Customer
    {
        return $this->customerRepository->find($id);
    }

    public function findCustomerByEmail(string $email): ?Customer
    {
        return $this->customerRepository->findByEmail($email);
    }

    public function createCustomer(array $data): Customer
    {
        return $this->customerRepository->create($data);
    }

    public function updateCustomer(int $id, array $data): bool
    {
        return $this->customerRepository->update($id, $data);
    }

    public function deleteCustomer(int $id): bool
    {
        return $this->customerRepository->delete($id);
    }
}