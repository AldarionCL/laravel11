<?php

namespace App\Http\Utils;

use App\Models\User;

class Workplace
{
    private $location;

    public function __construct($visivility = 0)
    {
        $this->location = User::location($visivility)->get();
        //dd($this->location);
    }

    public function business(): \Illuminate\Support\Collection
    {
        $collect = collect();

        foreach ($this->location[0]['sucursales'] as $items)
        {
            if ($items['business'] !== null )
                $collect[] = $items['business'];
        }

        return $collect->unique()->sortBy('Empresa', SORT_NATURAL);
    }

    public function brands( int $id = null, array $tipoSucursalID = null )
    {
        $collect = collect();

        foreach ($this->location[0]['sucursales'] as $items)
        {
            if ( $id === null )
            {
                if ( $items['EmpresaID'] !== null && $items['brand'] !== null )
                    $collect[] = $items['brand'];
            }
            elseif ( $tipoSucursalID !== null )
            {
                if ( $items['EmpresaID'] !== null && $items['brand'] !== null )
                    if ( $items['EmpresaID'] === $id )
                        foreach ( $tipoSucursalID as $type )
                        if ( $items['TipoSucursalID'] === $type )
                        $collect[] = $items['brand'];
            }
            else
            {
                if ( $items['EmpresaID'] !== null && $items['brand'] !== null )
                    if ( $items['EmpresaID'] === $id )
                        $collect[] = $items['brand'];
            }
        }
//        return array_values($collect->unique()->toArray());
        return $collect->unique()->sortBy('Gerencia');
    }

    public function businessAreas( $idBrand )
    {
        $collect = collect();

        foreach ($this->location[0]['sucursales'] as $items)
        {
            if ($items['GerenciaID'] == $idBrand )
            {
                $collect[] = $items['typeOfBranches'];
            }
        }
        return $collect->sortBy('TipoSucursal')->unique()->collapse();
    }

    public function branches( $idBrand, $idZone )
    {
        $collect = collect();

        foreach ($this->location[0]['sucursales'] as $items)
        {
            if ( $items['GerenciaID'] == $idBrand  && $items['TipoSucursalID'] == $idZone )
            {
                $collect[] = $items;
            }
        }

        return $collect->sortBy('Sucursal')->unique();
    }
}
