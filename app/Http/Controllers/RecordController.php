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
        $payload = $request->only(['date', 'notes']);

        $record = $patient->records()->create($payload);

        for ($i = 1; $i <= 3; $i++) {
            if ($request->file("file{$i}")) {
                $record->attachments()->create([
                    'name' => $request->file("file{$i}")->getClientOriginalName('records'),
                    'path' => $request->file("file{$i}")->storePublicly('records'),
                ]);
            }
        }

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
            'record' => $record->load(['patient', 'attachments']),
        ]);
    }

    public function update(Request $request, Record $record)
    {
        $record->update($request->only(['date', 'notes']));

        for ($i = 1; $i <= 3; $i++) {
            if ($request->file("file{$i}")) {
                $record->attachments()->create([
                    'name' => $request->file("file{$i}")->getClientOriginalName('records'),
                    'path' => $request->file("file{$i}")->storePublicly('records'),
                ]);
            }
        }

        return redirect()->route('patients.show', $record->patient)->with('success', 'Record updated successfully.');
    }
}
