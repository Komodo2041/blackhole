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
                return view("walecone", ["height" => $height, "radius" => $radius, 'errorforms' => implode(", ", $validated), "f" => 1]);
            } else {
                $validated = $validator->validated();

                $calco['v'] = $this->calcVolumeRoller($radius, $height);

                return view("walecone", ["height" => $validated['height'], "radius" => $validated['radius'], "calco" => $calco, "f" => 1]);
            }
        }
        return view("walecone", ["height" => $height, "radius" => $radius, "calco" => [], "f" => 1]);
    }

    private function calcVolumeRoller($r, $h)
    {
        $v = $r * $r * pi() * $h;
        $dm3 = 100 * 100 * 100;
        return round($v / $dm3, 2);
    }

    public function walecTwo(Request $request)
    {
        $radius1 = $request->input('radius1', 0);
        $height1 = $request->input('height1', 0);
        $radius2 = $request->input('radius2', 0);
        $height2 = $request->input('height2', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'radius1' => 'required|int',
                'height1' => 'required|int',
                'radius2' => 'required|int',
                'height2' => 'required|int',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("walectwo", [
                    "height1" => $height1,
                    "radius1" => $radius1,
                    "height2" => $height2,
                    "radius2" => $radius2,
                    'errorforms' => implode(", ", $validated),
                    "calco" => [],
                    "f" => 1
                ]);
            } else {
                $validated = $validator->validated();

                $calco['v1'] = $this->calcVolumeRoller($radius1, $height1);
                $calco['v2'] = $this->calcVolumeRoller($radius2, $height2);
                $calco['sum'] =  $calco['v1'] + $calco['v2'];
                return view("walectwo", [
                    "height1" => $validated['height1'],
                    "radius1" => $validated['radius1'],
                    "height2" => $validated['height2'],
                    "radius2" => $validated['radius2'],
                    "calco" => $calco,
                    "f" => 1
                ]);
            }
        }
        return view("walectwo", ["height1" => $height1, "radius1" => $radius1, "height2" => $height2, "radius2" => $radius2, "calco" => [], "f" => 1]);
    }

    public function stozekcOne(Request $request)
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
                return view("walecone", ["height" => $height, "radius" => $radius, 'errorforms' => implode(", ", $validated), "f" => 2]);
            } else {
                $validated = $validator->validated();

                $calco['v'] = $this->calcVolumeCone($radius, $height);

                return view("walecone", ["height" => $validated['height'], "radius" => $validated['radius'], "calco" => $calco, "f" => 2]);
            }
        }
        return view("walecone", ["height" => $height, "radius" => $radius, "calco" => [], "f" => 2]);
    }

    private function calcVolumeCone($r, $h)
    {
        $v = ($r * $r * pi() * $h) / 3;
        $dm3 = 100 * 100 * 100;
        return round($v / $dm3, 2);
    }

    public function stozekTwo(Request $request)
    {
        $radius1 = $request->input('radius1', 0);
        $height1 = $request->input('height1', 0);
        $radius2 = $request->input('radius2', 0);
        $height2 = $request->input('height2', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'radius1' => 'required|int',
                'height1' => 'required|int',
                'radius2' => 'required|int',
                'height2' => 'required|int',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("walectwo", [
                    "height1" => $height1,
                    "radius1" => $radius1,
                    "height2" => $height2,
                    "radius2" => $radius2,
                    'errorforms' => implode(", ", $validated),
                    "calco" => [],
                    "f" => 2
                ]);
            } else {
                $validated = $validator->validated();

                $calco['v1'] = $this->calcVolumeRoller($radius1, $height1);
                $calco['v2'] = $this->calcVolumeRoller($radius2, $height2);
                $calco['sum'] = max($calco['v1'], $calco['v2']) - min($calco['v1'], $calco['v2']);

                return view("walectwo", [
                    "height1" => $validated['height1'],
                    "radius1" => $validated['radius1'],
                    "height2" => $validated['height2'],
                    "radius2" => $validated['radius2'],
                    "calco" => $calco,
                    "f" => 2
                ]);
            }
        }
        return view("walectwo", ["height1" => $height1, "radius1" => $radius1, "height2" => $height2, "radius2" => $radius2, "calco" => [], "f" => 2]);
    }
}
