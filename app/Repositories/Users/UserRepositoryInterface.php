<?php

namespace App\Repositories\Users;

interface UserRepositoryInterface{
    public function get();
    public function find($id);
    public function create($request,$id);
    public function update($request,$id);

    // public function delete($id); not required
}
