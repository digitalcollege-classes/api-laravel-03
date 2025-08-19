<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Advertisement::with(['product', 'product.category']);

        // Filtros opcionais
        if ($request->has('status')) {
            $query->byStatus($request->status);
        }

        if ($request->has('advertiser_id')) {
            $query->byAdvertiser($request->advertiser_id);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->priceRange($request->min_price, $request->max_price);
        }

        if ($request->has('active_only') && $request->boolean('active_only')) {
            $query->active();
        }

        if ($request->has('published_only') && $request->boolean('published_only')) {
            $query->published();
        }

        $advertisements = $query->paginate(20);
        
        return response()->json([
            'success' => true,
            'data' => $advertisements->items(),
            'pagination' => [
                'current_page' => $advertisements->currentPage(),
                'last_page' => $advertisements->lastPage(),
                'per_page' => $advertisements->perPage(),
                'total' => $advertisements->total(),
            ],
            'message' => 'Advertisements retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'advertiser_id' => 'required|integer',
            'product_id' => 'required|exists:products,id',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
            'status' => 'required|in:active,paused,sold,inactive',
            'published_at' => 'nullable|date',
        ]);

        $advertisement = Advertisement::create($validated);
        $advertisement->load(['product', 'product.category']);

        return response()->json([
            'success' => true,
            'data' => $advertisement,
            'message' => 'Advertisement created successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement): JsonResponse
    {
        $advertisement->load(['product', 'product.category']);
        
        return response()->json([
            'success' => true,
            'data' => $advertisement,
            'message' => 'Advertisement retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $advertisement): JsonResponse
    {
        $validated = $request->validate([
            'advertiser_id' => 'sometimes|required|integer',
            'product_id' => 'sometimes|required|exists:products,id',
            'title' => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
            'status' => 'sometimes|required|in:active,paused,sold,inactive',
            'published_at' => 'nullable|date',
        ]);

        $advertisement->update($validated);
        $advertisement->load(['product', 'product.category']);

        return response()->json([
            'success' => true,
            'data' => $advertisement->fresh(['product', 'product.category']),
            'message' => 'Advertisement updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement): JsonResponse
    {
        try {
            $advertisement->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Advertisement deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting advertisement: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Publish an advertisement.
     */
    public function publish(Advertisement $advertisement): JsonResponse
    {
        $advertisement->publish();

        return response()->json([
            'success' => true,
            'data' => $advertisement->fresh(),
            'message' => 'Advertisement published successfully'
        ]);
    }

    /**
     * Pause an advertisement.
     */
    public function pause(Advertisement $advertisement): JsonResponse
    {
        $advertisement->pause();

        return response()->json([
            'success' => true,
            'data' => $advertisement->fresh(),
            'message' => 'Advertisement paused successfully'
        ]);
    }

    /**
     * Mark advertisement as sold.
     */
    public function markAsSold(Advertisement $advertisement): JsonResponse
    {
        $advertisement->markAsSold();

        return response()->json([
            'success' => true,
            'data' => $advertisement->fresh(),
            'message' => 'Advertisement marked as sold successfully'
        ]);
    }
}