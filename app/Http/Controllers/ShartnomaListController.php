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
        $files = FileShartnoma::select('id','name','created_at')
            ->with('bisyorjonibafile', 'dujonibaF')
            ->paginate(2);
        //dd($files);
        return Inertia::render('ShartnomaList', [
            'files'=>$files
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
