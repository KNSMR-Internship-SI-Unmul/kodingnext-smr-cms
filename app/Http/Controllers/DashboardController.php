<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Promotion;
use App\Models\Event;
use App\Models\StudentProject;
use App\Models\CourseType;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = User::whereHas('role', function ($query) {
            $query->whereNotIn('name', ['Admin', 'Owner', 'Super Admin']); 
        })->count();
        $totalPromotions = Promotion::count();
        $totalEvents = Event::count();
        $totalStudentProjects = StudentProject::count();

        $courseTypes = CourseType::orderBy('id')->get();

        return view('pages.dashboard', compact(
            'totalEmployees',
            'totalPromotions',
            'totalEvents',
            'totalStudentProjects',
            'courseTypes'
        ));
    }
}
