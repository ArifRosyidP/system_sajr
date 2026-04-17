<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaroseriRequest;
use App\Models\Karoseri;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class KaroseriController extends Controller
{

    public function index(): View
    {
        return view('po.karoseris', ['title' => 'Karoseri']);
    }

    public function store(KaroseriRequest $request): JsonResponse
    {
        // dd($request->all());
        $data = $request->validated();
        try {
            $data['id'] = Str::uuid();
            Karoseri::create($data);
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Berhasil menabahkan data karoseri', 'icon' => "success"
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
            'data' => Karoseri::where('id', $id)->firstOrFail()
            ]);
        } catch (Exception $error) {
            return response()->json([
            'text' => $error->getMessage()
            ]);
        }  
    }

    public function update(KaroseriRequest $request, string $id) : JsonResponse
    {
        $data = $request->validated();
        try {
            // cek apakah ada gambar baru

            Karoseri::where('id', $id)->update($data);

            return response()->json([
            'title' => "Berhasil!", 'text' => 'Data Karoseri ' . $data['nomor_karoseri'] . ' berhasil diupdate', 'icon' => "success"
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
            $karoseri = Karoseri::where('id', $id)->firstOrFail();
            $karoseri->delete();
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Data Karoseri ' . $karoseri->nomor_karoseri . ' berhasil dihapus', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    public function serversideTable(Request $request){
        $karoseri = Karoseri::get();
        return DataTables::of($karoseri)
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
