<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;


class ClientController extends Controller
{
    public function index(): View
    {
        return view('po.clients', ['title' => 'Klien']);
    }

    public function store(ClientRequest $request): JsonResponse
    {
        // dd($request->all());
        $data = $request->validated();
        try {
            $data['id'] = Str::uuid();
            Client::create($data);
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Berhasil menabahkan data klien', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
                'title' => "Eror!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }      
    }

    public function show(string $id) : JsonResponse
    {
        try {
            return response()->json([
            // 'data' => Product::find($id)
            'data' => Client::where('id', $id)->firstOrFail()
            ]);
        } catch (Exception $error) {
            return response()->json([
            'text' => $error->getMessage()
            ]);
        }  
    }

    public function update(ClientRequest $request, string $id) : JsonResponse
    {
        $data = $request->validated();
        try {
            // cek apakah ada gambar baru

            Client::where('id', $id)->update($data);

            return response()->json([
            'title' => "Berhasil!", 'text' => 'Data Klien ' . $data['nama'] . ' berhasil diupdate', 'icon' => "success"
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
            $client = Client::where('id', $id)->firstOrFail();
            $client->delete();
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Data Klien ' . $client->name . ' berhasil dihapus', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    public function serversideTable(Request $request){
        $client = Client::get();
        return DataTables::of($client)
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
