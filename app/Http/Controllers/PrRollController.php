<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrRollRequest;
use App\Http\Requests\UpdatePrRollRequest;
use App\Models\PrRoll;
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

        $supplier_id = Supplier::firstOrCreate(['name' => $supplier])->id;
        $current = PrRoll::where('supplier_id', $supplier_id)->get();

        $innrep->createInnerRepresentation($current, $update);
        // dump(
        //     $innrep
        //         ->getDiff()
        //         ->map(
        //             fn ($row) => [
        //                 $row['type'],
        //                 'slug' => isset($row['value']) ? $row['value']->slug : $row['value1']->slug,
        //                 'value1' => isset($row['value1']) ? $row['value1']->quantity_m2 : $row['value']->quantity_m2,
        //                 'value2' => isset($row['value2']) ? $row['value2']->quantity_m2 : $row['value']->quantity_m2,
        //             ]
        //         )
        //         ->toArray()
        // );

        $innrep
            ->getDiff()
            ->reject(fn ($node) => empty($node))
            ->each(function ($node) use ($supplier_id) {
                $type = $node['type'];
                $value = $node['value'];

                switch ($type) {
                    case 'added':
                        $value->supplier_id = $supplier_id;
                        PrRoll::create($node['value']->toArray());
                        break;
                    case 'changed':
                        $updated = PrRoll::where('slug', $value['slug'])->first();
                        $updated->quantity_m2 = $value->quantity_m2;
                        $updated->save();
                        break;
                    case 'deleted':
                        $deleted = PrRoll::where('slug', $value['slug'])->first();
                        $deleted->delete();
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
