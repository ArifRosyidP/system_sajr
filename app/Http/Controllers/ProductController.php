<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // if ($oldImage){
    //     Storage::disk('public')->delete($oldImage);
    // }
    public function store(ProductRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $request->file('image')->store('images', 'public');
            $data['image'] = $request->file('image')->hashName();
        }

        $data['uuid'] = Str::uuid();
        $data['slug'] = Str::slug($data['name']);
        Product::create($data);
        return response()->json([
            'title' => "Good job!", 'text' => 'Product updated successfully', 'icon' => "success"
        ]);
    }

    /**
     * Display the specified resource.
     */
    // 'data' => Product::where('uuid', $id)->firstOrFail()
    public function show(string $id) : JsonResponse
    {
        try {
            return response()->json([
            // 'data' => Product::find($id)
            'data' => Product::where('uuid', $id)->firstOrFail()
            ]);
        } catch (Exception $th) {
            return response()->json([
            'title' => "Error!", 'text' => $th->getMessage(), 'icon' => "error"
            ]);
        }  
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */



    // $product = Product::where('uuid', $id)->firstOrFail();
    // $product->uuid = str::uuid();
    // $product->name = $data['name'];
    // $product->slug = Str::slug($data['name']);
    // $product->description = $data['description'];
    // $product->price = $data['price'];
    // $product->save();
    // $data['uuid'] = Str::uuid();
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $product = Product::where('uuid', $id)->firstOrFail();
            $data['slug'] = Str::slug($data['name']);
            // cek apakah ada gambar baru
            if ($request->hasFile('image')) {

                // hapus gambar lama
                if ($product->image) {
                    Storage::disk('public')->delete('images/'.$product->image);
                }

                // simpan gambar baru
                $image = $request->file('image');
                $image->store('images', 'public');

                $data['image'] = $image->hashName();
            }
            Product::where('uuid', $id)->update($data);

            return response()->json([
            'title' => "Good job!", 'text' => 'Product updated successfully', 'icon' => "success"
        ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
    */
    // Product::destroy($id);
    public function destroy(string $id)
    {
        $product = Product::where('uuid', $id)->firstOrFail();
        // hapus gambar jika ada
        if ($product->image && Storage::disk('public')->exists('images/'.$product->image)) {
            Storage::disk('public')->delete('images/'.$product->image);
        }
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

    public function serversideTable(Request $request){
        $product = Product::get();
        return DataTables::of($product)
        ->addIndexColumn()
        ->editColumn('image', function ($row) {
            return '<div class="text-center"> 
            <a href="' . asset('storage/images/' . $row->image) . '" target="_blank">
                <img src="' . asset('storage/images/' . $row->image) . '" alt="' . $row->name . '" class="img-fluid">
            </a>
            </div>';
        })
        ->addColumn('action', function ($row) {
            return '<div class="text-center"> 
            <button class="btn btn-sm btn-success" onClick="editModal(this)" style="width: 70px" data-id="' . $row->uuid . '">Edit</button> 
            <button class="btn btn-sm btn-danger" onClick="deleteModal(this)" style="width: 70px" data-id="' . $row->uuid . '">Delete</button> 
            </div>';
        })
        ->rawColumns(['image', 'action'])
        ->make();
    }

    // public function uploadImage(array $data, string $oldImage = null){
    //     $img = $data['image'];
    //     $img->store('image', 'public');

    //     if ($oldImage){
    //         Storage::disk('public')->delete($oldImage);
    //     }
    // }
}
