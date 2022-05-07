<?php

namespace App\Http\Controllers;

use App\Actions\CreateCompanyAction;
use App\Actions\DeleteCompanyAction;
use App\Actions\UpdateCompanyAction;
use App\Mail\AppNotif;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Exception;

class CompanyController extends Controller
{
    public function homeView()
    {
        $companies = Company::where(['user_id' => Auth::id()])->orderBy('created_at', 'desc')->paginate(5);
        return view('blades.home', compact('companies'));
    }

    public function editView($id)
    {
        $company = $this->company($id);

        if ($company->user_id != Auth::id()) {
            return redirect('/')->with('warning', 'You do not have access to this company!');
        } else {
            return view('blades.edit', compact('company'));
        }
    }

    public function addCompany(Request $request, CreateCompanyAction $action)
    {
        $email = Auth::user()->user_email;
        $text = 'Company ' . $request->name . ' has been added to your list.';

        $action->handle($request);

        try {
            Mail::to($email)->send(new AppNotif($text));
            return back()->with('message', 'Company ' . $request->name . ' has been added to your list. Notification email has been sent.');
        } catch (\Exception $e) {
            return back()->with('message', 'Company ' . $request->name . ' has been added to your list. Notification email could not be sent due to an error.'); // . $e->getMessage());
        }
    }

    public function update(Request $request, UpdateCompanyAction $action, $id)
    {
        $company = $this->company($id);

        if ($company->user_id != Auth::id()) {
            return redirect('/');
        } else {
            $action->handle($request, $company, $id);
            return redirect('/')->with('message', 'Company ' . $request->name . ' has been updated!');
        }
    }

    public function delete(DeleteCompanyAction $action, $id)
    {
        $company = $this->company($id);
        return $action->handle($company);
    }

    private function company($id)
    {
        return Company::where(['id' => $id])->first();
    }
}
