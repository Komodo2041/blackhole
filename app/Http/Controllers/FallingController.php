<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FallingController extends Controller
{
    public function list(Request $request)
    {

        $pom1 = $request->input('h_m', 0);
        $pom2 = $request->input('h_km', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'h_m' => 'required|int',
                'h_km' => 'required|int'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("falling", ["h_m" => $validated['h_m'], "h_km" => $validated['h_km'], 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();
                $height = $validated['h_m'];
                if ($validated['h_km'] > 0) {
                    $height = 1000 * $validated['h_km'];
                }
                $calco['h'] = $height;
                $calco['t'] = sqrt((2 * $height) / 9.81);
                $calco['v'] = sqrt(2 * 9.81 * $height);
                return view("falling", ["h_m" => $validated['h_m'], "h_km" => $validated['h_km'], "calco" => $calco]);
            }
        }
        return view("falling", ["h_m" => $pom1, "h_km" => $pom2, "calco" => []]);
    }
}
