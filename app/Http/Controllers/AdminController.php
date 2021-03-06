<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Jobs\ExportProducts;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index ()
    {
        return view('admin.home');
    }

    public function adminProducts (){
         return view('admin.adminProducts');
    }
     public function adminCategories (){
//        $categories=Category::all();
//         return view('admin.adminCategories', compact('categories'));
    }
     public function adminUsers (){
         $users = User::get();
         return view('admin.adminUsers', compact('users'));

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
    public function exportProducts ()
    {
        $exportColumns = false;
        ExportProducts::dispatch($exportColumns);
        session()->flash('startExportProducts');
        return back();
    }

}
