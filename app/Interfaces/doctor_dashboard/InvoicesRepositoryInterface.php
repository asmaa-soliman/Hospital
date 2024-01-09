<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{
    // get doc invoice
    public function index();
    public function completedInvoices();
    public function reviewInvoices();
    public function show($id);
    public function showLaboratorie($id);


}
