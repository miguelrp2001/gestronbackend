<?php

namespace App\Rules;

use App\Models\Familia;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class inCentroNuevo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $familiaB = Familia::find($value);
        if (!$familiaB) {
            return false;
        }

        foreach (Auth::user()->centros as $centro) {
            foreach ($centro->familias as $familia) {
                if ($familia->id === $value) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La :attribute seleccionada no pertenece a ningún centro del usuario.';
    }
}