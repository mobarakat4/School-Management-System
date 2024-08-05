<?php

namespace App\Http\Controllers\Web\Admin\SchoolManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GradeLevelRequest;
use App\Services\Admin\GradeLevelService;
use Illuminate\Http\Request;

class GradeLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $grade;
    public function __construct(GradeLevelService $grade){
        $this->grade = $grade;
    }
    public function index()
    {
        $levels = $this->grade->index();
        dd($levels);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeLevelRequest  $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeLevelRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
