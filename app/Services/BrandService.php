<?php

namespace App\Services;

use App\Contracts\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    public function __construct(
        private BrandRepositoryInterface $brandRepository
    ) {}

    public function getAllBrands(): Collection
    {
        return $this->brandRepository->getAll();
    }

    public function getActiveBrands(): Collection
    {
        return $this->brandRepository->getActive();
    }

    public function findBrand(int $id): ?Brand
    {
        return $this->brandRepository->find($id);
    }

    public function createBrand(array $data): Brand
    {
        if (isset($data['logo']) && $data['logo']) {
            $data['logo'] = $this->uploadLogo($data['logo']);
        }

        return $this->brandRepository->create($data);
    }

    public function updateBrand(int $id, array $data): bool
    {
        $brand = $this->brandRepository->find($id);
        
        if (!$brand) {
            return false;
        }

        if (isset($data['logo']) && $data['logo']) {
            // Delete old logo
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $data['logo'] = $this->uploadLogo($data['logo']);
        }

        return $this->brandRepository->update($id, $data);
    }

    public function deleteBrand(int $id): bool
    {
        $brand = $this->brandRepository->find($id);
        
        if (!$brand) {
            return false;
        }

        // Delete logo file
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        return $this->brandRepository->delete($id);
    }

    private function uploadLogo($file): string
    {
        return $file->store('brands/logos', 'public');
    }
}