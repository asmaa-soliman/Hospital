<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Sections\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $Sections;
  
    public function __construct(SectionRepositoryInterface $Sections)
    {
        $this->Sections = $Sections;
    }
   
    public function index()
    {
        // call method
       return $this->Sections->index();
    }

    public function show($id)
    {
        // call method
       return $this->Sections->show($id);;
    }


    
    public function store(Request $request)
    {
        return $this->Sections->store($request);
         
    }

   
    public function update(Request $request)
    {
        return $this->Sections->update($request);
    }

    
    public function destroy(Request $request)
    {
        return $this->Sections->destory($request);
    }
}
