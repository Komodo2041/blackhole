<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeanFreePathController extends Controller
{

    private $indAir = 6.6e-3;

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

                return view("pascal", ["pa" => $validated['pa'], "calco" => $calco]);
            }
        }
        return view("pascal", ["pa" => $pa, "calco" => []]);
    }
}
