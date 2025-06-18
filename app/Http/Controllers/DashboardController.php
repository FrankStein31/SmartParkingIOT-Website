<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get dashboard statistics


        // Get recent activities (you can customize this based on your needs)
        $recent_activities = [
            [
                'icon' => 'bi-person-plus',
                'color' => 'primary',
                'title' => 'New user registered',
                'description' => 'John Doe created a new account',
                'time' => '2 minutes ago'
            ],
            [
                'icon' => 'bi-cart-check',
                'color' => 'success',
                'title' => 'Order completed',
                'description' => 'Order #12345 has been completed',
                'time' => '15 minutes ago'
            ],
            [
                'icon' => 'bi-exclamation-triangle',
                'color' => 'warning',
                'title' => 'System alert',
                'description' => 'Server memory usage is high',
                'time' => '1 hour ago'
            ],
            [
                'icon' => 'bi-upload',
                'color' => 'info',
                'title' => 'File uploaded',
                'description' => 'New product images uploaded',
                'time' => '2 hours ago'
            ]
        ];

        return view('admin.dashboard', compact('recent_activities'));
    }
}