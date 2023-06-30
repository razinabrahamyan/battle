<?php


namespace App\Library\Services\Contracts;


interface BattlesContract
{
    public function index($page);

    public function show($page, $id);

    public function edit($page, $id);

    public function update($data, $id);

    public function destroy($id);

    public function changeVerify($data);
}
