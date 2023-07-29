<?php

namespace App\Http\Controllers\Bisyorjoniba;

use App\Http\Controllers\Controller;
use App\Http\Requests\BisyorjonibaRequest;
use App\Http\Requests\BisyorjonibaUpdateRequest;
use App\Models\Bisyorjoniba;
use App\Models\Dujoniba;
use App\Models\File;
use App\Models\FileShartnoma;
use App\Models\Mintaqaho;
use App\Models\NomeriShartnoma;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            ->with('namudB:id,name', 'tartibiEtiborB:id,name', 'nomerB:id,bisyorjoniba_id', 'muhlatiEtiborB:id,name')
            ->latest()
            ->paginate('3');
        $searchlist = $request->only(['search']);
        return Inertia::render('Bisyorjoniba/Index', [
            'bisyorjoniba' => $bisyorjoniba,
            'searchlist'=> $searchlist,
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
        //dd($request->davlatho);
        $file = $request->file('shartnoma_file');
        $fileName =  time().'-'. $file->getClientOriginalName();
        $file->move(public_path('uploads/shartnoma'), $fileName);
        $bisyorjoniba = FileShartnoma::create([
            'name'=>$fileName
        ]);

        $bisyorjoniba->bisyorjonibafile()->create([
            'name' => $request->name,
            'etibor_digar' => $request->etibor_digar,
            'sanai_etibor' => (isset($request->sanai_etibor)) ? Carbon::createFromFormat('d.m.Y', $request->sanai_etibor)->format('Y-m-d') : null,
            'qati_etibor' => (isset($request->muhlatEnd)) ? Carbon::createFromFormat('d.m.Y', $request->muhlatEnd)->format('Y-m-d') : null,
            'maqomot' => $request->maqomot,
            'ezoh' => $request->ezoh,
            'namudi_shartnoma_id'=> intval($request->namud),
            'tartibi_etibor_id'=> intval($request->tartib),
            'muhlati_etibor_id' => intval($request->muhlat),
        ]);
        // ==================Add files==============
        if ($request->hasFile('files_scan')){
            $files=$request->file('files_scan');
            foreach ($files as $qarorfile){
                $filename = time(). '_'.$qarorfile->getClientOriginalName();
                $qarorfile->move(\public_path('uploads/files'), $filename);
                File::create([
                    'name'=>$filename,
                    'bisyorjoniba_id'=>$bisyorjoniba->bisyorjonibafile->id,
                    'namud'=>1,
                ]);
            }
        }
        NomeriShartnoma::create([
            'bisyorjoniba_id' =>$bisyorjoniba->bisyorjonibafile->id,
        ]);
        // ======================Dynamyc inputs for Davlatho=======================
        $mintaqaho = $request->davlatho;
        foreach ($mintaqaho as $davlat) {
            foreach ($davlat as $item){
                if ($item!=null){
                    Mintaqaho::create([
                        'name'=>$item,
                        'bisyorjoniba_id'=>$bisyorjoniba->bisyorjonibafile->id,
                    ]);
                }
            }

        }

        return redirect()->route('bi.index')
            ->with('message', 'Шартнома илова шуд!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $card = Bisyorjoniba::with('tartibiEtiborB:id,name', 'muhlatiEtiborB:id,name','namudB:id,name','fileshartnomaB:id,name','nomerB:bisyorjoniba_id,id','fileBisyor:bisyorjoniba_id,id,name,namud', 'mintaqaho:bisyorjoniba_id,id,name')
            ->findOrFail($id);

        return Inertia::render('Bisyorjoniba/Card', [
           'card'=>$card
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $bisyorjoniba = Bisyorjoniba::with('mintaqaho:bisyorjoniba_id,id,name', 'fileshartnomaB:id,name', 'fileBisyor:bisyorjoniba_id,id,name,namud')->findOrFail($id);
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
        //dd($request);
        $bisyorjoniba = Bisyorjoniba::with('mintaqaho')->findOrFail($id);
        $request->validated();

        // ====================Delete old file if uploaded new file Shartnoma===================
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

        // ====================Update dynamic input fields==================
        $country = $request->davlatho;
        foreach ($country as $davlat) {
            foreach ($davlat as $key=>$item){
                if ($item!=null){
                    Mintaqaho::create([
                        'name'=>$item,
                        'bisyorjoniba_id'=>$bisyorjoniba->id,
                    ]);
                }
            }

        }

        // ==========================Update Shartnoma contents===================

        $bisyorjoniba->update([
            'name' => $request->name,
            'etibor_digar' => $request->etibor_digar,
            'sanai_etibor' => (isset($request->sanai_etibor)) ? Carbon::createFromFormat('d.m.Y', $request->sanai_etibor)->format('Y-m-d') : null,
            'qati_etibor' => (isset($request->muhlatEnd)) ? Carbon::createFromFormat('d.m.Y', $request->muhlatEnd)->format('Y-m-d') : null,
            'maqomot' => $request->maqomot,
            'ezoh' => $request->ezoh,
            'namudi_shartnoma_id'=> intval($request->namud),
            'tartibi_etibor_id'=> intval($request->tartib),
            'muhlati_etibor_id' => intval($request->muhlat),
        ]);

        // ====================Upload new aditional files===================

        if ($request->hasFile('files_scan')){
            $files=$request->file('files_scan');
            foreach ($files as $qarorfile){
                $filename = time(). '_'.$qarorfile->getClientOriginalName();
                $qarorfile->move(\public_path('uploads/files'), $filename);
                File::create([
                    'name'=>$filename,
                    'bisyorjoniba_id'=>$bisyorjoniba->id,
                    'namud'=>1,
                ]);
            }
        }

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
    // =================Delete mintaqaho by id
    public function deleteMintaqa($id)
    {
        $mintaqa = Mintaqaho::findOrFail($id);
        //dd($mintaqa);
        $mintaqa->delete();
        return redirect()->back();
    }
    // ====================Delete aditional files ====================
    public function deleteFiles($id)
    {
      $fileShartnoma = File::findOrFail($id);
      //dd($fileShartnoma);
        if (FileDel::exists('uploads/files/'.$fileShartnoma->name)){
            FileDel::delete('uploads/files/'.$fileShartnoma->name);
        }
        $fileShartnoma->delete();
      return redirect()->back();
    }
    public function downloadB($id)
    {
        $file = FileShartnoma::findOrFail($id);
        $filePath = public_path("uploads/shartnoma/".$file->name);
        return response()->download($filePath);
    }

    public function qatiDastiB(Request $request, $id)
    {
        $shartnoma = Bisyorjoniba::findOrFail($id);
        $shartnoma->update([
            'sanai_etibor' => (isset($request->sanai_etibor)) ? Carbon::createFromFormat('d.m.Y', $request->sanai_etibor)->format('Y-m-d') : null,
        ]);
        return redirect()->back();
    }
}
