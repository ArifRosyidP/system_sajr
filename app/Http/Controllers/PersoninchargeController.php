<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersoninchargeRequest;
use App\Models\Personincharge;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PersoninchargeController extends Controller
{
    
    public function index(): View
    {
        return view('po.pics', ['title' => 'PIC']);
    }

    public function store(PersoninchargeRequest $request): JsonResponse
    {
        // dd($request->all());
        $data = $request->validated();
        try {
            $data['id'] = Str::uuid();
            Personincharge::create($data);
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Berhasil menabahkan data PIC', 'icon' => "success"
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
            'data' => Personincharge::where('id', $id)->firstOrFail()
            ]);
        } catch (Exception $error) {
            return response()->json([
            'text' => $error->getMessage()
            ]);
        }  
    }

    public function update(PersoninchargeRequest $request, string $id) : JsonResponse
    {
        $data = $request->validated();
        try {
            Personincharge::where('id', $id)->update($data);

            return response()->json([
            'title' => "Berhasil!", 'text' => 'Data PIC ' . $data['nama'] . ' berhasil diupdate', 'icon' => "success"
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
            $personincharge = Personincharge::where('id', $id)->firstOrFail();
            $personincharge->delete();
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Data PIC ' . $personincharge->nama . ' berhasil dihapus', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    public function serversideTable(Request $request){
        $personincharge = Personincharge::get();
        return DataTables::of($personincharge)
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
