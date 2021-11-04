<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\WisataResource;
use App\Models\Wisata;

class WisataController extends Controller
{
    public function index()
    {
        $data = Wisata::latest()->get();
        return response()->json([
            WisataResource::collection($data),
            'Wisatas fetched.',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $wisata = Wisata::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return response()->json([
            'Wisata created successfully.',
            new WisataResource($wisata),
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wisata = Wisata::find($id);
        if (is_null($wisata)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new WisataResource($wisata)]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wisata $wisata)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $wisata->name = $request->name;
        $wisata->address = $request->address;
        $wisata->description = $request->description;
        $wisata->category = $request->category;
        $wisata->save();

        return response()->json([
            'Wisata updated successfully.',
            new WisataResource($wisata),
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wisata $wisata)
    {
        $wisata->delete();
        return response()->json('Program deleted successfully');
    }
}
