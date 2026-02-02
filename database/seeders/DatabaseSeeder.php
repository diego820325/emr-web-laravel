<?php

namespace Database\Seeders;

use App\Models\CustomAttribute;
use App\Models\CustomAttributeOption;
use App\Models\CustomAttributeType;
use App\Models\Patient;
use App\Models\Record;
use App\Models\Section;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Text',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Text')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Paragraph',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Paragraph')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Html',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Html')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Number',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Number')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Boolean',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Boolean')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Date',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Date')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'DateTime',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'DateTime')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        $dropdown = CustomAttribute::factory()->create([
            'question' => 'Dropdown Example',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Dropdown')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $dropdown->id,
            'text' => 'Option 1',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $dropdown->id,
            'text' => 'Option 2',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $dropdown->id,
            'text' => 'Option 3',
        ]);

        $radios = CustomAttribute::factory()->create([
            'question' => 'Radios Example',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Radios')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $radios->id,
            'text' => 'Option 1',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $radios->id,
            'text' => 'Option 2',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $radios->id,
            'text' => 'Option 3',
        ]);

        $checkboxes = CustomAttribute::factory()->create([
            'question' => 'Checkboxes Example',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Checkboxes')->first()->id,
            'section_id' => Section::where('name', 'Clientes')->first()->id,
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $checkboxes->id,
            'text' => 'Option 1',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $checkboxes->id,
            'text' => 'Option 2',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $checkboxes->id,
            'text' => 'Option 3',
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Text',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Text')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Paragraph',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Paragraph')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Html',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Html')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Number',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Number')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Boolean',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Boolean')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'Date',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Date')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttribute::factory()->create([
            'question' => 'DateTime',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'DateTime')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        $dropdown = CustomAttribute::factory()->create([
            'question' => 'Dropdown Example',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Dropdown')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $dropdown->id,
            'text' => 'Option 1',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $dropdown->id,
            'text' => 'Option 2',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $dropdown->id,
            'text' => 'Option 3',
        ]);

        $radios = CustomAttribute::factory()->create([
            'question' => 'Radios Example',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Radios')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $radios->id,
            'text' => 'Option 1',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $radios->id,
            'text' => 'Option 2',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $radios->id,
            'text' => 'Option 3',
        ]);

        $checkboxes = CustomAttribute::factory()->create([
            'question' => 'Checkboxes Example',
            'custom_attribute_type_id' => CustomAttributeType::where('name', 'Checkboxes')->first()->id,
            'section_id' => Section::where('name', 'Notas')->first()->id,
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $checkboxes->id,
            'text' => 'Option 1',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $checkboxes->id,
            'text' => 'Option 2',
        ]);

        CustomAttributeOption::factory()->create([
            'custom_attribute_id' => $checkboxes->id,
            'text' => 'Option 3',
        ]);

        Patient::factory(100)->has(Record::factory()->count(5))->create();
    }
}
