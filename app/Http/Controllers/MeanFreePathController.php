<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeanFreePathController extends Controller
{

    private $indAir = 6.6e-3;
    private $indAirMinus20 = 5.7e-3;

    public function calcDist(Request $request)
    {
        $pa = $request->input('pascal', 0);

        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'pa' => 'required|int',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("pascal", ["pa" => $pa, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $calco['dist'] = $this->indAir / $validated['pa'];
                $calco['dist2'] = $calco['dist'] * 1000;

                $calco['minus20dist'] = $this->indAirMinus20 / $validated['pa'];
                $calco['minus20dist2'] = $calco['minus20dist'] * 1000;

                return view("pascal", ["pa" => $validated['pa'], "calco" => $calco]);
            }
        }
        return view("pascal", ["pa" => $pa, "calco" => []]);
    }

    public function calcPasc(Request $request)
    {
        $pa = $request->input('pascal', 0);

        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'pa' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("pascal2", ["pa" => $pa, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $calco['res'] = $this->indAir / $validated['pa'];
                $calco['res'] *= 1000;

                $calco['res2'] = $this->indAirMinus20 / $validated['pa'];
                $calco['res2'] *= 1000;

                return view("pascal2", ["pa" => $validated['pa'], "calco" => $calco]);
            }
        }
        return view("pascal2", ["pa" => $pa, "calco" => []]);
    }
}
