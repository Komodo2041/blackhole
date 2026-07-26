<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitMolController extends Controller
{

    private $unit_kg = 1.66e-27;
    private $electrov = 1.602e-19;

    private $elctroProg = 0.05;

    public function list(Request $request)
    {
        $unit = $request->input('unit', 0);
        $speed = $request->input('speed', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'unit' => 'required|int',
                'speed' => 'required|int'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("unitmol", ["unit" => $unit, "speed" => $speed, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $masa = $validated['unit'] * $this->unit_kg;
                $mk = ($validated['speed'] * $validated['speed'] * $masa) / 2;
                $calco['res'] =  $mk / $this->electrov;
                $calco['p'] = 0;
                if ($calco['res'] >= $this->elctroProg) {
                    $calco['p'] = 1;
                }
                if ($calco['p'] == 0) {
                    $diff = $this->elctroProg / $calco['res'];
                    $calco['needm'] = $diff * $validated['unit'];
                    $calco['needs'] = ($this->elctroProg * $this->electrov * 2) / $masa;
                    $calco['needs'] = sqrt($calco['needs']);
                }

                return view("unitmol", ["unit" => $validated['unit'], "speed" => $validated['speed'], "calco" => $calco]);
            }
        }
        return view("unitmol", ["unit" => $unit, "speed" => $speed, "calco" => []]);
    }
}
