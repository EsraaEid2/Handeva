<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customization;
use App\Models\CustomizationOption;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function index()
    {
        $customizations = Customization::with('options')->whereNull('deleted_at')->get();
        return view('admin.customizations.index', compact('customizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'custom_type' => 'required|string|max:255',
            'options' => 'nullable|array',
            'options.*' => 'string|max:255'
        ]);

        $customization = Customization::create($request->only('custom_type'));

        if ($request->has('options')) {
            foreach ($request->options as $optionValue) {
                CustomizationOption::create([
                    'customization_id' => $customization->id,
                    'option_value' => $optionValue,
                ]);
            }
        }

        return redirect()->route('admin.customizations.index')->with('success', 'Customization created successfully.');
    }

    public function update(Request $request, Customization $customization)
    {
        $request->validate([
            'custom_type' => 'required|string|max:255',
            'options' => 'nullable|array',
            'options.*' => 'string|max:255'
        ]);

        $customization->update($request->only('custom_type'));
        \Log::info($customization);
        // dd($customization);
        
        // Update or add options
        if ($request->has('options')) {
            $optionsData = collect($request->options)->map(function ($optionValue) use ($customization) {
                return [
                    'customization_id' => $customization->id,
                    'option_value' => $optionValue,
                ];
            })->toArray();
        // dd($optionsData);
            CustomizationOption::insert($optionsData);
        }
        

        return redirect()->route('admin.customizations.index')->with('success', 'Customization updated successfully.');
    }

    public function destroy(Customization $customization)
    {
        $customization->delete();
        return redirect()->route('admin.customizations.index')->with('success', 'Customization deleted successfully.');
    }
}