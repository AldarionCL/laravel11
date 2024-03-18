<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\InvokableRule;

class RutUniqueUserTable implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        $rut =  preg_replace('([^A-Za-z0-9])', '', $value );

        if( User::where('Rut', $rut)->count() ){
            $fail( 'El :attribute ya existe en base de datos');
        }
    }
}
