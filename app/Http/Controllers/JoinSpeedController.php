<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JoinSpeedController extends Controller
{

    private $speed2 = 570;

    public function list(Request $request)
    {

        set_time_limit(600);

        $speed = $request->input('speed', 0);

        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'speed' => 'required|int',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("joinspeed", ["speed" =>  $speed,  'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $calco = $this->calcDisto($validated['speed']);

                return view("joinspeed", ["speed" => $validated['speed'],  "calco" => $calco]);
            }
        }
        return view("joinspeed", ["speed" =>  $speed, "calco" => []]);
    }

    private function calcDisto($speed)
    {
        $res = [];
        for ($i = 0; $i <= 90; $i += 10) {
            $angle = deg2rad($i);
            $bottom = cos($angle) * $this->speed2;
            $top = sin($angle) * $this->speed2;
            $bottom += $speed;
            $vnew = sqrt(pow($bottom, 2) + pow($top, 2));
            $tan = atan2($top, $bottom);
            $angletan = rad2deg($tan);
            $res[$i] = [
                'angle' => $angletan,
                'v' => $vnew
            ];
        }
        return $res;
    }
}
