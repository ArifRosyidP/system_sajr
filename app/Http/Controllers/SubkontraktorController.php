<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubkontraktorRequest;
use App\Models\Subkontraktor;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class SubkontraktorController extends Controller
{
    public function index(): View
    {
        return view('po.subkontraktors', ['title' => 'Subkontraktor']);
    }

    public function store(SubkontraktorRequest $request): JsonResponse
    {
        // dd($request->all());
        $data = $request->validated();
        try {
            $data['id'] = Str::uuid();
            $data['id_user'] = Auth::id();
            Subkontraktor::create($data);
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Berhasil menabahkan data Subkontraktor', 'icon' => "success"
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
            'data' => Subkontraktor::where('id', $id)->firstOrFail()
            ]);
        } catch (Exception $error) {
            return response()->json([
            'text' => $error->getMessage()
            ]);
        }  
    }

    public function update(SubkontraktorRequest $request, string $id) : JsonResponse
    {
        $data = $request->validated();
        try {
            Subkontraktor::where('id', $id)->update($data);

            return response()->json([
            'title' => "Berhasil!", 'text' => 'Data Subkontraktor ' . $data['nama'] . ' berhasil diupdate', 'icon' => "success"
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
            $subkontraktor = Subkontraktor::where('id', $id)->firstOrFail();
            $subkontraktor->delete();
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Data Subkontraktor ' . $subkontraktor->nama . ' berhasil dihapus', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    public function serversideTable(Request $request){
        $subkontraktor = Subkontraktor::get();
        return DataTables::of($subkontraktor)
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
