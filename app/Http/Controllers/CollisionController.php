<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollisionController extends Controller
{

    private $col = 0.5;

    public function lossEnergy(Request $request)
    {

        $m1 = $request->input('m1', 0);
        $m2 = $request->input('m2', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'm1' => 'required|int',
                'm2' => 'required|int'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("collisio", ["m1" => $m1, "m2" => $m2, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $calco = $this->colso($validated['m1'], $validated['m2']);
                return view("collisio", ["m1" => $validated['m1'], "m2" => $validated['m2'], "calco" => $calco]);
            }
        }
        return view("collisio", ["m1" => $m1, "m2" => $m2, "calco" => []]);
    }

    private function colso($m1, $m2)
    {
        $calco = [];
        $top = 4 * $m2 * $m1;
        $bottom = $m2 + $m1;
        $bottom *= $bottom;
        $res = $top / $bottom;
        $calco['res'] = $res * $this->col;
        $calco['proc'] = 1 - $calco['res'];
        $calco['c10'] = pow($calco['proc'], 10);
        return $calco;
    }
}
