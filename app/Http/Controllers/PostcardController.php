<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostcardRequest;
use App\Http\Requests\UpdatePostcardRequest;
use App\Models\Postcard;

class PostcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('postcards.index', [
            'postcards' => Postcard::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostcardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Postcard $postcard)
    {
        $previousPostcard = Postcard::where('id', '<', $postcard->id)->where('is_draft', 0)
            ->where(function ($query) {
                $query->where('offline_at', '>', now())
                    ->orWhereNull('offline_at');
            })->orderBy('id', 'desc')->first();

        $nextPostcard = Postcard::where('id', '>', $postcard->id)->where('is_draft', 0)
                ->where(function ($query) {
                    $query->where('offline_at', '>', now())
                        ->orWhereNull('offline_at');
                })->orderBy('id', 'asc')->first();

        return view('postcards.show', compact('postcard','previousPostcard','nextPostcard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postcard $postcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostcardRequest $request, Postcard $postcard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postcard $postcard)
    {
        //
    }
}
