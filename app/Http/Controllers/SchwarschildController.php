<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchwarschildController extends Controller
{

    private $c = 299792458; // m/s 
    private $g = 6.67e-11;

    public function list(Request $request)
    {


        $length = $request->input('length', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'length' => 'required|int|max:1999999999',
            ]);

            if ($validator->fails()) {

                $validated = $validator->errors()->all();
                return view("schawrzschild", ["length" => $length, 'errorforms' => implode(", ", $validated), "calco" => []]);
            } else {
                $validated = $validator->validated();

                $m = ($validated['length'] * $this->c * $this->c) / ($this->g * 2);
                $calco['km'] = $validated['length'] / 1000;
                $calco['m'] = $m;
                $density = ($validated['length'] * $validated['length'] * $validated['length'] * pi() * 4) / 3;
                $calco['density'] = $m / $density;

                return view("schawrzschild", ["length" => $validated['length'], "calco" => $calco]);
            }
        }
        return view("schawrzschild", ["length" => $length, "calco" => []]);
    }
}
