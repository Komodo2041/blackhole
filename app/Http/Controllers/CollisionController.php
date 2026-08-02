<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollisionController extends Controller
{

    private $col = 0.5;

    private $ept = 0.04;

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

    public function lossEnergyNO(Request $request)
    {

        $m1 = $request->input('m1', 0);

        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'm1' => 'required|int',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("collisio2", ["m1" => $m1,  'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $calco = $this->colso($validated['m1'], 32);
                $calco2 = $this->colso($validated['m1'], 28);
                return view("collisio2", ["m1" => $validated['m1'],  "calco" => $calco, "calco2" => $calco2]);
            }
        }
        return view("collisio2", ["m1" => $m1,  "calco" => []]);
    }

    public function nrcol(Request $request)
    {

        $energia = $request->input('energia', 0);
        $procent = $request->input('procent', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'energia' => 'required|numeric',
                'procent' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("nrcol", ["energia" => $energia, "procent" => $procent, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $calco['lz'] = log($this->ept / $validated['energia']) / log($validated['procent']);
                $calco['lz'] = floor($calco['lz']);
                return view("nrcol", ["energia" => $validated['energia'], "procent" => $validated['procent'], "calco" => $calco]);
            }
        }
        return view("nrcol", ["energia" => $energia, "procent" => $procent, "calco" => []]);
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
