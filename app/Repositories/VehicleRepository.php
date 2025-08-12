<?php

namespace App\Repositories;

use App\Contracts\VehicleRepositoryInterface;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function getAvailableVehicles(string $startDate, string $endDate): Collection
    {
        return Vehicle::with(['model.brand', 'model.category'])
                      ->where('status', Vehicle::STATUS_AVAILABLE)
                      ->get()
                      ->filter(function ($vehicle) use ($startDate, $endDate) {
                          return $vehicle->isAvailable($startDate, $endDate);
                      });
    }

    public function find(int $id): ?Vehicle
    {
        return Vehicle::with(['model.brand'])->find($id);
    }

    public function updateStatus(int $id, string $status): bool
    {
        return Vehicle::where('id', $id)->update(['status' => $status]);
    }

    public function getAllVehicles(): Collection
    {
        return Vehicle::with(['model.brand'])->get();
    }
}