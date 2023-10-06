<?php

namespace App\Http\Controllers\Dujoniba;

use App\Http\Controllers\Controller;
use App\Http\Requests\DujonibaRequest;
use App\Jobs\SendEmailDeleteJob;
use App\Models\Bisyorjoniba;
use App\Models\Country;
use App\Models\Dujoniba;
use App\Models\Ezoh;
use App\Models\File;
use App\Models\FileShartnoma;
use App\Models\NomeriShartnoma;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\File as FileDel;

class DujonibaController extends Controller
{
    use Notifiable;
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
            ->when($request->searchnamud, function ($query, $searchnamud){
                $query->where('namudi_shartnoma_id', '=', "{$searchnamud}");
            })
            ->when($request->searchetibor, function ($query, $searchetibor){
                $query->where('muhlati_etibor_id', '=', "{$searchetibor}");
            })
            ->when($request->ijronashuda == 'true', function ($query){
                $query->where('sanai_etibor', NULL);
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
            ->with('namudiShartnoma:id,name', 'tartibiEtibor:id,name','muhlatiEtibor:id,name', 'nomerD:id,dujoniba_id')
            ->latest()
            ->paginate(2)
            ->withQueryString();

        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        $searchlist = $request->only(['search']);
        $etiborlist = $request->only('searchetibor');
        $dujonibaCount= $dujoniba->total();
        $ezohs=Ezoh::select('id','name')->get();
        $countries = Country::select('id','name')->get();
        return Inertia::render('Dujoniba/Index',[
            'dujoniba'=>$dujoniba,
            'userName'=> $userName,
            'searchlist'=> $searchlist,
            'dujonibaCount'=>$dujonibaCount,
            'etiborlist'=>$etiborlist,
            'ezohs'=>$ezohs,
            'countries'=>$countries,
        ]);
    }


    public function seracN(Request $request){
        //dd($request->intixobD['name']);
        $bisyor = Bisyorjoniba::query()
            ->when($request->intixobD, function ($query) use ($request) {
                $query->whereHas('countriesB', function ($query) use ($request) {
                    $query->where('countries_id', '=', intval($request->intixobD['id']));
                });
            })

//            ->whereHas('countriesB', function (Builder $query) use ($request) {
//                $query->where('countries_id', $request->intixobD['id']);
//            })
            ->get();
        dd($bisyor);





//        $shumoraD = Dujoniba::query()
//            ->when($request->formValues['datefrom']!=null && $request->formValues['dateto']!=null, function ($query) use ($request) {
//                //if($formValues['datefrom']!=null && $formValues['dateto']!=null && $formValues['namud']=='1'){
//                    $query->whereBetween('created_at', [Carbon::createFromFormat('d.m.Y',$request->formValues['datefrom'])->format('Y-m-d'), Carbon::createFromFormat('d.m.Y',$request->formValues['dateto'])->format('Y-m-d')])->get();
//                //}
//            });
//        dd($shumoraD);

//        // filter by ijronashuda
//        //dd($request->ijronashuda);
//        $dujonibaFf = Dujoniba::query()
//        ->when($request->ijronashuda == 'true', function ($query){
//            $query->where('sanai_etibor', NULL);
//        })->get();
//        dd($dujonibaFf);



//         filter by date range
//        dd($request->formValues['datefrom']);
//       $dujonibaFf = Dujoniba::query();
//        //dd($request->formValues['datefrom']!=null && $request->formValues['dateto']!=null );
//       if($request->formValues['datefrom']!=null && $request->formValues['dateto']!=null ){
//           dd($dujonibaFf->whereBetween('created_at', [Carbon::createFromFormat('d.m.Y',$request->formValues['datefrom'])->format('Y-m-d'), Carbon::createFromFormat('d.m.Y',$request->formValues['dateto'])->format('Y-m-d')])->get());
//       };
//        return Inertia::render('Dujoniba/Index',[
//            'dujonibaFf'=>$dujonibaFf
//        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $userName= Auth::user()->name;
        $ezohs = Ezoh::select('id', 'name')->get();
        return Inertia::render('Dujoniba/Add',[
           'ezohs'=>$ezohs,
            'userName'=>$userName
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DujonibaRequest $request)
    {
        //$request->validated();
        //dd($request->shartnoma_file);
        /*$request->validate([
            'files_scan.*' => 'file|mimes:xlx,xls,pdf,doc,docx,mimes:jpg,jpeg,csv,txt',
        ],['files_scan.mimes' => 'Файл :attribute бояд фармати зерин бошад: jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx']);*/
//        $file = $request->file('shartnoma_file');
//        $fileName =  time().'-'. $file->getClientOriginalName();
//        $file->move(public_path('uploads/shartnoma'), $fileName);

//        $dujoniba = FileShartnoma::create([
//            'name'=>$fileName,
//        ]);

        $dujoniba = Dujoniba::create([
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
        // ======================== Upload files =========================
            $fileShartnoma=$request->file('shartnoma_file');
            foreach ($fileShartnoma as $item){
                $filename = time().'.'.$item->extension();
                $item->move(\public_path('uploads/shartnoma'), $filename);
                FileShartnoma::create([
                    'name'=>$filename,
                    'dujoniba_id'=>$dujoniba->id,
                ]);
            }

        if ($request->hasFile('files_scan')){
            $files=$request->file('files_scan');
            foreach ($files as $qarorfile){
                $filename = time().'.'.$qarorfile->extension();
                $qarorfile->move(\public_path('uploads/files'), $filename);
                File::create([
                    'name'=>$filename,
                    'dujoniba_id'=>$dujoniba->id,
                    'namud'=>1,
                ]);
            }
        }

        if ($request->hasFile('vakolat')){
            $filev= $request->file('vakolat');
            foreach ($filev as $vakolat) {
                $filevName = time().'.'.$vakolat->extension();
                $vakolat->move(\public_path('uploads/vakolat'),  $filevName);
                File::create([
                    'name'=>$filevName,
                    'dujoniba_id'=>$dujoniba->id,
                    'namud'=>0,
                ]);
            }
        }
        NomeriShartnoma::create([
           'dujoniba_id'=> $dujoniba->id,
        ]);
        // ======================Dynamyc inputs and multiselect input for Ezoh=======================
        $ezohFrontD = $request->ezohintixob;
        $ezhosD = $request->ezohlist;
        $ezohListD=[];
        if (!empty($request->input('ezohintixob'))){
            for ($i=0; $i<count($ezohFrontD); $i++){
                $ezohListD[]=$ezohFrontD[$i]['id'];
            }
        }
        foreach ($ezhosD as $ezhoD) {
            foreach ($ezhoD as $item){
                if ($item!=null){
                    $ezohItemD=Ezoh::create([
                        'name'=>$item,
                    ]);
                    $ezohListD[] = $ezohItemD->id;
                }
            }

        }
        $dujoniba->ezohD()->attach($ezohListD);

        return redirect()->route('do.index')
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
       $card = Dujoniba::with('nomerD:dujoniba_id,id','namudiShartnoma:id,name', 'muhlatiEtibor:id,name', 'tartibiEtibor:id,name', 'ShartnomaFile:dujoniba_id,id,name','ezohD:id,name')->findOrFail($id);
       $files = File::where('dujoniba_id', '=', $id)->select('name','id','namud')->get();
       //dd($card);
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
       return Inertia::render('Dujoniba/Card', [
          'card'=>$card,
           'files'=>$files,
           'userName'=>$userName
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
        $dujoniba = Dujoniba::with('fileDujoniba:dujoniba_id,id,name,namud', 'ezohD:id,name','ShartnomaFile:dujoniba_id,id,name')->findOrFail($id);

       // dd($dujoniba->created_at->format('d-m-Y'));
        $ezohs = Ezoh::select('id', 'name')->get();
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        return Inertia::render('Dujoniba/Edit', [
            'dujoniba'=>$dujoniba,
            'ezohs'=>$ezohs,
            'userName'=>$userName
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
//        if ($request->hasFile("shartnoma_file")){
//            if (FileDel::exists('uploads/shartnoma/'.$dujoniba->fileShartnoma->name)){
//                FileDel::delete('uploads/shartnoma/'.$dujoniba->fileShartnoma->name);
//            }
//            $file = $request->file('shartnoma_file');
//            $fileName =  time().'-'. $file->getClientOriginalName();
//            $file->move(public_path('uploads/shartnoma'), $fileName);
//            $dujoniba->fileShartnoma->update([
//                'name' => $fileName,
//                ]);
//        }
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

        // ====================Update dynamic input fields and multiselect Ezohs==================
        $ezohSelectD = $request->ezohintixob;
        $ezohFrontInputD = $request->ezohlist;
        $ezohListD=[];
        $ezohDuBackID=[];
        $ezohDuListID=[];

        $ezohGetD=$dujoniba->ezohD()->newPivotStatement()
            ->where('dujonibas_id', '=', $id)
            ->get();
        if (!empty($request->input('ezohintixob'))){
            // Get Countries ID of this Shartnoma from DB
            for ($i=0; $i<count($ezohGetD); $i++){
                $ezohDuBackID[]=$ezohGetD[$i]->ezohs_id;
            }
            // Get Countries ID from FrontEnd form
            for ($h=0; $h<count($ezohSelectD); $h++){
                $ezohDuListID[]=$ezohSelectD[$h]['id'];
            }

            $ezohListD = array_diff($ezohDuListID, $ezohDuBackID);

        }
        foreach ($ezohFrontInputD as $ezohD) {
            foreach ($ezohD as $key=>$item){
                if ($item!=null){
                    $ezohItemD=Ezoh::create([
                        'name'=>$item,
                    ]);
                    $ezohListD[] = $ezohItemD->id;
                }
            }
        }
        if (count($ezohListD)>0){
            $dujoniba->ezohD()->attach($ezohListD);
        }
        // ====================Upload new Shartnoma files =======================
            if ($request->hasFile('shartnoma_file')){
                $fileShartnoma=$request->file('shartnoma_file');
                foreach ($fileShartnoma as $item){
                    $filename = time().'.'.$item->extension();
                    $item->move(\public_path('uploads/shartnoma'), $filename);
                    FileShartnoma::create([
                        'name'=>$filename,
                        'dujoniba_id'=>$dujoniba->id,
                    ]);
                }
            }

        // ====================Upload new files for part six===================
        if ($request->hasFile('files_scan')){
            $filesqaror=$request->file('files_scan');
            foreach ($filesqaror as $qarorfile){
                $filename = time().'.'.$qarorfile->extension();
                $qarorfile->move(\public_path('uploads/files'), $filename);
                File::create([
                    'name'=>$filename,
                    'dujoniba_id'=>$dujoniba->id,
                    'namud'=>1
                ]);
            }
        }

        // ====================Upload new file for vakolat part ====================
        if ($request->hasFile('vakolat')){
            $files=$request->file('vakolat');
            foreach ($files as $vakolat){
                $filename = time().'.'.$vakolat->extension();
                $vakolat->move(\public_path('uploads/vakolat'), $filename);
                File::create([
                    'name'=>$filename,
                    'dujoniba_id'=>$dujoniba->id,
                    'namud'=>0
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
        $dujoniba = Dujoniba::with('ShartnomaFile','fileDujoniba')->findOrFail($id);
        foreach ($dujoniba->ShartnomaFile as $item) {
            if (FileDel::exists('uploads/shartnoma/'.$item->name)){
                FileDel::delete('uploads/shartnoma/'.$item->name);
            }
        }

        // $files = File::where("dujoniba_id", $dujoniba->id)->get();
        foreach ( $dujoniba->fileDujoniba as $item) {
            if (FileDel::exists('uploads/files/'.$item->name)){
                FileDel::delete('uploads/files/'.$item->name);
            }
            if (FileDel::exists('uploads/vakolat/'.$item->name)){
                FileDel::delete('uploads/vakolat/'.$item->name);
            }
        }

        $username= auth()->user()->name;
        $dujonibaname = $dujoniba->name;
        SendEmailDeleteJob::dispatch($dujonibaname,$username);
        $dujoniba->delete();
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
    public function deleteShartnoma($id)
    {
        $shartnoma = FileShartnoma::findOrFail($id);
        if (FileDel::exists('uploads/shartnoma/'.$shartnoma->name)){
            FileDel::delete('uploads/shartnoma/'.$shartnoma->name);
        }
        $shartnoma->delete();
        return redirect()->back();
    }

    public function downloadD($id)
    {
        $file = FileShartnoma::findOrFail($id);
        $filePath = public_path("uploads/shartnoma/".$file->name);
        return response()->download($filePath);
    }
    // =================Delete ezoh by Shartnoma ID and Ezoh ID =====================
    public function deleteEzohD(Request $request)
    {
        $shartnomaID = intval($request->id);
        $ezohID = intval($request->ezoh);
        $ezoh = Dujoniba::findOrFail($shartnomaID);
        $ezoh->ezohD()->newPivotStatement()
            ->where('dujonibas_id', '=', $shartnomaID)
            ->where('ezohs_id', '=', $ezohID)
            ->delete();
        return redirect()->back();
    }
    public function qatiDasti(Request $request, $id)
    {
        $dujoniba=Dujoniba::findOrFail($id);
        $dujoniba->update([
            'sanai_etibor' => (isset($request->sanai_etibor)) ? Carbon::createFromFormat('d.m.Y', $request->sanai_etibor)->format('Y-m-d') : null,
        ]);
        return redirect()->back();
    }
}
