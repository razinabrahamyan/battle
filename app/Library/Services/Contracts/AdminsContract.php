<?php


namespace App\Library\Services\Contracts;


interface AdminsContract
{
    public function index($page, $id);

    public function store($data);

    public function create($page, $id);

    public function show($page, $id);

    public function edit($page, $id);

    public function update($data, $id);

    public function destroy($id);
}
