<?php
namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Section;

// implement function lk repository
class SectionRepository implements SectionRepositoryInterface 
{     
    public function index()
    {
        $sections=Section::all();
        return view('Dashboard.Sections.index',compact('sections'));
    }
// store
    public function store($request)
    {
        Section::create([
           'name'=>$request->input('name'),
        ]);
        // session to display message
        session()->flash('add');
        return redirect()->route('Sections.index');
    }


// update
    public function update($request){
        // request by hidden id
        $section=Section::findOrFail($request->id);
        $section->update([
            'name'=>$request->input('name'),
        ]);
        session()->flash('edit');
        return redirect()->route('Sections.index');    
    }

    public function show($id){
        // جايين ب اي دي السيكشن وهات الداكاتره بناء علي الاي دي ده
        $doctors =Section::findOrFail($id)->doctors;
        $section = Section::findOrFail($id);
        return view('Dashboard.Sections.show_doctors',compact('doctors','section'));

    }


// destory
    public function destory($request)
    {
        Section::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('Sections.index');
        
    }

}
