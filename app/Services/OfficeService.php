<?php

namespace App\Services;

use App\Contracts\OfficeRepositoryInterface;
use App\Models\Office;
use Illuminate\Database\Eloquent\Collection;

class OfficeService
{
    public function __construct(
        private OfficeRepositoryInterface $officeRepository
    ) {}

    public function getAllOffices(): Collection
    {
        return $this->officeRepository->getAll();
    }

    public function getActiveOffices(): Collection
    {
        return $this->officeRepository->getActive();
    }

    public function findOffice(int $id): ?Office
    {
        return $this->officeRepository->find($id);
    }

    public function createOffice(array $data): Office
    {
        return $this->officeRepository->create($data);
    }

    public function updateOffice(int $id, array $data): bool
    {
        return $this->officeRepository->update($id, $data);
    }

    public function deleteOffice(int $id): bool
    {
        return $this->officeRepository->delete($id);
    }
}