<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Report;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Program $program)
    {
        return Inertia::render('CreateReport', [
            'program' => $program
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $attributes = request()->validate([
            'title'    => 'required',
            'severity' => 'required',
            'status'   => 'required',
        ]);

        $program = Program::find(request()->post('program_id'));

        $program->reports()->create([
            'title'       => request()->post('title'),
            'severity'    => request()->post('severity'),
            'status'      => request()->post('status'),
            'description' => request()->post('description'),
        ]);

        return redirect('/program/' . $program->id);
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
    public function update(Request $request, string $id)
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
