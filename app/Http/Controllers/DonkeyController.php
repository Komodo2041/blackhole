<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class DonkeyController extends Controller
{

    private $masa = 75;
    private $prowiant = 15;

    public function list(Request $request)
    {
        $waga = $request->input('waga', 0);
        $length = $request->input('length', 0);
        $zao = $request->input('zao', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'waga' => 'required|int',
                'length' => 'required|int'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("donkey", ["length" => $length, "waga" => $waga, "zao" => $zao, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $calco['d'] = ceil($validated['length'] / 25);
                $masa = $this->masa;
                if ($zao == 0) {
                    $masa = $masa - $calco['d'] * $this->prowiant;
                }
                if ($masa < 0) {
                    $calco['p'] = 0;
                } else {
                    $calco['o'] = ceil($validated['waga'] / $masa);
                    $calco['p'] = 1;
                }


                return view("donkey", ["length" => $validated['length'], "waga" => $validated['waga'], "zao" => $zao, "calco" => $calco]);
            }
        }
        return view("donkey", ["length" => $length, $length, "waga" => $waga, "zao" => $zao, "calco" => []]);
    }
}
