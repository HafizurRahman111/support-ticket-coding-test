<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->load('role');
        $currentUserRole = $user->role->slug;
        // dd($currentUserRole);

        // roles
        $totalRoles = Role::count();
        $activeRoles = Role::where('is_active', 1)->count();
        $inactiveRoles = Role::where('is_active', 0)->count();

        // users
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', 1)->count();
        $inactiveUsers = User::where('is_active', 0)->count();

        // tickets
        if ($currentUserRole == 'admin') {
            $totalTickets = Ticket::count();
            $openTickets = Ticket::where('status', 1)->count();
            $closedTickets = Ticket::where('status', 2)->count();
        } else {
            $userId = auth()->user()->id;

            $totalTickets = Ticket::where('user_id', $userId)->count();
            $openTickets = Ticket::where('user_id', $userId)->where('status', 1)->count();
            $closedTickets = Ticket::where('user_id', $userId)->where('status', 2)->count();
        }

        $roles =  [
            'title' => 'Roles',
            'icon' => 'fas fa-user-shield',
            'total' => $totalRoles,
            'active' => $activeRoles,
            'inactive' => $inactiveRoles,
            'link' => '',
            'color' => 'primary',
        ];

        $users =  [
            'title' => 'Users',
            'icon' => 'fas fa-users',
            'total' => $totalUsers,
            'active' => $activeUsers,
            'inactive' =>  $inactiveUsers,
            'link' => '',
            'color' => 'success',
        ];

        $tickets =  [
            'title' => 'Tickets',
            'icon' => 'fas fa-ticket-alt',
            'total' => $totalTickets,
            'active' => $openTickets,
            'inactive' =>  $closedTickets,
            'link' => route('tickets.index'),
            'color' => 'warning',
        ];

        if ($currentUserRole == 'admin') {
            $cardsData[] = $roles;
            $cardsData[] = $users;
        }

        $cardsData[] = $tickets;

        return view('dashboard', [
            'user' => $user,
            'currentUserRole' => $currentUserRole,
            'cardsData' => $cardsData,
        ]);
    }
}