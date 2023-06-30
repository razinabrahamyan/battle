<?php


namespace App\Library\Services\Contracts;


interface ReportContract
{
    public function index($page);

    public function show($page, $id);
}
