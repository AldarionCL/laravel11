<?php

use App\Models\User;

function branchOfficesFilter( $brand = null ): array
{
    $branches = array();

    $location = User::location()->get();

    $branches[0] = "Todos";

    if ($brand !== null) {
        foreach ($location[0]['sucursales'] as $items) {
            if ($items->GerenciaID === intval($brand)) {
                $branches[$items->ID] = $items->Sucursal;
            }
        }
        return $branches;
    } else {
        foreach ($location[0]['sucursales'] as $key => $items) {
            $branches[$items->ID] = $items->Sucursal;
        }
    }
    return $branches;
}
