<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Bisyorjoniba;
use App\Models\Country;
use App\Models\Dujoniba;
use App\Models\Ezoh;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $dujonibaG= Dujoniba::query()
            ->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->when($request->searchnamud, function ($query, $searchnamud){
                $query->where('namudi_shartnoma_id', '=', "{$searchnamud}");
            })
            ->when($request->searchetibor, function ($query, $searchetibor){
                $query->where('muhlati_etibor_id', '=', "{$searchetibor}");
            })
            ->when($request->ezohintixob, function ($query) use ($request) {
                $query->whereHas('ezohD', function ($query) use ($request) {
                    $query->where('ezohs_id', '=', intval($request->ezohintixob['id']));
                });
            })
            ->when($request->formValues, function ($query, $formValues) use ($request) {
                if($request->formValues['datefrom']!=null && $request->formValues['dateto']!=null){
                    $query->whereBetween('created_at', [Carbon::createFromFormat('d.m.Y',$formValues['datefrom'])->format('Y-m-d'), Carbon::createFromFormat('d.m.Y',$formValues['dateto'])->format('Y-m-d')]);
                }
            })
            ->where('sanai_etibor', '!=', null)
            ->with('namudiShartnoma:id,name', 'tartibiEtibor:id,name','muhlatiEtibor:id,name', 'nomerD:id,dujoniba_id')
            ->latest()
            ->paginate(2)
            ->withQueryString();
        //dd($dujonibaG);
        $searchlist = $request->only(['search']);
        $ezohs=Ezoh::select('id','name')->get();
        return Inertia::render('Visitors/DujonibaV', [
            'dujonibaG'=>$dujonibaG,
            'searchlist'=>$searchlist,
            'ezohs'=>$ezohs,
        ]);
    }

    public function showD($id)
    {
        $cardD = Dujoniba::with('nomerD:dujoniba_id,id','namudiShartnoma:id,name', 'muhlatiEtibor:id,name', 'tartibiEtibor:id,name', 'ShartnomaFile:dujoniba_id,id,name','ezohD:id,name')->findOrFail($id);
        $files = File::where('dujoniba_id', '=', $id)->select('name','id','namud')->get();
        return Inertia::render('Visitors/CardD', [
            'cardD'=>$cardD,
            'files'=>$files
        ]);
    }
    public function bindex(Request $request)
    {
        $bisyorjonibaG = Bisyorjoniba::query()
            ->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->when($request->searchnamud, function ($query, $searchnamud){
                $query->where('namudi_shartnoma_id', '=', "{$searchnamud}");
            })
            ->when($request->searchetibor, function ($query, $searchetibor){
                $query->where('muhlati_etibor_id', '=', "{$searchetibor}");
            })
            ->when($request->intixobB, function ($query) use ($request) {
                $query->whereHas('countriesB', function ($query) use ($request) {
                    $query->where('countries_id', '=', intval($request->intixobB['id']));
                });
            })
            ->when($request->ezohintixobB, function ($query) use ($request) {
                $query->whereHas('ezohB', function ($query) use ($request) {
                    $query->where('ezohs_id', '=', intval($request->ezohintixobB['id']));
                });
            })
            ->when($request->formValues, function ($query, $formValues) use ($request) {
                if($request->formValues['datefrom']!=null && $request->formValues['dateto']!=null){
                    $query->whereBetween('created_at', [Carbon::createFromFormat('d.m.Y',$formValues['datefrom'])->format('Y-m-d'), Carbon::createFromFormat('d.m.Y',$formValues['dateto'])->format('Y-m-d')]);
                }
            })
            ->where('sanai_etibor', '!=', null)
            ->with('namudB:id,name', 'ezohB', 'tartibiEtiborB:id,name', 'nomerB:id,bisyorjoniba_id', 'muhlatiEtiborB:id,name')
            ->latest()
            ->paginate(15)
            ->withQueryString();
        $searchlist = $request->only(['search']);
        $ezohs=Ezoh::select('id','name')->get();
        $countries = Country::select('id','name')->get();
        return Inertia::render('Visitors/BisyorjonibaV', [
            'bisyorjonibaG'=>$bisyorjonibaG,
            'ezohs'=>$ezohs,
            'countries'=>$countries,
            'searchlist'=>$searchlist,
        ]);
    }

    public function showB($id)
    {
        $cardB = Bisyorjoniba::with('tartibiEtiborB:id,name', 'muhlatiEtiborB:id,name','namudB:id,name','fileshartnomaB:bisyorjoniba_id,id,name','nomerB:bisyorjoniba_id,id','fileBisyor:bisyorjoniba_id,id,name,namud', 'countriesB', 'ezohB:id,name')
            ->findOrFail($id);

        return Inertia::render('Visitors/CardB', [
           'cardB'=>$cardB,
        ]);
    }


}
