<?php

namespace App\Http\Controllers;
use App\Models\Dujoniba;
use App\Models\FileShartnoma;
use Illuminate\Http\Request;
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
            ->select('id','name','created_at')
            ->with('bisyorjonibafile:file_shartnoma_id,id,name', 'dujonibaF:file_shartnoma_id,id,name')
            ->paginate(2)
            ->withQueryString();
        //dd($files);
        $searchlist = $request->only(['search']);
        return Inertia::render('ShartnomaList', [
            'files'=>$files,
            'searchlist'=> $searchlist
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
