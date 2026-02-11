<?php

namespace App\Http\Controllers;

use App\Models\CustomAttribute;
use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        $data = [
            'patients' => Patient::all(),
        ];

        return Inertia::render('Patients/Index', $data);
    }

    public function show(Patient $patient)
    {
        return Inertia::render('Patients/Show', [
            'customAttributes' => CustomAttribute::where('section_id', 1)->get(),
            'recordCustomAttributes' => CustomAttribute::where('section_id', 2)->get(),
            'patient' => $patient->load([
                'records.attachments',
                'customAttributeValues.customAttribute',
                'customAttributeValues.customAttributeOption',
                'records.customAttributeValues.customAttribute',
                'records.customAttributeValues.customAttributeOption'
            ]),
        ]);
    }

    public function create()
    {
        $data = [
            'customAttributes' => CustomAttribute::where('section_id', 1)->with('options')->get(),
        ];

        return Inertia::render('Patients/Create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $patient = Patient::create($request->only(['name', 'phone', 'email', 'notes']));

        foreach ($request->except(['name', 'phone', 'email', 'notes']) as $attributeId => $formValue) {
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

                $patient->customAttributeValues()->create($attributeValue);
            }
        }

        return redirect()->route('patients.index');
    }

    public function edit(Patient $patient)
    {
        return Inertia::render('Patients/Edit', [
            'customAttributes' => CustomAttribute::where('section_id', 1)->with('options')->get(),
            'patient' => $patient->load(['customAttributeValues.customAttribute', 'customAttributeValues.customAttributeOption']),
        ]);
    }

    public function update(Patient $patient, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $patient->update($request->only(['name', 'phone', 'email', 'notes']));

        $patient->customAttributeValues()->delete();

        foreach ($request->except(['name', 'phone', 'email', 'notes']) as $attributeId => $formValue) {
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

                $patient->customAttributeValues()->create($attributeValue);
            }
        }

        return redirect()->route('patients.show', $patient);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index');
    }
}
