<?php

namespace App\Http\Controllers\Dujoniba;

use App\Http\Controllers\Controller;
use App\Models\Dujoniba;
use App\Models\File;
use App\Models\FileShartnoma;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DujonibaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
         //dd($request->namud);

         //dd($namud);
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
            'sanai_etibor'	=> $request->sanai_etibor,
            'qati_etibor' => $request->muhlatEnd,
            'imzo_tj' => $request->imzo_tj,
            'imzo_digar' => $request->imzo_digar,
            'ezoh' => $request->ezoh,
            'namudi_shartnoma_id'=> intval($request->namud),
            'tartibi_etibor_id'=> intval($request->tartib),
            'muhlati_etibor_id' => intval($request->muhlat),
        ]);
        return redirect()->route('index');
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
