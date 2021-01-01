<?php

namespace App\Http\Controllers\Admin;

use App\CucianItem;
use App\Http\Controllers\Controller;
use App\LaundryCard;
use App\ProdukService;
use Illuminate\Http\Request;

class CucianItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $produks = ProdukService::all();
        $laundryCard = LaundryCard::findOrFail($id);
        // die($laundryCard);

        return view('pages.admin.cucian-item.create', [
            'produks' => $produks,
            'laundrycard' => $laundryCard
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $dataLaudryCard = LaundryCard::where('kode_kartu', $request->kode_kartu)->firstOrFail();
        // die($dataLaudryCard);

        if($dataLaudryCard->status === 'Hold') {
            $dataLaudryCard->update([
                'status' => 'Cuci'
            ]);
        }

        $dataService = ProdukService::findOrFail($request->id_service);
        
        // hitung total
        $total_cucian_temp = $dataService->harga * $request->quantity;

        // set value ke table cucian item
        $data['produk'] = $dataService->produk;
        $data['harga_satuan'] = $dataService->harga;
        $data['total'] = $total_cucian_temp;

        CucianItem::create($data);

        return redirect()->route('laundry-card.show', $request->id_kartu);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = CucianItem::findOrFail($id);
        $laundryCard = LaundryCard::where('kode_kartu', $item->kode_kartu)->firstOrFail();

        return view('pages.admin.cucian-item.edit', [
            'item' => $item,
            'laundrycard' => $laundryCard
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataCucian = CucianItem::findOrFail($id);

        $dataService = ProdukService::findOrFail($request->id_service);

        // hitung total
        $total_cucian_temp = $dataService->harga * $request->quantity;

        $dataCucian->update([
            'quantity' => $request->quantity,
            'total' => $total_cucian_temp
        ]);

        return redirect()->route('laundry-card.show', $request->id_kartu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CucianItem::findOrFail($id);
        $LaundryData = LaundryCard::where('kode_kartu', $data->kode_kartu)->firstOrFail();

        $data->delete();
        return redirect()->route('laundry-card.show', $LaundryData->id);
    }
}
