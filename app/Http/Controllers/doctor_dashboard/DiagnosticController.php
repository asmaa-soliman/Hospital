<?php

namespace App\Http\Controllers\doctor_dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    private $Diagnosis;

    public function __construct(DiagnosisRepositoryInterface $Diagnosis)
    {
        $this->Diagnosis = $Diagnosis;
    }

    public function index()
    {
    //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->Diagnosis->store($request);
    }
    public function addReview(Request $request)
    {
        return $this->Diagnosis->addReview($request);
    }


    public function show($id)
    {
        return $this->Diagnosis->show($id);
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
