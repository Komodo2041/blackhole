<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JoinCalcoController extends Controller
{

    private $unit_kg = 1.66e-27;
    private $electrov = 1.602e-19;
    private $col = 0.5;
    private $ept = 0.04;

    public function list(Request $request)
    {
        $unit1 = $request->input('unit1', 0);
        $unit2 = $request->input('unit2', 0);
        $speed = $request->input('speed', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'unit1' => 'required|int',
                'unit2' => 'required|int',
                'speed' => 'required|int'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("joinCalco", ["unit1" => $unit1,  "unit2" => $unit2, "speed" => $speed, 'errorforms' => implode(", ", $validated), "calco" => []]);
            } else {
                $validated = $validator->validated();

                $masa = $validated['unit1'] * $this->unit_kg;
                $mk = ($validated['speed'] * $validated['speed'] * $masa) / 2;
                $calco['en1'] =  $mk / $this->electrov;
                $masa = $validated['unit2'] * $this->unit_kg;
                $mk = ($validated['speed'] * $validated['speed'] * $masa) / 2;
                $calco['en2'] =  $mk / $this->electrov;

                $calco['proc1_o'] = $this->colso($validated['unit1'], 32);
                $calco['proc1_n'] = $this->colso($validated['unit1'], 28);
                $calco['proc1_h'] = $this->colso($validated['unit1'], 4);

                $calco['proc2_o'] = $this->colso($validated['unit2'], 32);
                $calco['proc2_n'] = $this->colso($validated['unit2'], 28);
                $calco['proc2_h'] = $this->colso($validated['unit2'], 4);

                $calco['z1_o'] = $this->ept < $calco['en1'] ? log($this->ept / $calco['en1']) / log($calco['proc1_o']) : "NONE";
                $calco['z1_n'] = $this->ept < $calco['en1'] ? log($this->ept / $calco['en1']) / log($calco['proc1_n']) : "NONE";
                $calco['z1_h'] = $this->ept < $calco['en1'] ? log($this->ept / $calco['en1']) / log($calco['proc1_h']) : "NONE";

                $calco['z2_o'] = $this->ept < $calco['en2'] ? log($this->ept / $calco['en2']) / log($calco['proc2_o']) : "NONE";
                $calco['z2_n'] = $this->ept < $calco['en2'] ? log($this->ept / $calco['en2']) / log($calco['proc2_n']) : "NONE";
                $calco['z2_h'] = $this->ept < $calco['en2'] ? log($this->ept / $calco['en2']) / log($calco['proc2_h']) : "NONE";

                return view("joinCalco", ["unit1" => $validated['unit1'], "unit2" => $validated['unit2'], "speed" => $validated['speed'], "calco" => $calco]);
            }
        }
        return view("joinCalco", ["unit1" => $unit1,  "unit2" => $unit2, "speed" => $speed, "calco" => []]);
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
        return $calco['proc'];
    }
}
