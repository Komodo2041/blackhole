<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RotationController extends Controller
{
    public function list(Request $request)
    {
        $rotation = $request->input('rotation', 0);
        $length = $request->input('length', 0);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'length' => 'required|int',
                'rotation' => 'required|int'
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("rotation", ["length" => $length, "rotation" => $rotation, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $trase = $validated['length'] * 2 * pi();
                $all = $trase * $validated['rotation'];
                $velocity =  $all / 60;
                $velocity = $velocity / 100; // M/S
                $calco['v'] = $velocity;
                $calco['g'] = $velocity * $velocity * ($validated['length'] / 100);
                $calco['g'] = $calco['g'] / 9.81;

                return view("rotation", ["length" => $validated['length'], "rotation" => $validated['rotation'], "calco" => $calco]);
            }
        }
        return view("rotation", ["length" => $length, "rotation" => $rotation, "calco" => []]);
    }
}
