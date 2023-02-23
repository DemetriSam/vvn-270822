<?php

namespace App\Http\Controllers;

use App\Mail\MeteringRequested;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MeteringFormController extends Controller
{
    public function sendRequest(Request $request)
    {
        $data = $request->input();
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'personal_data_confirmed' => 'required',
        ]);
        $validated = collect($data)->only('name', 'phone', 'address')->toArray();
        DB::table('mesurements')->insert($validated);
        Mail::to(User::where('email', 'samartsew@gmail.com')->get())
            ->send(new MeteringRequested($validated));
        $request->session()->flash('message', 'Запрос на вызов дизайнера отправлен. Скоро с вами свяжутся!');
        return redirect()->route('index');
    }
}
