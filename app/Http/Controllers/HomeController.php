<?php

namespace App\Http\Controllers;

use App\Company;
use App\Course;
use App\Repertoire;
use App\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $repertoire = Repertoire::where('time', '>', (string)now())->get()->sortBy('time');
        return view('home', compact('repertoire'));
    }

    public function about()
    {
        $company = Company::first();
        return view('about', compact('company'));
    }

    public function courses()
    {
        $courses = Course::all();
        return view('courses', compact('courses'));
    }

    public function team()
    {
        $teachers = User::where('role_id', 2)
            ->get()
            ->sortBy(function ($query) {
                return $query->teacher->surname;
            });;
        return view('team', compact('teachers'));
    }

    public function repertoire()
    {
        $repertoire = Repertoire::where('time', '>', (string)now())->get()->sortBy('time');
        return view('repertoire', compact('repertoire'));
    }

    public function blogs()
    {
        return view('blogs');
    }

    public function blog($id)
    {
        return view('blog');
    }

    public function contact()
    {
        $company = Company::first();
        return view('contact', compact('company'));
    }
}
