<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        return view('api-form');
    }

    public function fetchProducts(Request $request)
    {
        $apiUrl = $request->query('api_url');

        if (!$apiUrl) {
            return redirect('/')
                ->with('error', 'Please enter an API URL.');
        }

        try {

            $response = Http::timeout(10)->get($apiUrl);

            if (!$response->successful()) {
                return redirect('/')
                    ->with('error', 'Unable to fetch data from this API.');
            }

            $json = $response->json();

            $data = $json['data'] ?? [];

            /*
            |--------------------------------------------------------------------------
            | Handle both:
            |
            | GET /api/v1/products
            | => data is an array of products
            |
            | GET /api/v1/products/2
            | => data is one product object
            |--------------------------------------------------------------------------
            */

            if (isset($data['id'])) {

                // Single product
                $products = [$data];

            } elseif (is_array($data)) {

                // Multiple products
                $products = $data;

            } else {

                $products = [];
            }

            return view('products', [
                'products' => $products,
                'api_url' => $apiUrl,
            ]);

        } catch (\Throwable $e) {

            return redirect('/')
                ->with('error', 'Could not connect to the API.');
        }
    }
}