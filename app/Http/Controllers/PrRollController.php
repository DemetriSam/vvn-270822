<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrRollRequest;
use App\Http\Requests\UpdatePrRollRequest;
use App\Models\PrRoll;
use App\Models\PrCvet;
use App\Models\PrCollection;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PrRollsImport;
use App\Services\Stockupdate\Slugger;
use App\Services\Stockupdate\InnerRepresentation;

class PrRollController extends Controller
{

    /**
     * Handle the Excel file upload and create/update rolls.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadExcelFile(string $supplier, Request $request, Slugger $slugger, InnerRepresentation $innrep)
    {
        $request->validate([
            'excel_file' => 'required|file|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048',
        ]);
        $file = $request->file('excel_file');

        $import = new PrRollsImport($supplier);
        Excel::import($import, $file);

        $update = $slugger
            ->setUniqueSlugs($import->get(), 'vendor_code', 'slug')
            ->map(fn ($row) => PrRoll::make($row));

        //create test data in db
        PrRoll::factory()
            ->for(Supplier::firstOrCreate(['name' => $supplier]))
            ->count(3)
            ->create(['vendor_code' => 'old']);

        PrRoll::factory()
            ->for(Supplier::firstOrCreate(['name' => $supplier]))
            ->count(3)
            ->create(['vendor_code' => 'same']);

        $current = PrRoll::where(
            'supplier_id',
            Supplier::where('name', $supplier)->first()->id,
        )->get();

        $current = $slugger
            ->setUniqueSlugs($current, 'vendor_code', 'slug')
            ->each(fn ($row) => $row->save());

        $innrep->createInnerRepresentation($current, $update);
        dump(
            $innrep
                ->getDiff()
                ->map(
                    fn ($row) => [
                        $row['type'],
                        'slug' => isset($row['value']) ? $row['value']->slug : $row['value1']->slug
                    ]
                )
                ->toArray()
        );
        $innrep->getDiff()->each(function ($node) {
            $type = $node['type'];

            switch ($type) {
                case 'added':
            }
        });


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
