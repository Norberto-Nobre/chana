<?php

namespace App\Contracts;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

interface VehicleRepositoryInterface
{
    public function getAvailableVehicles(string $startDate, string $endDate): Collection;
    public function find(int $id): ?Vehicle;
    public function updateStatus(int $id, string $status): bool;
    public function getAllVehicles(): Collection;
}