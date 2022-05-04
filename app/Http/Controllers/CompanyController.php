<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function home()
    {
        $companies = Company::where(['user_id' => Auth::id()])->get();
        return view('blades.home', compact('companies'));
    }

    public function edit($id)
    {
        $company = Company::where(['id' => $id])->first();
        if ($company->user_id != Auth::id()) {
            return redirect('/')->with('warning', 'You do not have access to this company!');
        } else {
            return view('blades.edit', compact('company'));
        }
    }

    public function addCompany(Request $request)
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

        return back();
    }

    public function update(Request $request, $id)
    {
        $company = Company::where(['id' => $id])->first();
        $fileName = $company->logo;
        if ($company->user_id != Auth::id()) {
            return redirect('/');
        } else {
            $request->validate([
                'name' => 'required|max:255|unique:companies,name,'.$id,
                'email' => 'required|email',
                'address' => 'nullable|min:2|max:255',
                'logo' => 'nullable|image|mimes:png,jpeg|max:4096',
            ]);

            if ($request->hasFile('logo') && !$request->has('checked')) {
                File::delete(storage_path('app/public'.$company->path));
                $path = $request->file('logo')->store('public/logo');
                $fileName = str_replace('public/', "", $path);
            } elseif ($request->has('checked')) {
                File::delete(storage_path('app/public'.$company->path));
                $fileName = null;
            }

            Company::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'logo' => $fileName
            ]);

            return redirect('/')->with('message', 'Company '.$request->name.' has been updated!');
        }
    }

    public function delete ($id) {
        $company = Company::where(['id' => $id])->first();
        if ($company->user_id != Auth::id()) {
            return redirect('/');
        } else {
            Company::where('id', $id)->delete();
            return redirect('/')->with('message', 'Company '. $company->name .' has been removed.');
        }
    }
}
