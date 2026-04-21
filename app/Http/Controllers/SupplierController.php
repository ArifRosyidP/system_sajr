<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index(): View
    {
        return view('po.suppliers', ['title' => 'Supplier']);
    }

    public function store(SupplierRequest $request): JsonResponse
    {
        // dd($request->all());
        $data = $request->validated();
        try {
            $data['id'] = Str::uuid();
            $data['id_user'] = Auth::id();
            Supplier::create($data);
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Berhasil menabahkan data Supplier', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
                'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }      
    }

    public function show(string $id) : JsonResponse
    {
        try {
            return response()->json([
            // 'data' => Product::find($id)
            'data' => Supplier::where('id', $id)->firstOrFail()
            ]);
        } catch (Exception $error) {
            return response()->json([
            'text' => $error->getMessage()
            ]);
        }  
    }

    public function update(SupplierRequest $request, string $id) : JsonResponse
    {
        $data = $request->validated();
        try {
            Supplier::where('id', $id)->update($data);

            return response()->json([
            'title' => "Berhasil!", 'text' => 'Data Supplier ' . $data['nama_perusahaan'] . ' berhasil diupdate', 'icon' => "success"
        ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    public function destroy(string $id) : JsonResponse
    {
        try {
            $supplier = Supplier::where('id', $id)->firstOrFail();
            $supplier->delete();
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Data Supplier ' . $supplier->nama . ' berhasil dihapus', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    public function serversideTable(Request $request){
        $supplier = Supplier::get();
        return DataTables::of($supplier)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            return '<div class="text-center"> 
            <button class="btn btn-sm btn-success" onClick="editModal(this)" style="width: 70px" data-id="' . $row->id . '">Edit</button> 
            <button class="btn btn-sm btn-danger" onClick="deleteModal(this)" style="width: 70px" data-id="' . $row->id . '">Delete</button> 
            </div>';
        })
        ->rawColumns(['action'])
        ->make();
    }
}
