<?php

namespace App\Http\Controllers\Web\Admin\SchoolManage;

use App\Http\Controllers\Controller;
use App\Services\Admin\ClassService;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $class;
    public function __construct(ClassService $class){
        $this->class = $class;

    }
    public function index()
    {
        $res = $this->class->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->class->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->class->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = $this->class->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = $this->class->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->class->delete($id);
    }
}
