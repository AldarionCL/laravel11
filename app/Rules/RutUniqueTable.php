<?php

namespace App\Rules;

use App\Models\OrderRequest\Provider;
use Illuminate\Contracts\Validation\InvokableRule;

class RutUniqueTable implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $rut =  preg_replace('([^A-Za-z0-9])', '', $value );

        if( Provider::where('rut', $rut)->count() ){
            $fail( 'El :attribute ya existe en base de datos');
        }
    }
}
