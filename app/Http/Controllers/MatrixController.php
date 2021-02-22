<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MatrixService;

class MatrixController extends Controller
{
    public function multiply(Request $request, MatrixService $service)
    {
        $validated = $request->validate([
            'matrix1' => 'required|array',
            'matrix2' => 'required|array',
        ]);

        // note: more backend validation should be done here in a real world app (matrix values, validity etc.)

        $product = $service->multiply(
            $request->matrix1,
            $request->matrix2
        );

        return response()->json([
            'message' => 'Success',
            'data' => $product
        ]);
    }
}