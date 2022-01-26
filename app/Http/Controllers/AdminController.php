<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
=======
use App\Jobs\ExportCategories;
>>>>>>> laravel
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index ()
    {
        $users = User::get();
        return view('admin.home', compact('users'));
    }

<<<<<<< HEAD
    public function enterAsUser ($userId) {
        Auth::loginUsingId($userId);
        return redirect()->route('home');
    }
=======
    public function enterAsUser ($userId)
    {
        Auth::loginUsingId($userId);
        return redirect()->route('home');
    }

    public function exportCategories ()
    {
        ExportCategories::dispatch();
        session()->flash('startExportCategories');
        return back();
    }
>>>>>>> laravel
}
