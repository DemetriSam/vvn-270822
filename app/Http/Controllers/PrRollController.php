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
    public function renderUploadForm()
    {
        $suppliers = Supplier::all();
        return view('pr_roll.upload_form', compact('suppliers'));
    }

    public function renderCheckPage(InnerRepresentation $innrep)
    {
        return view('pr_roll.check_diff', ['diff' => $innrep->getDiff()]);
    }
    public function checkAgain(Request $request, Slugger $slugger, InnerRepresentation $innrep)
    {
        $request->validate([
            'vendor_code.*' => 'required',
            'quantity_m2.*' => 'required',
            'supplier_id' => 'required',
        ]);
        $vendor_codes = $request->input('vendor_code');
        $quantities_m2 = $request->input('quantity_m2');
        $supplier_id = $request->input('supplier_id');

        $update = [];
        for ($i = 0; $i < count($vendor_codes); $i++) {
            $vendor_code = $vendor_codes[$i];
            $quantity_m2 = $quantities_m2[$i];

            $update[] = compact('vendor_code', 'quantity_m2');
        }

        $update = $slugger
            ->setUniqueSlugs(collect($update), 'vendor_code', 'slug')
            ->map(fn($row) => PrRoll::make($row));

        $current = PrRoll::where('supplier_id', $supplier_id)->get();
        $innrep->createInnerRepresentation($current, $update, $supplier_id);

        return view('pr_roll.check_diff', ['diff' => $innrep->getDiff()]);
    }

    public function renderEditForm(InnerRepresentation $innrep)
    {
        return view('pr_roll.edit_diff', ['diff' => $innrep->getDiff()]);
    }

    public function updateDatabase(Request $request, InnerRepresentation $innrep)
    {
        $request->validate([
            'supplier_id' => 'required',
        ]);
        $supplier_id = $request->supplier_id;

        $innrep
            //clean data from session avoiding repeated call to db with the same data
            ->pullDiff()
            ->each(function ($node) use ($supplier_id) {
                $type = $node['type'];
                $value = $node['value'];

                switch ($type) {
                    case 'added':
                        $value->supplier_id = $supplier_id;
                        PrRoll::create($value->toArray());
                        break;
                    case 'changed':
                        $updated = PrRoll::where('slug', $value['slug'])->first();
                        $updated->quantity_m2 = $value->quantity_m2;
                        $updated->save();
                        break;
                    case 'deleted':
                        $deleted = PrRoll::where('slug', $value['slug'])->first();
                        $deleted->delete();
                        break;
                }
            });

        return redirect()->route('upload.check')
            ->with('success', 'Database is updated successfully');
    }

    /**
     * Handle the Excel file upload and create/update rolls.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadExcelFile(Request $request, Slugger $slugger, InnerRepresentation $innrep)
    {
        $request->validate([
            'excel_file' => 'required|file|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048',
            'supplier_id' => 'required',
        ]);
        $file = $request->file('excel_file');
        $supplier_id = $request->supplier_id;
        $supplier = Supplier::find($supplier_id)->name;

        $import = new PrRollsImport($supplier);
        Excel::import($import, $file);
        $update = $slugger
            ->setUniqueSlugs($import->get(), 'vendor_code', 'slug')
            ->map(fn($row) => PrRoll::make($row));

        $current = PrRoll::where('supplier_id', $supplier_id)->get();

        $innrep->createInnerRepresentation($current, $update, $supplier_id);

        return redirect()->route('upload.check')
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
