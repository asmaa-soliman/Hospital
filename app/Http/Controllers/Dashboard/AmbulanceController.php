<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AmbulanceRequest;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    private $Ambulance;

    public function __construct(AmbulanceRepositoryInterface $Ambulance)
    {
        $this->Ambulance = $Ambulance;
    }

    public function index()
    {
        return $this->Ambulance->index();
    }


    public function create()
    {
        return $this->Ambulance->create();
    }


    public function store(AmbulanceRequest $request)
    {
        return $this->Ambulance->store($request);
    }

}
