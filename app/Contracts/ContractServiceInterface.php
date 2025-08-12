<?php

namespace App\Contracts;

use App\Models\Booking;
use App\Models\BookingContract;

interface ContractServiceInterface
{
    public function generateContract(Booking $booking): BookingContract;
    public function getContractPath(BookingContract $contract): string;
}