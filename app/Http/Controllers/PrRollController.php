<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrRollRequest;
use App\Http\Requests\UpdatePrRollRequest;
use App\Models\PrRoll;
use App\Models\PrCvet;
use App\Models\PrCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PrRollsImport;
use App\Services\Stockupdate\Slugger;

class PrRollController extends Controller
{

    /**
     * Handle the Excel file upload and create/update rolls.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadExcelFile(string $supplier, Request $request, Slugger $slugger)
    {
        $request->validate([
            'excel_file' => 'required|file|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048',
        ]);
        $file = $request->file('excel_file');
        $import = new PrRollsImport($supplier);
        Excel::import($import, $file);
        
        $sluged = $slugger->setUniqueSlugs($import->get(), 'vendor_code', 'slug');
        dump($sluged->pluck('slug'));
        return redirect()->route('pr_cvets.index')
            ->with('success', 'Excel file uploaded successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrRollRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrRollRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrRoll  $prRoll
     * @return \Illuminate\Http\Response
     */
    public function show(PrRoll $prRoll)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrRoll  $prRoll
     * @return \Illuminate\Http\Response
     */
    public function edit(PrRoll $prRoll)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrRollRequest  $request
     * @param  \App\Models\PrRoll  $prRoll
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrRollRequest $request, PrRoll $prRoll)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrRoll  $prRoll
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrRoll $prRoll)
    {
    }


}
