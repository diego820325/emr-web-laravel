<?php

namespace App\Http\Controllers;

use App\Models\CustomAttribute;
use App\Models\CustomAttributeType;
use App\Models\Section;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomAttributeController extends Controller
{
    public function index(Section $section)
    {
        $data = [
            'section' => $section,
            'customAttributes' => $section->customAttributes()->with(['customAttributeType', 'options'])->get(),
        ];

        return Inertia::render('settings/custom-attributes/Index', $data);
    }

    public function create(Section $section)
    {
        $data = [
            'section' => $section,
            'types' => CustomAttributeType::all(),
        ];

        return Inertia::render('settings/custom-attributes/Create', $data);
    }

    public function store(Section $section, Request $request)
    {
        $attribute = CustomAttribute::create([
            'section_id' => $section->id,
            'question' => $request->question,
            'custom_attribute_type_id' => $request->custom_attribute_type_id,
        ]);

        if ($request->custom_attribute_type_id >= 8) {
            foreach ($request->options as $option) {
                if (!empty($option)) {
                    $attribute->options()->create([
                        'text' => $option,
                    ]);
                }
            }
        }

        return redirect()->route('custom-attributes.index', $section);
    }

    public function edit(Section $section, CustomAttribute $customAttribute)
    {
        $data = [
            'section' => $section,
            'customAttribute' => $customAttribute->load('options'),
            'types' => CustomAttributeType::all(),
        ];

        return Inertia::render('settings/custom-attributes/Edit', $data);
    }

    public function update(Section $section, CustomAttribute $customAttribute, Request $request)
    {
        $customAttribute->update([
            'question' => $request->question,
            'custom_attribute_type_id' => $request->custom_attribute_type_id,
        ]);

        $customAttribute->options()->delete();

        if ($request->custom_attribute_type_id >= 8) {
            foreach ($request->options as $option) {
                if (!empty($option)) {
                    $customAttribute->options()->create([
                        'text' => $option,
                    ]);
                }
            }
        }

        return redirect()->route('custom-attributes.index', $section);
    }

    public function destroy(Section $section, CustomAttribute $customAttribute)
    {
        $customAttribute->delete();

        return redirect()->route('custom-attributes.index', $section);
    }
}
