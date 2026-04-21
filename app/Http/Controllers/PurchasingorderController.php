<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchasingorderRequest;
use App\Models\Client;
use App\Models\Pekerjaan;
use App\Models\Personincharge;
use App\Models\Purchasingorder;
use App\Models\Subkontraktor;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PurchasingorderController extends Controller
{
    public function index(): View
    {
        $clients = Client::orderBy('nama')->get();
        $pekerjaans = Pekerjaan::orderBy('nama_pekerjaan')->get();
        $subkontraktors = Subkontraktor::orderBy('nama')->get();
        $suppliers = Supplier::orderBy('nama_perusahaan')->get();
        $pics = Personincharge::orderBy('nama')->get();

        return view('po.index', 
        ['title' => 'Purchase Order', 'clients' => $clients, 
        'pekerjaans' => $pekerjaans, 'subkontraktors' => $subkontraktors, 
        'suppliers' => $suppliers, 'pics' => $pics]);
    }

    private function formatDate(?string $date): ?string
    {
        return $date
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d')
            : null;
    }

    public function store(PurchasingorderRequest $request): JsonResponse
    {
        
        // dd($request->all());
        $data = $request->validated();
        try {
            $data['tanggal_po'] = $this->formatDate($data['tanggal_po'] ?? null);
            $data['tanggal_pengiriman'] = $this->formatDate($data['tanggal_pengiriman'] ?? null);
            $data['tanggal_invoice'] = $this->formatDate($data['tanggal_invoice'] ?? null);
            $data['tanggal_bayar'] = $this->formatDate($data['tanggal_bayar'] ?? null);
            $data['dp1'] = $request->has('dp1');
            $data['pelunasan1'] = $request->has('pelunasan1');
            $data['dp2'] = $request->has('dp2');
            $data['pelunasan2'] = $request->has('pelunasan2');
            $data['id'] = Str::uuid();
            $data['id_user'] = Auth::id();
            Purchasingorder::create($data);
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Berhasil menabahkan data Purchase Order', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
                'title' => 'Error',
                'text' => $error->getMessage(),
                'trace' => $error->getLine(),
                'icon' => 'error'
            ], 500);
        }      
    }

    public function show(string $id) : JsonResponse
    {
        try {
            return response()->json([
            // 'data' => Product::find($id)
            'data' => Purchasingorder::where('id', $id)->firstOrFail()
            ]);
        } catch (Exception $error) {
            return response()->json([
            'text' => $error->getMessage()
            ]);
        }  
    }

    public function update(PurchasingorderRequest $request, string $id) : JsonResponse
    {
        $data = $request->validated();
        try {
            $data['tanggal_po'] = $this->formatDate($data['tanggal_po'] ?? null);
            $data['tanggal_pengiriman'] = $this->formatDate($data['tanggal_pengiriman'] ?? null);
            $data['tanggal_invoice'] = $this->formatDate($data['tanggal_invoice'] ?? null);
            $data['tanggal_bayar'] = $this->formatDate($data['tanggal_bayar'] ?? null);
            $data['dp1'] = $request->has('dp1');
            $data['pelunasan1'] = $request->has('pelunasan1');
            $data['dp2'] = $request->has('dp2');
            $data['pelunasan2'] = $request->has('pelunasan2');
            $data['id_user'] = Auth::id();
            Purchasingorder::where('id', $id)->update($data);

            return response()->json([
            'title' => "Berhasil!", 'text' => 'Data Purchase Order ' . $data['nomor_po'] . ' berhasil diupdate', 'icon' => "success"
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
            $purchasingOrder = Purchasingorder::where('id', $id)->firstOrFail();
            $purchasingOrder->delete();
            return response()->json([
                'title' => "Berhasil!", 'text' => 'Data Purchase Order ' . $purchasingOrder->nomor_po . ' berhasil dihapus', 'icon' => "success"
            ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error!", 'text' => $error->getMessage(), 'icon' => "error"
            ]);
        }
    }

    public function serversideTable(Request $request){
        $purchasingOrder = Purchasingorder::get();
        return DataTables::of($purchasingOrder)
        ->addIndexColumn()
        ->editColumn('tanggal_po', function ($row) {
            return $row->tanggal_po
                ? Carbon::parse($row->tanggal_po)->format('d-m-Y')
                : '-';
        })
        ->editColumn('id_klien', function ($row) {
            return $row->client->nama ?? '-';
        })
        ->editColumn('id_pekerjaan', function ($row) {
            return $row->pekerjaan->nama_pekerjaan ?? '-';
        })
        ->editColumn('id_subkontraktor', function ($row) {
            return $row->subkontraktor->nama ?? '-';
        })
        ->editColumn('id_supplier', function ($row) {
            return $row->supplier->nama_perusahaan ?? '-';
        })
        ->editColumn('id_personincharge', function ($row) {
            return $row->personincharge->nama ?? '-';
        })
        ->addColumn('action', function ($row) {
            return '<div class="text-center"> 
            <button class="btn btn-sm btn-success" onClick="editModal(this)" style="width: 70px" data-id="' . $row->id . '">Edit</button> 
            <button class="btn btn-sm btn-danger" onClick="deleteModal(this)" style="width: 70px" data-id="' . $row->id . '">Delete</button> 
            </div>';
        })
        ->editColumn('dp1', function ($row) {
        return '<input type="checkbox" class="form-check-input" disabled '.($row->dp1 ? 'checked' : '').'>';
        })
        ->editColumn('pelunasan1', function ($row) {
            return '<input type="checkbox" class="form-check-input" disabled '.($row->pelunasan1 ? 'checked' : '').'>';
        })
        ->editColumn('dp2', function ($row) {
            return '<input type="checkbox" class="form-check-input" disabled '.($row->dp2 ? 'checked' : '').'>';
        })
        ->editColumn('pelunasan2', function ($row) {
            return '<input type="checkbox" class="form-check-input" disabled '.($row->pelunasan2 ? 'checked' : '').'>';
        })
        ->rawColumns(['action','dp1','pelunasan1','dp2','pelunasan2'])
        ->make();
    }
}
