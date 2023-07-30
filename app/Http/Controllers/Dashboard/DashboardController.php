<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bisyorjoniba;
use App\Models\Dujoniba;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $dujonibaCount = Dujoniba::count();
        $bisyorCount = Bisyorjoniba::count();
        $ijronashudaD = Dujoniba::where('sanai_etibor', '=', null)->count();
        $ijronashudaB = Bisyorjoniba::where('sanai_etibor', '=', null)->count();
        $ijronashuda = $ijronashudaD+$ijronashudaB;
        //dd($users);
        return Inertia::render('Dash/DashItems',[
          'users'=>$users,
            'dujonibaCount'=>$dujonibaCount,
            'bisyorCount'=>$bisyorCount,
            'ijronashuda'=>$ijronashuda,
        ]);
    }
}
