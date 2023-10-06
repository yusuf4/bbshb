<?php

namespace App\Http\Controllers\Bisyorjoniba;

use App\Http\Controllers\Controller;
use App\Http\Requests\BisyorjonibaRequest;
use App\Http\Requests\BisyorjonibaUpdateRequest;
use App\Jobs\SendEmailDeleteJob;
use App\Models\Bisyorjoniba;
use App\Models\Country;
use App\Models\Dujoniba;
use App\Models\Ezoh;
use App\Models\File;
use App\Models\FileShartnoma;
use App\Models\Mintaqaho;
use App\Models\NomeriShartnoma;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
            ->when($request->searchnamud, function ($query, $searchnamud){
                $query->where('namudi_shartnoma_id', '=', "{$searchnamud}");
            })
            ->when($request->searchetibor, function ($query, $searchetibor){
                $query->where('muhlati_etibor_id', '=', "{$searchetibor}");
            })
            ->when($request->ijronashuda == 'true', function ($query){
                $query->where('sanai_etibor', NULL);
            })
            ->when($request->intixobB, function ($query) use ($request) {
                $query->whereHas('countriesB', function ($query) use ($request) {
                    $query->where('countries_id', '=', intval($request->intixobB['id']));
                });
            })
            ->when($request->ezohintixob, function ($query) use ($request) {
                $query->whereHas('ezohB', function ($query) use ($request) {
                    $query->where('ezohs_id', '=', intval($request->ezohintixob['id']));
                });
            })
            ->when($request->formValues, function ($query, $formValues) use ($request) {
                if($request->formValues['datefrom']!=null && $request->formValues['dateto']!=null){
                    $query->whereBetween('created_at', [Carbon::createFromFormat('d.m.Y',$formValues['datefrom'])->format('Y-m-d'), Carbon::createFromFormat('d.m.Y',$formValues['dateto'])->format('Y-m-d')]);
                }
            })
            ->with('namudB:id,name', 'ezohB', 'tartibiEtiborB:id,name', 'nomerB:id,bisyorjoniba_id', 'muhlatiEtiborB:id,name')
            ->latest()
            ->paginate('3')
            ->withQueryString();
        $ezohs = Ezoh::select('id', 'name')->get();
        $countries = Country::select('id','name')->get();
        $searchlist = $request->only(['search']);
        $bisyorjonibaCount = $bisyorjoniba->total();
        if (Auth::check()){
            $userName= Auth::user()->name;
        };

        return Inertia::render('Bisyorjoniba/Index', [
            'bisyorjoniba' => $bisyorjoniba,
            'searchlist'=> $searchlist,
            'bisyorjonibaCount'=>$bisyorjonibaCount,
            'ezohs' => $ezohs,
            'countries'=>$countries,
            'userName'=>$userName
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $countries = Country::select('id','name')->get();
        $ezohs = Ezoh::select('id', 'name')->get();
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        return Inertia::render('Bisyorjoniba/Add', [
           'countries'=>$countries,
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
    public function store(BisyorjonibaRequest $request)
    {
        //dd($request->ezohintixob);
//        $file = $request->file('shartnoma_file');
//        $fileName =  time().'-'. $file->getClientOriginalName();
//        $file->move(public_path('uploads/shartnoma'), $fileName);
//        $bisyorjoniba = FileShartnoma::create([
//            'name'=>$fileName
//        ]);

        $bisyorjoniba = Bisyorjoniba::create([
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
        $fileShartnoma=$request->file('shartnoma_file');
        foreach ($fileShartnoma as $item){
            $filename = time().'.'.$item->extension();
            $item->move(\public_path('uploads/shartnoma'), $filename);
            FileShartnoma::create([
                'name'=>$filename,
                'bisyorjoniba_id'=>$bisyorjoniba->id,
            ]);
        }

        if ($request->hasFile('files_scan')){
            $files=$request->file('files_scan');
            foreach ($files as $qarorfile){
                $filename = time().'.'.$qarorfile->extension();
                $qarorfile->move(\public_path('uploads/files'), $filename);
                File::create([
                    'name'=>$filename,
                    'bisyorjoniba_id'=>$bisyorjoniba->id,
                    'namud'=>1,
                ]);
            }
        }
        NomeriShartnoma::create([
            'bisyorjoniba_id' =>$bisyorjoniba->id,
        ]);
        // ======================Dynamyc inputs for Davlatho=======================
        $countriesB = $request->intixobB;
        $countriesList=[];
        if (!empty($request->input('intixobB'))){
            for ($i=0; $i<count($countriesB); $i++){
                $countriesList[]=$countriesB[$i]['id'];
            }
        }

        $mintaqaho = $request->davlatho;
        foreach ($mintaqaho as $davlat) {
            foreach ($davlat as $item){
                if ($item!=null){
                    $countryItem=Country::create([
                        'name'=>$item,
                        //'bisyorjoniba_id'=>$bisyorjoniba->bisyorjonibafile->id,
                    ]);
                    $countryAdd=array_push($countriesList, $countryItem->id);
                }
            }

        }
        $bisyorjoniba->countriesB()->attach($countriesList);

        // ======================Dynamyc inputs for Ezoh=======================
        $ezohFront = $request->ezohintixob;
        $ezhos = $request->ezohlist;
        $ezohList=[];
        if (!empty($request->input('ezohintixob'))){
            for ($i=0; $i<count($ezohFront); $i++){
                $ezohList[]=$ezohFront[$i]['id'];
            }
        }
        foreach ($ezhos as $ezho) {
            foreach ($ezho as $item){
                if ($item!=null){
                    $ezohItem=Ezoh::create([
                        'name'=>$item,
                    ]);
                    $ezohList[] = $ezohItem->id;
                }
            }

        }
        $bisyorjoniba->ezohB()->attach($ezohList);
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
        $card = Bisyorjoniba::with('tartibiEtiborB:id,name', 'muhlatiEtiborB:id,name','namudB:id,name','fileshartnomaB:bisyorjoniba_id,id,name','nomerB:bisyorjoniba_id,id','fileBisyor:bisyorjoniba_id,id,name,namud', 'countriesB', 'ezohB:id,name')
            ->findOrFail($id);
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        return Inertia::render('Bisyorjoniba/Card', [
           'card'=>$card,
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
        $bisyorjoniba = Bisyorjoniba::with('countriesB','ezohB:id,name', 'fileshartnomaB:bisyorjoniba_id,id,name', 'fileBisyor:bisyorjoniba_id,id,name,namud')->findOrFail($id);
        $countries = Country::select('id', 'name')->get();
        $ezohs = Ezoh::select('id', 'name')->get();
        if (Auth::check()){
            $userName= Auth::user()->name;
        };
        return Inertia::render('Bisyorjoniba/Edit',[
            'bisyorjoniba'=>$bisyorjoniba,
            'countries'=>$countries,
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
    public function update(BisyorjonibaUpdateRequest $request, $id)
    {
        $bisyorjoniba = Bisyorjoniba::with('countriesB')->findOrFail($id);
        $request->validated();

        // Delete list of country if selected 'Универсали'
        if($request->namud=='4'){
            $bisyorjoniba->countriesB()->newPivotStatement()
                ->where('bisyorjonibas_id', '=', $bisyorjoniba->id)
                ->delete();
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


        // ====================Update dynamic input fields and multiselect Contries==================
        $country = $request->davlatho;
        $countriesFront = $request->intixobB;
        $countriesList=[];
        $countryBackID=[];
        $countryListID=[];
        $css=$bisyorjoniba->countriesB()->newPivotStatement()
            ->where('bisyorjonibas_id', '=', $id)
            ->get();

        if (!empty($request->input('intixobB'))){
            // Get Countries ID of this Shartnoma from DB
            for ($i=0; $i<count($css); $i++){
                $countryBackID[]=$css[$i]->countries_id;
            }
            // Get Countries ID from FrontEnd form
            for ($h=0; $h<count($countriesFront); $h++){
                //echo($countriesFront[$h]['id']);
                $countryListID[]=$countriesFront[$h]['id'];
            }

            $countriesList = array_diff($countryListID, $countryBackID);
            //dd($countriesList);
        }
        foreach ($country as $davlat) {
            foreach ($davlat as $key=>$item){
                if ($item!=null){
                    $countryItem=Country::create([
                        'name'=>$item,
                        //'bisyorjoniba_id'=>$bisyorjoniba->id,
                    ]);
                    $countryAdd=array_push($countriesList, $countryItem->id);
                }
            }

        }
        if (count($countriesList)>0){
            $bisyorjoniba->countriesB()->attach($countriesList);
        }

        // ====================Update dynamic input fields and multiselect Ezohs==================
        $ezohSelect = $request->ezohintixob;
        $ezohFrontInput = $request->ezohlist;
        $ezohList=[];
        $ezohBackID=[];
        $ezohListID=[];
        $ezohGet=$bisyorjoniba->ezohB()->newPivotStatement()
            ->where('bisyorjonibas_id', '=', $id)
            ->get();
        if (!empty($request->input('ezohintixob'))){
            // Get Countries ID of this Shartnoma from DB
            for ($i=0; $i<count($ezohGet); $i++){
                $ezohBackID[]=$ezohGet[$i]->ezohs_id;
            }
            // Get Countries ID from FrontEnd form
            for ($h=0; $h<count($ezohSelect); $h++){
                $ezohListID[]=$ezohSelect[$h]['id'];
            }

            $ezohList = array_diff($ezohListID, $ezohBackID);
            //dd($ezohList);
        }
        foreach ($ezohFrontInput as $ezoh) {
            foreach ($ezoh as $key=>$item){
                if ($item!=null){
                    $ezohItem=Ezoh::create([
                        'name'=>$item,
                        //'bisyorjoniba_id'=>$bisyorjoniba->id,
                    ]);
                    $ezohList[] = $ezohItem->id;
                }
            }

        }

        if (count($ezohList)>0){
            $bisyorjoniba->ezohB()->attach($ezohList);
        }

        // ====================Upload new aditional files in update section===================
        if ($request->hasFile('shartnoma_file')){
            $fileShartnoma=$request->file('shartnoma_file');
            foreach ($fileShartnoma as $item){
                $filename = time().'.'.$item->extension();
                $item->move(\public_path('uploads/shartnoma'), $filename);
                FileShartnoma::create([
                    'name'=>$filename,
                    'bisyorjoniba_id'=>$bisyorjoniba->id,
                ]);
            }
        }
        if ($request->hasFile('files_scan')){
            $files=$request->file('files_scan');
            foreach ($files as $qarorfile){
                $filename = time().'.'.$qarorfile->extension();
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

        $bisyorid = Bisyorjoniba::with('fileshartnomaB','fileBisyor')->findOrFail($id);

//        if (FileDel::exists('uploads/shartnoma/'.$bisyorid->fileshartnomaB->name)){
//            FileDel::delete('uploads/shartnoma/'.$bisyorid->fileshartnomaB->name);
//        }
        //$files = File::where("bisyorjoniba_id", $bisyorid->id)->get();
        foreach ( $bisyorid->fileshartnomaB as $item) {
            if (FileDel::exists('uploads/shartnoma/'.$item->name)){
                FileDel::delete('uploads/shartnoma/'.$item->name);
            }
        }
        foreach ( $bisyorid->fileBisyor as $item) {
            if (FileDel::exists('uploads/files/'.$item->name)){
                FileDel::delete('uploads/files/'.$item->name);
            }
        }
        $username= auth()->user()->name;
        $dujonibaname = $bisyorid->name;
        SendEmailDeleteJob::dispatch($dujonibaname,$username);
        $bisyorid->delete();

        return redirect()->back();
    }
    // =================Delete mintaqaho by Shartnoma ID and Country ID =====================

    public function deleteMintaqa(Request $request)
    {
        $shartnomaID = intval($request->id);
        $countryID = intval($request->country);
        $mintaqa = Bisyorjoniba::findOrFail($shartnomaID);

       $mintaqa->countriesB()->newPivotStatement()
            ->where('bisyorjonibas_id', '=', $shartnomaID)
            ->where('countries_id', '=', $countryID)
            ->delete();
        return redirect()->back();
    }

    // =================Delete ezoh by Shartnoma ID and Ezoh ID =====================
    public function deleteEzoh(Request $request)
    {
        $shartnomaID = intval($request->id);
        $ezohID = intval($request->ezoh);
        $ezoh = Bisyorjoniba::findOrFail($shartnomaID);
        $ezoh->ezohB()->newPivotStatement()
            ->where('bisyorjonibas_id', '=', $shartnomaID)
            ->where('ezohs_id', '=', $ezohID)
            ->delete();
        return redirect()->back();
    }

    // ====================Delete aditional files ====================
    public function fileDelete($id)
    {
        $file = FileShartnoma::findOrFail($id);
        if (FileDel::exists('uploads/shartnoma/'.$file->name)){
            FileDel::delete('uploads/shartnoma/'.$file->name);
        }
        $file->delete();
        return redirect()->back();

    }

    // ====================Delete aditional files ====================
    public function deleteFiles($id)
    {
      $fileShartnoma = File::findOrFail($id);
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
