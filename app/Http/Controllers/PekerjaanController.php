<?php

namespace App\Http\Controllers;

use App\Http\Requests\PekerjaanRequest;
use App\Models\Client;
use App\Models\Pekerjaan;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PekerjaanController extends Controller
{

    public function index(): View
    {
        $clients = Client::orderBy('nama')->get();

        return view('po.pekerjaans', [
            'title' => 'Pekerjaan',
            'clients' => $clients
    ]);
    }


    public function store(PekerjaanRequest $request): JsonResponse
    {
        // dd($request->all());
        $data = $request->validated();
        try {
            $data['id'] = Str::uuid();
            $data['id_user'] = Auth::id();
            Pekerjaan::create($data);
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
            'data' => Pekerjaan::where('id', $id)->firstOrFail()
            ]);
        } catch (Exception $error) {
            return response()->json([
            'text' => $error->getMessage()
            ]);
        }  
    }

    public function update(PekerjaanRequest $request, string $id) : JsonResponse
    {
        $data = $request->validated();
        try {
            // cek apakah ada gambar baru

            Pekerjaan::where('id', $id)->update($data);

            return response()->json([
            'title' => "Berhasil!", 'text' => 'Data Pekerjaan ' . $data['nama_pekerjaan'] . ' berhasil diupdate', 'icon' => "success"
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
            $pekerjaan = Pekerjaan::where('id', $id)->firstOrFail();
            $pekerjaan->delete();
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Data Pekerjaan ' . $pekerjaan->nama_pekerjaan . ' berhasil dihapus', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    public function serversideTable(Request $request){
        // $pekerjaan = Pekerjaan::get();
        $pekerjaan = Pekerjaan::get();
        return DataTables::of($pekerjaan)
        ->addIndexColumn()
        ->editColumn('id_klien', function ($row) {
            return $row->client->nama ?? '-';
        })
        ->addColumn('action', function ($row) {
            return '<div class="text-center"> 
            <button class="btn btn-sm btn-success" onClick="editModal(this)" style="width: 70px" data-id="' . $row->id . '">Edit</button> 
            <button class="btn btn-sm btn-danger" onClick="deleteModal(this)" style="width: 70px" data-id="' . $row->id . '">Delete</button> 
            </div>';
        })
        ->rawColumns(['action'])
        ->make();
    }

    public function getPekerjaan($clientId)
    {
        try {
        $pekerjaan = Pekerjaan::select('id', 'nama_pekerjaan')
            ->where('id_klien', $clientId)
            ->orderBy('nama_pekerjaan')
            ->get();

        return response()->json($pekerjaan);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }
    
}
