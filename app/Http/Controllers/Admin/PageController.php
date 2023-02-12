<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showDashboard()
    {
        $todayIncomeCount = Income::whereDay('created_at', date('d'))->sum('amount');
        $todayOutcomeCount = Outcome::whereDay('created_at', date('d'))->sum('amount');
        $userCount = User::count();
        $productCount = Product::count();

        //for sale data
        $months = [];
        $yearMonth = [];

        //for income outcome data
        $dayMonth = [];
        $dayMonthData = [];

        for ($i = 0; $i <= 5; $i++) {
            //for sale data
            $months[] = date('F', strtotime("-$i month"));
            $yearMonth[] = [
                'year' => date('Y', strtotime("-$i month")),
                'month' => date('m', strtotime("-$i month"))
            ];

            //for income outcoem data
            $dayMonth[] = date('F d', strtotime("-$i day"));
            $dayMonthData[] = [
                'month' => date('m', strtotime("-$i day")),
                'day' => date('d', strtotime("-$i day"))
            ];
        }

        $saleData = [];

        //sale data
        foreach ($yearMonth as $ym) {
            $saleData[] = ProductOrder::whereYear('created_at', $ym['year'])->whereMonth('created_at', $ym['month'])->count();
        }

        $incomeData = [];
        $outcomeData = [];
        //income outcome data
        foreach ($dayMonthData as $dm) {
            $incomeData[] = Income::whereDay('created_at', $dm['day'])->whereMonth('created_at', $dm['month'])->sum('amount');
            $outcomeData[] = Outcome::whereDay('created_at', $dm['day'])->whereMonth('created_at', $dm['month'])->sum('amount');
        }

        $latestUser = User::latest()->take(5)->get();
        $lowProduct = Product::latest()->take(5)->where('total_quantity', '<', '3')->get();
        // return $latestUser;

        return view(
            'admin.dashboard',
            compact('todayIncomeCount', 'todayOutcomeCount', 'userCount', 'productCount', 'months', 'saleData', 'dayMonth', 'incomeData', 'outcomeData', 'latestUser', 'lowProduct')
        );
    }
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $cre = request()->only('email', 'password');

        if (auth()->guard('admin')->attempt($cre)) {
            return redirect('/admin')->with('success', 'Welcome Admin');
        }

        return redirect()->back()->with('error', "Email and password dun match!");
    }
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/');
    }
}
