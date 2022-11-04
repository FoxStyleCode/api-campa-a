<?php

namespace App\Http\Controllers;

use App\Models\Crm;
use App\Services\createCrm;
use App\Services\createCrmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{

    public $createCRM;
    

    public function __construct(createCrmService $createCRM)
    {
        $this->createCRM = $createCRM;
    }


    public function upload(Request $request){

        $order      = $request->get('order');
        $path       = Storage::putFile('files', $request->file('file'));
       
        $data = json_decode($order);

        $contents = Storage::get($path);
    
        $lines = explode("\n", $contents);

        foreach ($lines as $key => $value) {

            $exploded = $this->multiexplode(array(",",".","%",":"), $value);

            $this->createCRM->create($data, $exploded);

        }

    
        return response()->json($order, 200);

    }

    public function multiexplode($delimiters,$string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }


}
