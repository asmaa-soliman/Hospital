<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptAccountController extends Controller
{
    // design pattern لازم اضمن interface
    private $Receipt;

    public function __construct(ReceiptRepositoryInterface  $Receipt)
    {
        $this->Receipt = $Receipt;
    }
    public function index()
    {
        return $this->Receipt->index();
    }


    public function create()
    {
        return $this->Receipt->create();
    }


    public function store(Request $request)
    {
        return $this->Receipt->store($request);
    }



    public function edit($id)
    {
        return $this->Receipt->edit($id);
    }

    public function show($id)
    {
        return $this->Receipt->show($id);
    }


    public function update(Request $request)
    {
        return $this->Receipt->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->Receipt->destroy($request);
    }
}
