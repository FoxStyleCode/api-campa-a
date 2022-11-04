<?php

namespace App\Services;

use App\Models\Crm;

class CreateCrmService {

    public function create($data, $exploded){

        $crm = new Crm();

        //sacar propiedades a guardar en la tabla
        foreach ($data as $key => $value) {

            //cadena de condicionales
            if($value->value == 'Nombre'){
                $nuew_name = $exploded[$value->index];
                $crm->name = $nuew_name;
            }

            if($value->value == 'Telefono'){
                $new_phone = $exploded[$value->index];
                $crm->phone = $new_phone;
            }

            if($value->value == 'Descripcion'){
                $new_description = $exploded[$value->index];
                $crm->description = $new_description;
            }

            if($value->value == 'Dir1'){
                $new_dir1 = $exploded[$value->index];
                $crm->dir1 = $new_dir1;
            }

            if($value->value == 'Dir2'){
                $new_dir2 = $exploded[$value->index];
                $crm->dir2 = $new_dir2;
            }
                
        }

        $crm->save();

    }

}
