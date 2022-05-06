<?php

namespace App\Http\Controllers;

use App\Mail\AppNotif;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Exception;

class CompanyController extends Controller
{
    public function home()
    {
        $companies = Company::where(['user_id' => Auth::id()])->paginate(5);
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
        $email = Auth::user()->user_email;

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

        $text = 'Company ' . $request->name . ' has been added to your list.';

        try {
            Mail::to($email)->send(new AppNotif($text));
            return back()->with('message', 'Company ' . $request->name . ' has been added to your list. Notification email has been sent.');
        } catch (\Exception $e) {
            return back()->with('message', 'Company ' . $request->name . ' has been added to your list. Notification email could not be sent due to an error.'); // . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $company = Company::where(['id' => $id])->first();
        $fileName = $company->logo;
        if ($company->user_id != Auth::id()) {
            return redirect('/');
        } else {
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

            Company::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'logo' => $fileName
            ]);

            return redirect('/')->with('message', 'Company ' . $request->name . ' has been updated!');
        }
    }

    public function delete($id)
    {
        $company = Company::where(['id' => $id])->first();
        if ($company->user_id != Auth::id()) {
            return redirect('/');
        } else {
            Company::where('id', $id)->delete();
            File::delete(storage_path('app/public/' . $company->logo));
            return redirect('/')->with('message', 'Company ' . $company->name . ' has been removed.');
        }
    }
}
