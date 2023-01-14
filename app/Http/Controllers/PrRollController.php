<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrRollRequest;
use App\Http\Requests\UpdatePrRollRequest;
use App\Models\PrRoll;
use App\Models\PrCvet;
use App\Models\PrCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class PrRollController extends Controller
{
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

    /**
     * Handle the CSV file upload and create/update rolls.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadCsvFile(Request $request)
    {
        // validate the uploaded file
        $request->validate([
            'csv_file' => 'required|file|mimetypes:text/csv,application/vnd.ms-excel|max:2048',
        ]);

        $file = $request->file('csv_file');
        $file_path = $file->getRealPath();

        // read the CSV file
        $data = array_map('str_getcsv', file($file_path));

        // remove the header row
        array_shift($data);

        // loop through the rows
        foreach ($data as $row) {
            $rollId = $row[0];
            $rollName = $row[1];
            $rollQuantity = $row[2];
            $prCvet = $row[3];

            $category = Category::firstOrCreate(
                ['name' => 'placholder']
            );

            $prCollection = PrCollection::firstOrCreate(
                ['name' => 'placeholder'],
                [
                    'default_price' => 0,
                    'category_id' => $category->id,
                ]
            );

            PrCvet::firstOrCreate(
                ['id' => $prCvet],
                [
                    'name_in_folder' => 'placeholder',
                    'title' => 'placeholder',
                    'pr_collection_id' => $prCollection->id,
                    'current_price' => 0,
                ]
            );

            // check if the roll already exists
            $roll = PrRoll::firstOrCreate(
                ['id' => $rollId],
                [
                    'vendor_code' => $rollName,
                    'quantity_m2' => 0,
                    'pr_cvet_id' => $prCvet,
                ]
            );

            // update the roll's quantity
            $roll->update(['quantity_m2' => $rollQuantity]);
        }
        return redirect()->route('pr_cvets.index')->with('success', 'Csv file uploaded successfully');
    }
}
