<?php
namespace App\Repository\doctor_dashboard;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class InvoicesRepository implements InvoicesRepositoryInterface
{

    // ممكن نمرر للانديكس الاي دي كبراميتر ونقارن بينهم يعني نعملها كويرى واحد
    // تحت الاجراء
    public function index()
    {
        // $invoices = Invoice::with(['Service', 'Group', 'Patient'])
        //            ->where('doctor_id', Auth::user()->id)
        //            ->where('invoice_status', 1)
        //            ->get();
        //  return $invoices;
        // get koshofat where id to doctor = id elley fatah
        $invoices = Invoice::with(['Service', 'Group', 'Patient'])
        ->where('doctor_id',  Auth::user()->id)
        ->where('invoice_status',1)->get();
        return view('Dashboard.Doctor.invoices.index',compact('invoices'));
    }
       //  المراجعات
     public function reviewInvoices()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 2)->get();
        return view('Dashboard.Doctor.invoices.review_invoices', compact('invoices'));
    }
       //  الفواتير المكتملة
    public function completedInvoices()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 3)->get();
        return view('Dashboard.Doctor.invoices.completed_invoices', compact('invoices'));
    }
    // show elasha
    public function show($id){
        // query in database
        $rays=Ray::findorFail($id);
        if($rays->doctor_id !=auth()->user()->id){
            return redirect()->route('404');
             //abort(404);
        }
        return view('Dashboard.Doctor.invoices.view_rays', compact('rays'));
    }
    public function showLaboratorie($id)
    {
        $laboratories = Laboratorie::findorFail($id);
        if($laboratories->doctor_id !=auth()->user()->id){
            //abort(404);
            return redirect()->route('404');
        }
        return view('Dashboard.Doctor.invoices.view_laboratories', compact('laboratories'));
    }

}
