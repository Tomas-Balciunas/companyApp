<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DeleteCompanyAction
{

    public function handle($company)
    {
        if ($company->user_id != Auth::id()) {
            return redirect('/')->with('warning', 'You do not have access to this company!');
        } else {
            $company->delete();
            File::delete(storage_path('app/public/' . $company->logo));
            return redirect('/')->with('message', 'Company ' . $company->name . ' has been removed.');
        }
    }
}
