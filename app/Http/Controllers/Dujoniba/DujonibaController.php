<?php

namespace App\Http\Controllers\Dujoniba;

use App\Http\Controllers\Controller;
use App\Http\Requests\DujonibaRequest;
use App\Models\Dujoniba;
use App\Models\File;
use App\Models\FileShartnoma;
use App\Models\NomeriShartnoma;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\File as FileDel;

class DujonibaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */

    public function index(Request $request)
    {
        $dujoniba = Dujoniba::query()
            ->when($request->search, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->with('namudiShartnoma:id,name', 'tartibiEtibor', 'nomerD:id,dujoniba_id')
            ->latest()
           // ->get()
            ->paginate(3);
        $userName= Auth::user()->name;
        $searchlist = $request->only(['search']);
        return Inertia::render('Dujoniba/Index',[
            'dujoniba'=>$dujoniba,
            'userName'=> $userName,
            'searchlist'=> $searchlist,

        ]);
    }

    public function guestIndex(){
        return Inertia::render('NavGuest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Dujoniba/Add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DujonibaRequest $request)
    {

        $request->validated();
        //dd($request->sanai_etibor);
        /*$request->validate([
            'files_scan.*' => 'file|mimes:xlx,xls,pdf,doc,docx,mimes:jpg,jpeg,csv,txt',
        ],['files_scan.mimes' => 'Файл :attribute бояд фармати зерин бошад: jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx']);*/
        $file = $request->file('shartnoma_file');
        $fileName =  time().'-'. $file->getClientOriginalName();
        $file->move(public_path('uploads/shartnoma'), $fileName);

        $dujoniba = FileShartnoma::create([
            'name'=>$fileName,
        ]);
        $dujoniba->dujonibaF()->create([
            'name' => $request->name,
            'jonibi_tj' => $request->jonibi_tj,
            'jonibi_digar' => $request->jonibi_digar,
            'etibor_digar' => $request->etibor_digar,
            'sanai_etibor' =>  (isset($request->sanai_etibor)) ? Carbon::createFromFormat('d.m.Y', $request->sanai_etibor)->format('Y-m-d') : null,
            'qati_etibor' => (isset($request->muhlatEnd)) ? Carbon::createFromFormat('d.m.Y', $request->muhlatEnd)->format('Y-m-d') : null,
            'imzo_tj' => $request->imzo_tj,
            'imzo_digar' => $request->imzo_digar,
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
                    'dujoniba_id'=>$dujoniba->dujonibaF->id,
                ]);
            }
        }
        if ($request->hasFile('vakolat')){
            $filev= $request->file('vakolat');
            foreach ($filev as $vakolat) {
                $filevName = time().'_'.$vakolat->getClientOriginalName();
                $vakolat->move(\public_path('uploads/vakolat'),  $filevName);
                File::create([
                    'name'=>$filevName,
                    'dujoniba_id'=>$dujoniba->dujonibaF->id,
                ]);
            }
        }
        NomeriShartnoma::create([
           'dujoniba_id'=> $dujoniba->dujonibaF->id,
        ]);

        return redirect()->route('do.index')
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
        $dujoniba = Dujoniba::with('fileDujoniba:dujoniba_id,id,name', 'fileShartnoma:id,name')->findOrFail($id);

       // dd($dujoniba->created_at->format('d-m-Y'));
        return Inertia::render('Dujoniba/Edit', [
            'dujoniba'=>$dujoniba
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //dd($request->sanai_etibor);
        $dujoniba = Dujoniba::findOrFail($id);
        if ($request->hasFile("shartnoma_file")){
            if (FileDel::exists('uploads/shartnoma/'.$dujoniba->fileShartnoma->name)){
                FileDel::delete('uploads/shartnoma/'.$dujoniba->fileShartnoma->name);
            }
            $file = $request->file('shartnoma_file');
            $fileName =  time().'-'. $file->getClientOriginalName();
            $file->move(public_path('uploads/shartnoma'), $fileName);
            $dujoniba->fileShartnoma->update([
                'name' => $fileName,
                ]);
        }
        $dujoniba->update([
            'name' => $request->name,
            'jonibi_tj' => $request->jonibi_tj,
            'jonibi_digar' => $request->jonibi_digar,
            'etibor_digar' => $request->etibor_digar,
            'sanai_etibor' => (isset($request->sanai_etibor)) ? Carbon::createFromFormat('d.m.Y', $request->sanai_etibor)->format('Y-m-d') : null,
            'qati_etibor' => (isset($request->muhlatEnd)) ? Carbon::createFromFormat('d.m.Y', $request->muhlatEnd)->format('Y-m-d') : null,
            'imzo_tj' => $request->imzo_tj,
            'imzo_digar' => $request->imzo_digar,
            'ezoh' => $request->ezoh,
            'namudi_shartnoma_id'=> intval($request->namud),
            'tartibi_etibor_id'=> intval($request->tartib),
            'muhlati_etibor_id' => intval($request->muhlat)
        ]);

        // ====================Upload new files for part six===================
        if ($request->hasFile('files_scan')){
            $filesqaror=$request->file('files_scan');
            foreach ($filesqaror as $qarorfile){
                $filename = time(). '_'.$qarorfile->getClientOriginalName();
                $qarorfile->move(\public_path('uploads/files'), $filename);
                File::create([
                    'name'=>$filename,
                    'dujoniba_id'=>$dujoniba->id,
                ]);
            }
        }

        // ====================Upload new file for vakolat part ====================
        if ($request->hasFile('vakolat')){
            $files=$request->file('vakolat');
            foreach ($files as $vakolat){
                $filename = time(). '_'.$vakolat->getClientOriginalName();
                $vakolat->move(\public_path('uploads/vakolat'), $filename);
                File::create([
                    'name'=>$filename,
                    'dujoniba_id'=>$dujoniba->id,
                ]);
            }
        }
        return redirect()->route('do.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $dujoniba = Dujoniba::findOrFail($id);
        if (FileDel::exists('uploads/shartnoma/'.$dujoniba->fileShartnoma->name)){
            FileDel::delete('uploads/shartnoma/'.$dujoniba->fileShartnoma->name);
        }
        $files = File::where("dujoniba_id", $dujoniba->id)->get();
        foreach ( $files as $item) {
            if (FileDel::exists('uploads/files/'.$item->name)){
                FileDel::delete('uploads/files/'.$item->name);
            }
        }
        $dujoniba->fileShartnoma->delete();

        return redirect()->back();
    }

    // ==================Delete files bandi 6=================
    public function deleteqaror($id)
    {
        $fileqaror = File::findOrFail($id);
        if (FileDel::exists('uploads/files/'.$fileqaror->name)){
            FileDel::delete('uploads/files/'.$fileqaror->name);
        }
        $fileqaror->delete();
        return redirect()->back();
    }

    // ==================Delete files qaror=======================
    public function deletevakolat($id)
    {
        $filevakolat = File::findOrFail($id);
        if (FileDel::exists('uploads/vakolat/'.$filevakolat->name)){
            FileDel::delete('uploads/vakolat/'.$filevakolat->name);
        }
        $filevakolat->delete();
        return redirect()->back();
    }

    public function downloadD($id)
    {
        $file = FileShartnoma::findOrFail($id);
        $filePath = public_path("uploads/shartnoma/".$file->name);
        return response()->download($filePath);
    }
}
