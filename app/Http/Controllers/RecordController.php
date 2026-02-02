<?php

namespace App\Http\Controllers;

use App\Models\CustomAttribute;
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
            'customAttributes' => CustomAttribute::where('section_id', 2)->with('options')->get(),
        ]);
    }

    public function store(Request $request, Patient $patient)
    {
        $payload = $request->only(['date', 'notes']);

        $record = $patient->records()->create($payload);

        foreach ($request->except(['date', 'notes']) as $attributeId => $formValue) {
            $attribute = CustomAttribute::find($attributeId);

            $values = is_array($formValue) ? $formValue : [$formValue];

            foreach ($values as $value) {
                $attributeValue = [
                    'custom_attribute_id' => $attributeId,
                    'string_value' => $attribute->custom_attribute_type_id == 1 ? $value : null,
                    'text_value' => $attribute->custom_attribute_type_id == 2 ? $value : null,
                    'long_text_value' => $attribute->custom_attribute_type_id == 3 ? $value : null,
                    'number_value' => $attribute->custom_attribute_type_id == 4 ? $value : null,
                    'boolean_value' => $attribute->custom_attribute_type_id == 5 ? $value : null,
                    'date_value' => $attribute->custom_attribute_type_id == 6 ? $value : null,
                    'date_time_value' => $attribute->custom_attribute_type_id == 7 ? $value : null,
                    'custom_attribute_option_id' => $attribute->custom_attribute_type_id > 7 ? $value : null,
                ];

                $record->customAttributeValues()->create($attributeValue);
            }
        }

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
