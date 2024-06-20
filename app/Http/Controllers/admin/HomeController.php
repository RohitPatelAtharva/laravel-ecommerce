<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderReturn;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
  public function index()
  {

    $totaleOrders = Order::where('status', '!=', 'cancelled')->count();
    $totalUsers = User::where('role', 1)->count();
    $totalrating = ProductRating::where('status', 1)->count();
    $totalUsers = User::where('role', 1)->count();
    $totalReturn = OrderReturn::count();
    $totalClients = Client::count();
    $totalcancel = Order::where('status','cancelled')->count();
    $totalProducts = Product::count();
    $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('grand_total');
    $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');

    $currentDate = Carbon::now()->format('Y-m-d');
    $revenueThisMonth = Order::where('status', '!=', 'cancelled')
      ->whereDate('created_at', '>=', $startOfMonth)->whereDate('created_at', '<=', $currentDate)
      ->sum('grand_total');

    // last month

    $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
    $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
    $lastMonthName=Carbon::now()->subMonth()->startOfMonth()->format('M');
    $revenueLastMonth = Order::where('status', '!=', 'cancelled')
      ->whereDate('created_at', '>=', $lastMonthStartDate)->whereDate('created_at', '<=', $lastMonthEndDate)
      ->sum('grand_total');

      $lastThirtyDaystartDate=Carbon::now()->subDays(30)->format('Y-m-d');
     
      $revenueLastThirtyDays = Order::where('status', '!=', 'cancelled')
      ->whereDate('created_at', '>=', $lastThirtyDaystartDate)->whereDate('created_at', '<=',  $currentDate)
      ->sum('grand_total');





    // $admin=Auth::guard('admin')->user();
    // echo'home'.$admin->name.'<a href="'.route('admin.logout').'">Logout</a>';
    return view('admin.dashboard', [
      'totalOrders' => $totaleOrders,
      'totalProducts' => $totalProducts,
      'totalUsers' => $totalUsers,
      'totalClients' => $totalClients,
      'totalRevenue' => $totalRevenue,
      'revenueThisMonth' => $revenueThisMonth,
      'revenueLastMonth' => $revenueLastMonth,
      'revenueLastThirtyDays' => $revenueLastThirtyDays,
      'lastMonthName' =>  $lastMonthName,
      'totalrating' => $totalrating,
      'totalReturn' => $totalReturn,
      'totalcancel' => $totalcancel,

    ]);
  }


  public function getDashboardData()
  {
      // Duplicate of your existing code to get data
      $totaleOrders = Order::where('status', '!=', 'cancelled')->count();
      $totalUsers = User::where('role', 1)->count();
      $totalrating = ProductRating::where('status', 1)->count();
      $totalUsers = User::where('role', 1)->count();
      $totalReturn = OrderReturn::count();
      $totalClients = Client::count();
      $totalcancel = Order::where('status', 'cancelled')->count();
      $totalProducts = Product::count();
      $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('grand_total');
      $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');

      $currentDate = Carbon::now()->format('Y-m-d');
      $revenueThisMonth = Order::where('status', '!=', 'cancelled')
          ->whereDate('created_at', '>=', $startOfMonth)->whereDate('created_at', '<=', $currentDate)
          ->sum('grand_total');

      $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
      $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
      $lastMonthName = Carbon::now()->subMonth()->startOfMonth()->format('M');
      $revenueLastMonth = Order::where('status', '!=', 'cancelled')
          ->whereDate('created_at', '>=', $lastMonthStartDate)->whereDate('created_at', '<=', $lastMonthEndDate)
          ->sum('grand_total');

      $lastThirtyDaystartDate = Carbon::now()->subDays(30)->format('Y-m-d');
      $revenueLastThirtyDays = Order::where('status', '!=', 'cancelled')
          ->whereDate('created_at', '>=', $lastThirtyDaystartDate)->whereDate('created_at', '<=', $currentDate)
          ->sum('grand_total');

      return response()->json([
          'totalOrders' => $totaleOrders,
          'totalProducts' => $totalProducts,
          'totalUsers' => $totalUsers,
          'totalClients' => $totalClients,
          'totalRevenue' => $totalRevenue,
          'revenueThisMonth' => $revenueThisMonth,
          'revenueLastMonth' => $revenueLastMonth,
          'revenueLastThirtyDays' => $revenueLastThirtyDays,
          'lastMonthName' => $lastMonthName,
          'totalrating' => $totalrating,
          'totalReturn' => $totalReturn,
          'totalcancel' => $totalcancel,
      ]);
  }


  public function logout()
  {
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login');
  }
}
