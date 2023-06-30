<?php


namespace App\Library\Services\Contracts;


interface UserContract
{
    public function index($page, $param);

    public function store($data);

    public function create($page);

    public function show($page, $id);

    public function edit($page, $id);

    public function update($data, $id);

    public function changeStatus($data);

}
