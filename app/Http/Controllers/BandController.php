<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class BandController extends Controller
{
    public function getAll(){

        $bands = $this->getBands();

        return response()->json($bands);
    }

    public function getById($id){
        $band = null;

        foreach($this->getBands() as $_band) {
            if($_band['id'] == $id)
                $band = $_band;
        }

        return $band ? response()->json($band) : abort(404);

    }

    public function getBandsByGender($gender){

        //dd($gender); 

        $bands = [];

        foreach($this->getBands() as $_band) {
            if($_band['gender'] == $gender)
                $bands[] = $_band;
        }

        return response()->json($bands);
    }

    public function store(Request $request){
        //dd($request->all());
        $validated = $request->validate([
            "id" => 'numeric',
            'name' => 'required|min:3',
            'body' => 'required',
        ]);

        return response()->json($request->all());
    }

    protected function getBands(){
        return [
            [
                'id' => 1, 'name' => 'deam teather', 'gender' => 'progressivo'
            ],
            [
                'id' => 2, 'name' => 'Megadeth', 'gender' => 'Trash Metal'
            ],
            [
                'id' => 3, 'name' => 'Dio', 'gender' => 'Heavy Metal'
            ],
            [
                'id' => 4, 'name' => 'Metallica', 'gender' => 'Heavy Metal'
            ],
            [
                'id' => 5, 'name' => 'Barões da pisadinha', 'gender' => 'Tecno Forro'
            ],
        ];
    }
}
