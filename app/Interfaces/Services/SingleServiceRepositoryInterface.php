<?php
namespace App\Interfaces\Services;


interface SingleServiceRepositoryInterface
{
    // get all sections 
    public function index();

    public function store($request);

    public function update($request);

    public function destory($request);


  
}