<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SinusController extends Controller
{
    public function list(Request $request)
    {

        $path =  $request->segment(1);

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
                return view("sinus", ["length" => $length, "angle" => $angle, 'errorforms' => implode(", ", $validated), "calco" => [], "path" => $path]);
            } else {
                $validated = $validator->validated();
                $kat_radiany = deg2rad($validated['angle']);
                $res = 1;
                switch ($path) {
                    case "tanges":
                        $res = tan($kat_radiany);
                        break;
                    case "sinus":
                        $res = sin($kat_radiany);
                        break;
                    case "cosinus":
                        $res = cos($kat_radiany);
                        break;
                    case "ctg":
                        $res =  1 / tan($kat_radiany);
                        break;
                }

                $calco['h'] =  $validated['length'] * $res;

                return view("sinus", ["length" => $validated['length'], "angle" => $validated['angle'], "calco" => $calco, "path" => $path]);
            }
        }
        return view("sinus", ["length" => $length, "angle" => $angle, "calco" => [], "path" => $path]);
    }
}
