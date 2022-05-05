<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Exception;

class RecentController extends Controller
{
    public function recent()
    {
        try {
            $recent = Company::select('name', 'logo')->orderBy('created_at', 'desc')->limit(5)->get();
            return json_encode($recent);
        } catch (Exception $e) {
            return response()->json(['error' => 'Unable to fetch data'], 404);
        }
    }
}
