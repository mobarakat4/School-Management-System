<?php

namespace App\Repositories\Users;

interface UserRepositoryInterface{
    public function find($id);
    public function create($request);
    public function update($request,$id);

    // public function delete($id); not required
}
