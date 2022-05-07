<?php

namespace App\Actions;

use Illuminate\Support\Facades\File;

class UpdateCompanyAction
{

    public function handle($request, $company, $id)
    {
        $fileName = $company->logo;

        $request->validate([
            'name' => 'required|max:255|unique:companies,name,' . $id,
            'email' => 'required|email',
            'address' => 'nullable|min:2|max:255',
            'logo' => 'nullable|image|mimes:png,jpeg|max:4096',
        ]);

        if ($request->hasFile('logo') && !$request->has('checked')) {
            File::delete(storage_path('app/public/' . $company->logo));
            $path = $request->file('logo')->store('public/logo');
            $fileName = str_replace('public/', "", $path);
        } elseif ($request->has('checked')) {
            File::delete(storage_path('app/public/' . $company->logo));
            $fileName = null;
        }

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'logo' => $fileName
        ]);
    }
}
