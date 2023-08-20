<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bisyorjoniba;
use App\Models\Country;
use App\Models\Dujoniba;
use App\Models\Ezoh;
use App\Models\NamudiShartnoma;
use App\Models\NomeriShartnoma;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $countries=Country::select('id', 'name')
            ->withCount('bisyorjonibas')
            ->orderBy('bisyorjonibas_count', 'DESC')
            ->get();
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        $bisyorCount = Bisyorjoniba::count();
        $ijronashudaD = Dujoniba::where('sanai_etibor', '=', null)->count();
        $ijronashudaB = Bisyorjoniba::where('sanai_etibor', '=', null)->count();
        $ijronashuda = $ijronashudaD+$ijronashudaB;
        $maorif = Ezoh::query()
            ->select('id', 'name')
            ->where('id',1)
            ->withCount('dujonibaE', 'bisyorjonibaE')
            ->get();
        $iqtisod = Ezoh::query()
            ->select('id', 'name')
            ->where('id',2)
            ->withCount('dujonibaE', 'bisyorjonibaE')
            ->get();
        //dd($maorif);
        return Inertia::render('Dash/DashItems',[
          'users'=>$users,
            'userName'=> $userName,
            'dujonibaCount'=>$dujonibaCount,
            'bisyorCount'=>$bisyorCount,
            'ijronashuda'=>$ijronashuda,
            'shumoraD'=>$shumoraD,
            'shumoraB'=>$shumoraB,
            'countries'=>$countries,
            'maorif'=>$maorif,
            'iqtisod'=>$iqtisod
        ]);
    }
}
