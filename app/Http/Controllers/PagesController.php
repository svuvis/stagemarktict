<?php

namespace App\Http\Controllers;

use App\Inschijving;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

class PagesController extends Controller
{
    public function inschrijven(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'workshop' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'studentnummer' => 'required|int|max:2147483647',
        ]);

        if ($validator->fails()) {
            return redirect('/#download')
                ->withErrors($validator)
                ->withInput();
        }
        $request->session()->flash('inschrijvingStatus', 'Inschrijving gelukt!');
        Inschijving::create($request->all());
        return redirect('/#download');
    }
}
