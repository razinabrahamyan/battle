<?php


namespace App\Library\Services;


use App\Library\Services\Contracts\ReportContract;
use App\Report;

class ReportService implements ReportContract
{
    public function index($page){
        return view($page,['reports' => Report::all()]);
    }

    public function show($page,$id){
        $report = Report::find($id);
        return view($page,['report' => $report]);
    }

}
