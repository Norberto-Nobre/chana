<?php

namespace App\Services;

use App\Contracts\VehicleModelRepositoryInterface;
use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class VehicleModelService
{
    public function __construct(
        private VehicleModelRepositoryInterface $vehicleModelRepository
    ) {}

    public function getAllModels(): Collection
    {
        return $this->vehicleModelRepository->getAll();
    }

    public function getActiveModels(): Collection
    {
        return $this->vehicleModelRepository->getActive();
    }

    public function getModelsByBrand(int $brandId): Collection
    {
        return $this->vehicleModelRepository->getByBrand($brandId);
    }

    public function getModelsByCategory(int $categoryId): Collection
    {
        return $this->vehicleModelRepository->getByCategory($categoryId);
    }

    public function findModel(int $id): ?VehicleModel
    {
        return $this->vehicleModelRepository->find($id);
    }

    public function createModel(array $data): VehicleModel
    {
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->vehicleModelRepository->create($data);
    }

    public function updateModel(int $id, array $data): bool
    {
        $model = $this->vehicleModelRepository->find($id);
        
        if (!$model) {
            return false;
        }

        if (isset($data['image']) && $data['image']) {
            // Delete old image
            if ($model->image) {
                Storage::disk('public')->delete($model->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->vehicleModelRepository->update($id, $data);
    }

    public function deleteModel(int $id): bool
    {
        $model = $this->vehicleModelRepository->find($id);
        
        if (!$model) {
            return false;
        }

        // Delete image file
        if ($model->image) {
            Storage::disk('public')->delete($model->image);
        }

        return $this->vehicleModelRepository->delete($id);
    }

    private function uploadImage($file): string
    {
        return $file->store('vehicle-models/images', 'public');
    }
}