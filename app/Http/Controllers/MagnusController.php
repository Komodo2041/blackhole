<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MagnusController extends Controller
{
    public function list(Request $request)
    {
        $rotation = $request->input('rotation', 0);
        $length = $request->input('length', 0);
        $v = $request->input('v', 0);
        $destinity = $request->input('destinity', 0);
        $L = $request->input('L', 0);
        $save =  $request->input('save');

        if ($save) {

            $validator = Validator::make($request->all(), [
                'length' => 'required|int',
                'rotation' => 'required|int',
                'v' => 'required|int',
                'L' => 'required|int',
                'destinity' => 'required|int',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("magnus", ["length" => $length, "rotation" => $rotation, "L" => $L, "v" => $v, "destinity" => $destinity, 'errorforms' => implode(", ", $validated)]);
            } else {
                $validated = $validator->validated();

                $velocity = ($validated['rotation'] * 2 * pi()) / 60;
                $length = $validated['length'] / 100;
                $L =  $validated['L'] / 100;

                $calco['m'] = 2 * pi() * $validated['destinity'] * $validated['v'] * $velocity * $length * $length * $L;

                return view("magnus", ["length" => $validated['length'], "rotation" => $validated['rotation'], "L" => $validated['L'], "v" => $v, "destinity" => $destinity, "calco" => $calco]);
            }
        }
        return view("magnus", ["length" => $length, "rotation" => $rotation, "L" => $L, "v" => $v, "destinity" => $destinity, "calco" => []]);
    }
}
