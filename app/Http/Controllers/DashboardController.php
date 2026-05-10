<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return $this->adminDashboard();
        }

        return $this->userDashboard();
    }

    public function adminDashboard()
    {
        $placesCount = Place::count();
        $usersCount = User::count();
        $totalVisitors = Place::sum('visitors');
        $averageRating = Place::avg('rating');
        $recentPlaces = Place::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        $places = Place::all();

        return view('dashboard.admin', compact(
            'placesCount',
            'usersCount',
            'totalVisitors',
            'averageRating',
            'recentPlaces',
            'recentUsers',
            'places'
        ));
    }

    public function userDashboard()
    {
        $placesCount = Place::count();
        $favoritesCount = 0; // Will be implemented with favorites feature
        $reviewsCount = 0; // Will be implemented with reviews feature
        $visitedCount = 0; // Will be implemented with visited tracking

        $featuredPlaces = Place::where('rating', '>=', 4.0)
                              ->inRandomOrder()
                              ->take(12)
                              ->get();

        // Category counts
        $mountainCount = Place::where('category', 'Gunung')->count();
        $lakeCount = Place::where('category', 'Danau')->count();
        $forestCount = Place::where('category', 'Hutan')->count();
        $waterfallCount = Place::where('category', 'Air Terjun')->count();
        $campingCount = Place::where('category', 'Camping')->count();

        $recentActivity = collect(); // Placeholder for recent activity - will be implemented later

        return view('dashboard.user', compact(
            'placesCount',
            'favoritesCount',
            'reviewsCount',
            'visitedCount',
            'featuredPlaces',
            'mountainCount',
            'lakeCount',
            'forestCount',
            'waterfallCount',
            'campingCount',
            'recentActivity'
        ));
    }
}
