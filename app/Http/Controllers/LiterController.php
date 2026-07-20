<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LiterController extends Controller
{
    public function walecOne(Request $request)
    {
        $radius = $request->input('radius', 0);
        $height = $request->input('height', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'radius' => 'required|int',
                'height' => 'required|int'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("walecone", ["height" => $height, "radius" => $radius, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $calco['v'] = $this->calcVolumeRoller($radius, $height);

                return view("walecone", ["height" => $validated['height'], "radius" => $validated['radius'], "calco" => $calco]);
            }
        }
        return view("walecone", ["height" => $height, "radius" => $radius, "calco" => []]);
    }

    private function calcVolumeRoller($r, $h)
    {
        $v = $r * $r * pi() * $h;
        $dm3 = 100 * 100 * 100;
        return round($v / $dm3, 2);
    }
}
