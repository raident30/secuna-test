<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Programs', [
            'programs' => Program::query()
                ->when(request()->input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10),
            'filters' => request()->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CreateProgram');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name'             => 'required',
            'pentesting_start' => 'required|date_format:Y-m-d H:i:s',
            'pentesting_end'   => 'required|date_format:Y-m-d H:i:s|after:pentesting_start',
        ]);
        
        Program::create([
            'name'             => request()->post('name'),
            'pentesting_start' => request()->post('pentesting_start'),
            'pentesting_end'   => request()->post('pentesting_end'),
            'user_id'          => auth()->id()
        ]);

        return redirect('/programs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return Inertia::render('Program', [
            'program' => $program,
            'reports' => $program->reports
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return Inertia::render('EditProgram', [
            'program' => $program
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $attributes = request()->validate([
            'name'             => 'required',
            'pentesting_start' => 'required|date_format:Y-m-d H:i:s|after:' . date(DATE_ATOM),
            'pentesting_end'   => 'required|date_format:Y-m-d H:i:s|after:pentesting_start',
        ]);
        
        $program->name = request()->post('name');
        $program->pentesting_start = request()->post('pentesting_start');
        $program->pentesting_end = request()->post('pentesting_end');

        $program->save();

        return redirect('/programs/edit/' . $program->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        //delete reports associated with the program
        $program->reports()->delete();

        $program->delete();

        return redirect('/programs');
    }
}
