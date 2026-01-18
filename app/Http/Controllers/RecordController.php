<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Record;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecordController extends Controller
{
    public function create(Patient $patient)
    {
        return Inertia::render('Records/Create', [
            'patient' => $patient,
        ]);
    }

    public function store(Request $request, Patient $patient)
    {
        $patient->records()->create($request->all());

        return redirect()->route('patients.show', $patient)->with('success', 'Record created successfully.');
    }

    public function destroy(Record $record)
    {
        $patient = $record->patient;
        $record->delete();

        return redirect()->route('patients.show', $patient)->with('success', 'Record deleted successfully.');
    }

    public function edit(Record $record)
    {
        return Inertia::render('Records/Edit', [
            'record' => $record->load('patient'),
        ]);
    }

    public function update(Request $request, Record $record)
    {
        $record->update($request->all());

        return redirect()->route('patients.show', $record->patient)->with('success', 'Record updated successfully.');
    }
}
