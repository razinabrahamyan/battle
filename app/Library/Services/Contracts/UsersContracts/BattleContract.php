<?php


namespace App\Library\Services\Contracts\UsersContracts;


interface BattleContract
{
    public function store($data);

    public function create($data,$opponent);

    public function index($page);

    public function show($page, $id ,$request);

    public function edit($page, $id);

    public function update($data, $id);

    public function destroy($id);
}
