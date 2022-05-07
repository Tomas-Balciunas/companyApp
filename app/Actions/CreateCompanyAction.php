<?php

namespace App\Actions;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CreateCompanyAction
{

    public function handle($request)
    {
        $request->validate([
            'name' => 'required|unique:companies|max:255',
            'email' => 'required|email',
            'address' => 'nullable|min:2|max:255',
            'logo' => 'nullable|image|mimes:png,jpeg|max:4096',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public/logo');
            $fileName = str_replace('public/', "", $path);
        } else {
            $fileName = null;
        }

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'logo' => $fileName,
            'user_id' => Auth::id()
        ]);
    }
}