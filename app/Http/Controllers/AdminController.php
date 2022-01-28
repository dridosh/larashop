<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index ()
    {
        $users = User::get();
        return view('admin.home', compact('users'));
    }

    public function enterAsUser ($userId)
    {
        Auth::loginUsingId($userId);
        return redirect()->route('home');
    }

    public function exportCategories ()
    {
        $exportColumns = false;
        ExportCategories::dispatch($exportColumns);
        session()->flash('startExportCategories');
        return back();
    }
}
