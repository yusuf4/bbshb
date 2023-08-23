<?php

namespace App\Http\Controllers;
use App\Models\Dujoniba;
use App\Models\FileShartnoma;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class ShartnomaListController extends Controller
{
    public function index(Request $request)
    {
        /*$files = Dujoniba::query()->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
        ->select('id', 'name', 'file_shartnoma_id','created_at')
        ->with('fileShartnoma:id,name')->paginate(2);*/
        $files = FileShartnoma::whereHas('bisyorjonibafile', function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%");
        })->orWhereHas('dujonibaF', function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%");
        })
            ->select('id','name','dujoniba_id', 'bisyorjoniba_id', 'created_at')
            ->with('bisyorjonibafile', 'dujonibaF:id,name')
            ->paginate(2)
            ->withQueryString();
       // dd($files);
        $userName= Auth::user()->name;
        $searchlist = $request->only(['search']);
        return Inertia::render('ShartnomaList', [
            'files'=>$files,
            'searchlist'=> $searchlist,
            'userName'=>$userName
        ]);
    }

    public function shIjronashuda(Request $request)
    {
        $ijronashuda = FileShartnoma::query()
            ->select('id', 'dujoniba_id', 'bisyorjoniba_id')
            ->whereHas('dujonibaF', function ($query){
                $query->where('sanai_etibor', '=', null);
             })
            ->orwhereHas('bisyorjonibafile', function ($query){
                $query->where('sanai_etibor', '=', null);
            })
            ->with('dujonibaF', 'bisyorjonibafile')
           //->get()->toArray();
            ->paginate(4)
           ->withQueryString();
        $ijtemp = [];
        $i=0;
        $keytemp = [];
        foreach ($ijronashuda as $val){
            if(!in_array($val['dujoniba_id'], $keytemp)){
                $keytemp[$i]=$val['dujoniba_id'];
                $ijtemp[$i]=$val;
            }
            $i++;
        }
         //dd($ijtemp);
        return Inertia::render('Shartnoma/ShartnomaIjronashuda', [
            'ijronashuda'=>$ijronashuda
        ]);
    }

    public function downloadOne($id)
    {
        $file= FileShartnoma::findOrFail($id);
        $filePath = public_path("uploads/shartnoma/".$file->name);
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
