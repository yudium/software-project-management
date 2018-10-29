<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArrayValidationController extends Controller
{
    public function test(Request $request)
    {
        $validatedData = $request->validate([
            'user_name.*' => 'string',
        ]);

        dd($request->all());

    }
}
