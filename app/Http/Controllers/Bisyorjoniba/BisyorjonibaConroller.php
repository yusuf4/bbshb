<?php

namespace App\Http\Controllers\Bisyorjoniba;

use App\Http\Controllers\Controller;
use App\Http\Requests\BisyorjonibaRequest;
use App\Http\Requests\BisyorjonibaUpdateRequest;
use App\Models\Bisyorjoniba;
use App\Models\Dujoniba;
use App\Models\File;
use App\Models\FileShartnoma;
use App\Models\NomeriShartnoma;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File as FileDel;

class BisyorjonibaConroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $bisyorjoniba = Bisyorjoniba::query()
            ->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->with('namudB:id,name', 'tartibiEtiborB:id,name', 'nomerB:id,bisyorjoniba_id')
            ->latest()
            ->paginate('3');
        return Inertia::render('Bisyorjoniba/Index', [
            'bisyorjoniba' => $bisyorjoniba
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Bisyorjoniba/Add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BisyorjonibaRequest $request)
    {
         //dd($request);

        $file = $request->file('shartnoma_file');
        $fileName =  time().'-'. $file->getClientOriginalName();
        $file->move(public_path('uploads/shartnoma'), $fileName);
        $bisyorjoniba = FileShartnoma::create([
            'name'=>$fileName
        ]);

        $bisyorjoniba->bisyorjonibafile()->create([
            'name' => $request->name,
            'etibor_digar' => $request->etibor_digar,
            'sanai_etibor' => $request->sanai_etibor,
            'qati_etibor' => $request->muhlatEnd,
            'maqomot' => $request->maqomot,
            'ezoh' => $request->ezoh,
            'namudi_shartnoma_id'=> intval($request->namud),
            'tartibi_etibor_id'=> intval($request->tartib),
            'muhlati_etibor_id' => intval($request->muhlat),
        ]);
        if ($request->hasFile('files_scan')){
            $files=$request->file('files_scan');
            foreach ($files as $qarorfile){
                $filename = time(). '_'.$qarorfile->getClientOriginalName();
                $qarorfile->move(\public_path('uploads/files'), $filename);
                File::create([
                    'name'=>$filename,
                    'bisyorjoniba_id'=>$bisyorjoniba->bisyorjonibafile->id,
                ]);
            }
        }
        NomeriShartnoma::create([
            'bisyorjoniba_id' =>$bisyorjoniba->bisyorjonibafile->id,
        ]);

        return redirect()->route('bi.index')
            ->with('message', 'Шартнома илова шуд!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $bisyorjoniba = Bisyorjoniba::findOrFail($id);
        //dd($bisyorjoniba);
        return Inertia::render('Bisyorjoniba/Edit',[
            'bisyorjoniba'=>$bisyorjoniba
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BisyorjonibaUpdateRequest $request, $id)
    {
        $bisyorjoniba = Bisyorjoniba::findOrFail($id);
        $request->validated();

        // Delete old file if uploaded new file Shartnoma
        if ($request->hasFile("shartnoma_file")){
            if (FileDel::exists('uploads/shartnoma/'.$bisyorjoniba->fileshartnomaB->name)){
                FileDel::delete('uploads/shartnoma/'.$bisyorjoniba->fileshartnomaB->name);
            }
            $file = $request->file('shartnoma_file');
            $fileName =  time().'-'. $file->getClientOriginalName();
            $file->move(public_path('uploads/shartnoma'), $fileName);
            $bisyorjoniba->fileshartnomaB->update([
                'name' => $fileName,
            ]);
        }

        // Update Shartnoma contents

        $bisyorjoniba->update([
            'name' => $request->name,
            'etibor_digar' => $request->etibor_digar,
            'sanai_etibor' => $request->sanai_etibor,
            'qati_etibor' => $request->muhlatEnd,
            'maqomot' => $request->maqomot,
            'ezoh' => $request->ezoh,
            'namudi_shartnoma_id'=> intval($request->namud),
            'tartibi_etibor_id'=> intval($request->tartib),
            'muhlati_etibor_id' => intval($request->muhlat),
        ]);

        return redirect()->route('bi.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $bisyorid = Bisyorjoniba::findOrFail($id);

        if (FileDel::exists('uploads/shartnoma/'.$bisyorid->fileshartnomaB->name)){
            FileDel::delete('uploads/shartnoma/'.$bisyorid->fileshartnomaB->name);
        }
        $files = File::where("bisyorjoniba_id", $bisyorid->id)->get();
        foreach ( $files as $item) {
            if (FileDel::exists('uploads/files/'.$item->name)){
                FileDel::delete('uploads/files/'.$item->name);
            }
        }
        $bisyorid->fileshartnomaB->delete();

        return redirect()->back();
    }

    public function downloadB($id)
    {
        $file = FileShartnoma::findOrFail($id);
        $filePath = public_path("uploads/shartnoma/".$file->name);
        return response()->download($filePath);
    }
}
