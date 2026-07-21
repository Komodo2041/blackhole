<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SinusController extends Controller
{
    public function list(Request $request)
    {
        $angle = $request->input('angle', 0);
        $length = $request->input('length', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'length' => 'required|int',
                'angle' => 'required|int'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("sinus", ["length" => $length, "angle" => $angle, 'errorforms' => implode(", ", $validated), "calco" => []]);
            } else {
                $validated = $validator->validated();
                $kat_radiany = deg2rad($validated['angle']);
                $tangens = tan($kat_radiany);
                $calco['h'] =  $validated['length'] * $tangens;

                return view("sinus", ["length" => $validated['length'], "angle" => $validated['angle'], "calco" => $calco]);
            }
        }
        return view("sinus", ["length" => $length, "angle" => $angle, "calco" => []]);
    }
}
