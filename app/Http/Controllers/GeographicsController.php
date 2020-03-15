<?php

namespace App\Http\Controllers;

use App\Geographic;
use Illuminate\Http\Request;
use App\Imports\GeographicImport;
use Maatwebsite\Excel\Facades\Excel;

class GeographicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $geographics = Geographic::orderBy('id')->paginate(5);
        return view('admin.geoindex',compact('geographics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'namawilayah' => 'required',
            'kemiringanlereng' => 'required|numeric',
            'jenistanah' => 'required|numeric',
            'curahhujan' => 'required|numeric'
        ]);
        Geographic::create($request->all());      
        return redirect()->route('geographics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Geographic  $geographic
     * @return \Illuminate\Http\Response
     */
    public function show(Geographic $geographic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Geographic  $geographic
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $geographics = Geographic::find($id);
        return response()->json($geographics);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Geographic  $geographic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'namawilayah' => 'required',
            'kemiringanlereng' => 'required|numeric',
            'jenistanah' => 'required|numeric',
            'curahhujan' => 'required|numeric'
        ]);
        $geographics = Geographic::findOrFail($request->id);
        $geographics->update($request->all());
        return redirect()->route('geographics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Geographic  $geographic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $geographics = Geographic::find($id);
        // return $geographics;
        $geographics->delete();
        return redirect()->route('geographics.index');
    }

    public function importexcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx'        
        ]);
        // $file = $request->file('file');
        Excel::import(new GeographicImport,$request->file('file'));                
        return redirect()->route('geographics.index');
    }
}
