<?php

namespace App\Http\Controllers;

use App\Models\Bisyorjoniba;
use App\Models\Dujoniba;
use App\Models\FileShartnoma;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class ShartnomaListController extends Controller
{
    public function twoSide(Request $request): \Inertia\Response
    {
        $files = Dujoniba::query()
            ->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->with('ShartnomaFile:dujoniba_id,id,name')
            ->select('id', 'name', 'created_at')
            ->paginate(2)
            ->withQueryString();
        //dd($twoside);
//        $multiside = Bisyorjoniba::with('fileshartnomaB:bisyorjoniba_id,id,name')->select('id','name')->get();
//        $collection = collect();
//        foreach ($twoside as $car)
//            $collection->push($car);
//
//        foreach ($multiside as $bike)
//            $collection->push($bike);
//
//        //dd($collection);
//        $files = FileShartnoma::whereHas('bisyorjonibafile', function ($query) use ($request) {
//            $query->where('name', 'like', "%{$request->search}%");
//        })->orWhereHas('dujonibaF', function ($query) use ($request) {
//            $query->where('name', 'like', "%{$request->search}%");
//        })
//            //->where('dujoniba_id', '=', null)
//            ->select('id', 'name', 'dujoniba_id', 'bisyorjoniba_id', 'created_at')
//            ->with('bisyorjonibafile:id,name', 'dujonibaF:id,name')
//            ->paginate(2)
//            ->withQueryString();


        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        $searchlist = $request->only(['search']);
        return Inertia::render('Shartnoma/DujonibaFile', [
            'files' => $files,
            'searchlist' => $searchlist,
            'userName' => $userName
        ]);
    }

    public function multiFileSide(Request $request)
    {
        $filesB = Bisyorjoniba::query()
            ->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->with('fileshartnomaB:bisyorjoniba_id,id,name')
            ->select('id', 'name', 'created_at')
            ->paginate(2)
            ->withQueryString();
        $searchlist = $request->only(['search']);
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        return Inertia::render('Shartnoma/BisyorjonibaFile', [
            'filesB'=>$filesB,
            'searchlist'=>$searchlist,
            'userName'=>$userName
        ]);
    }

    public function ijronashudaB(Request $request)
    {
        $ijronashudaB = Bisyorjoniba::query()
            ->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->where('sanai_etibor', null)
            ->with('namudB:id,name', 'ezohB', 'tartibiEtiborB:id,name', 'nomerB:id,bisyorjoniba_id', 'muhlatiEtiborB:id,name')
            ->latest()
            ->paginate(2)
            ->withQueryString();
        $searchlist = $request->only(['search']);
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        return Inertia::render('Shartnoma/IjronashudaB', [
            'ijronashudaB'=>$ijronashudaB,
            'searchlist'=>$searchlist,
            'userName'=>$userName
        ]);
    }

    public function ijronashudaD(Request $request)
    {
        $ijronashudaD = Dujoniba::query()
            ->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->where('sanai_etibor', null)
            ->with('namudiShartnoma:id,name', 'tartibiEtibor:id,name','muhlatiEtibor:id,name', 'nomerD:id,dujoniba_id')
            ->latest()
            ->paginate(2)
            ->withQueryString();
        $searchlist = $request->only(['search']);
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        return Inertia::render('Shartnoma/IjronashudaD', [
            'ijronashudaD'=>$ijronashudaD,
            'searchlist'=>$searchlist,
            'userName'=>$userName
        ]);
    }



    public function shIjronashuda(Request $request)
    {
        $twoSides = Dujoniba::where('sanai_etibor', null)->get(['name', 'etibor_digar', 'sanai_etibor', 'qati_etibor', 'namudi_shartnoma_id', 'tartibi_etibor_id', 'muhlati_etibor_id']);
        $multiSides = Bisyorjoniba::where('sanai_etibor', null)->get(['name', 'etibor_digar', 'sanai_etibor', 'qati_etibor', 'namudi_shartnoma_id', 'tartibi_etibor_id', 'muhlati_etibor_id']);
        $result = $twoSides->concat($multiSides);


        $ijronashuda = FileShartnoma::query()
            ->select('id', 'dujoniba_id', 'bisyorjoniba_id')
            ->whereHas('dujonibaF', function ($query) {
                $query->where('sanai_etibor', '=', null);
            })
            ->orwhereHas('bisyorjonibafile', function ($query) {
                $query->where('sanai_etibor', '=', null);
            })
            ->with('dujonibaF', 'bisyorjonibafile')
            //->get()->toArray();
            ->paginate(4)
            ->withQueryString();


        $ijtemp = [];
        $i = 0;
        $keytemp = [];
        foreach ($ijronashuda as $val) {
            if (!in_array($val['dujoniba_id'], $keytemp)) {
                $keytemp[$i] = $val['dujoniba_id'];
                $ijtemp[$i] = $val;
            }
            $i++;
        }
        //dd($ijtemp);
        return Inertia::render('Shartnoma/ShartnomaIjronashuda', [
            'ijronashuda' => $result
        ]);
    }

    public function downloadOne($id)
    {
        $file = FileShartnoma::findOrFail($id);
        $filePath = public_path("uploads/shartnoma/" . $file->name);
        return response()->download($filePath);

    }

    public function selectDownload(Request $request)
    {
        dd($request);
        $ids = [];
        $ids = $request->all();
        //dd($ids);


    }
}
