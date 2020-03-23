<?php

namespace App\Http\Controllers;

use App\Disaster;
use Illuminate\Http\Request;
use App\Imports\DisasterImport;
use App\Exports\DisasterExport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DisastersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $disasters = Disaster::orderBy('id')->paginate(5);
        return view('admin.disasterindex',compact('disasters'));

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
            'jumlahkejadian' => 'required|numeric',
            'jumlahkorban' => 'required|numeric',
            'jumlahkerusakan' => 'required|numeric'
        ]);
        Disaster::create($request->all());      
        return redirect()->route('disasters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disaster  $disaster
     * @return \Illuminate\Http\Response
     */
    public function show(Disaster $disaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disaster  $disaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $disasters = Disaster::find($id);
        return response()->json($disasters);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disaster  $disaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {      
        // return $request;
        $request->validate([
            'namawilayah' => 'required',
            'jumlahkejadian' => 'required|numeric',
            'jumlahkorban' => 'required|numeric',
            'jumlahkerusakan' => 'required|numeric'
        ]);
        $disasters = Disaster::findOrFail($request->id);
        $disasters->update($request->all());
        return redirect()->route('disasters.index');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disaster  $disaster
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $disasters = Disaster::find($id);
        // return $disasters;
        $disasters->delete();
        return redirect()->route('disasters.index');
    }
    
    public function exportexcel(){
        return Excel::download(new DisasterExport(), 'disasterExcel.xlsx');
        // return "hello";
    }

    public function importexcel(Request $request){      

        // dd($request);
        $request->validate([
            'file' => 'required|mimes:xlsx'        
        ]);
        Excel::import(new DisasterImport,$request->file('file'));        
        //Excel::import(new DisasterImport,$request->file('file'),\Maatwebsite\Excel\Excel::XLSX);            
        return redirect()->route('disasters.index');
    }

}
