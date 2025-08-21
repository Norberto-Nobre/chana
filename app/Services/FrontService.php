<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Contracts\VehicleModelRepositoryInterface;
use App\Contracts\VehicleRepositoryInterface;
use App\Repositories\BrandRepository;

class FrontService{

    protected $vehicleModelRepository;
    protected $vehicleRepository;
    protected $brandRepository;

    public function __construct(VehicleRepositoryInterface $vehicleRepository, VehicleModelRepositoryInterface $vehicleModelRepository, BrandRepository $brandRepository){

        $this->vehicleModelRepository = $vehicleModelRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->brandRepository = $brandRepository;


    }

    public function searchVehicle(int $id){
        return $this->vehicleRepository->find($id);
    }

    public function getFrontPageData(){
        $vehicleModels = $this->vehicleModelRepository->getActive();
        $vehicles = $this->vehicleRepository->getAllVehicles();
        $brand = $this->brandRepository->getActive();
        // $vehicle = $this->vehicleRepository->find('id');

        return compact('vehicleModels', 'vehicles', 'brand');
    }
}
