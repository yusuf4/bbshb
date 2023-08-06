<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bisyorjoniba;
use App\Models\Dujoniba;
use App\Models\NamudiShartnoma;
use App\Models\NomeriShartnoma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::count();
        $dujonibaCount = Dujoniba::count();
        $shumoraD = Dujoniba::query()
            ->when($request->formValues, function ($query, $formValues)  use ($request){
                if($formValues['datefrom']!=null && $formValues['dateto']!=null && $formValues['namud']=='1'){
                   return $query->whereBetween('created_at', [Carbon::createFromFormat('d.m.Y',$formValues['datefrom'])->format('Y-m-d'), Carbon::createFromFormat('d.m.Y',$formValues['dateto'])->format('Y-m-d')])->count();
                }
            });
        $shumoraB = Bisyorjoniba::query()
            ->when($request->formValues, function ($query, $formValues)  use ($request){
                if($formValues['datefrom']!=null && $formValues['dateto']!=null && $formValues['namud']=='2'){
                    return $query->whereBetween('created_at', [Carbon::createFromFormat('d.m.Y',$formValues['datefrom'])->format('Y-m-d'), Carbon::createFromFormat('d.m.Y',$formValues['dateto'])->format('Y-m-d')])->count();
                }
            });
//        $namud = Dujoniba::withCount('namudiShartnoma')->get();
//       // dd($namud);
        $bisyorCount = Bisyorjoniba::count();
        $ijronashudaD = Dujoniba::where('sanai_etibor', '=', null)->count();
        $ijronashudaB = Bisyorjoniba::where('sanai_etibor', '=', null)->count();
        $ijronashuda = $ijronashudaD+$ijronashudaB;
        return Inertia::render('Dash/DashItems',[
          'users'=>$users,
            'dujonibaCount'=>$dujonibaCount,
            'bisyorCount'=>$bisyorCount,
            'ijronashuda'=>$ijronashuda,
            'shumoraD'=>$shumoraD,
            'shumoraB'=>$shumoraB,
            //'namud'=>$namud
        ]);
    }
}
