<?php

namespace App\Http\Controllers\Dujoniba;

use App\Http\Controllers\Controller;
use App\Http\Requests\DujonibaRequest;
use App\Models\Dujoniba;
use App\Models\File;
use App\Models\FileShartnoma;
use App\Models\NomeriShartnoma;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class DujonibaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $dujoniba = Dujoniba::with('namudiShartnoma', 'tartibiEtibor')->latest()->get();

        //dd($dujoniba);

        //dd($namud);
        return Inertia::render('Dujoniba/Index',[
            'dujoniba'=>$dujoniba

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

       // $request->validated();
        $request->validate([
            'files_scan.*' => 'mimes:jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx',
        ],['files_scan.*.mimes' => 'Файл :attribute бояд фармати зерин бошад: jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx',]);
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
            'sanai_etibor' => $request->sanai_etibor,
            'qati_etibor' => $request->muhlatEnd,
            'imzo_tj' => $request->imzo_tj,
            'imzo_digar' => $request->imzo_digar,
            'ezoh' => $request->ezoh,
            'namudi_shartnoma_id'=> intval($request->namud),
            'tartibi_etibor_id'=> intval($request->tartib),
            'muhlati_etibor_id' => intval($request->muhlat),

        ]);


        //dd($dujoniba->dujonibaF->id);
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


        return redirect()->route('do.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
