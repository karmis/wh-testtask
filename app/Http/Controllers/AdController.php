<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\Ads\AdCollection;
use App\Http\Resources\Collections\Ads\AdsCollection;
use App\Models\Ad;
use Exception;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = $request->get('sort_field', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if (!in_array($sortField, ['price', 'created_at'])) {
            $sortField = 'created_at';
        }

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }
        return new AdsCollection(Ad::orderBy($sortField, $sortOrder)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required|max:1000',
            'photos' => 'array|max:3',
            'photos.*' => 'url',
            'price' => 'required|numeric',
        ]);

        try {
            $advertisement = Ad::create($request->all());

            return response()->json([
                'id' => $advertisement->id,
                'status' => 'success'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new AdCollection(Ad::findOrFail($id));
    }
}
