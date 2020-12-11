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
    public function create()
    {
        //
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
        // didapet kode_kartu, id_service, quantity
        $dataLaundryCard = LaundryCard::findOrFail($request->id_kartu);

        $dataService = ProdukService::findOrFail($request->id_service);
        // hitung total
        $total_temp = $dataLaundryCard->total_harga;
        $total_cucian_temp = $dataService->harga * $request->quantity;
        $total = $total_temp + $total_cucian_temp;

        // update laundry card
        $dataLaundryCard->update([
            'total_harga' => $total
        ]);

        // set value ke table cucian item
        $data['produk'] = $dataService->produk;
        $data['kode_kartu'] = $dataLaundryCard->kode_kartu;
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
        $produks = ProdukService::all();
        $laundryCard = LaundryCard::findOrFail($id);
        // die($laundryCard);

        return view('pages.admin.cucian-item.create', [
            'produks' => $produks,
            'laundrycard' => $laundryCard
        ]);
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
        $laundryCard = LaundryCard::where('kode_kartu', $item->kode_kartu)->first();

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
        $data = $request->all();
        // didapet kode_kartu, id_service, quantity
        $dataLaundryCard = LaundryCard::findOrFail($request->id_kartu);

        $dataCucian = CucianItem::findOrFail($id);

        $dataService = ProdukService::where('produk', $request->produk)->first();

        // kurangi total harga dengan harga sebelumnya

        $total_temp = $dataLaundryCard->total_harga - $dataCucian->total;

        // hitung total
        $total_cucian_temp = $dataService->harga * $request->quantity;
        $total = $total_temp + $total_cucian_temp;

        // update laundry card
        $dataLaundryCard->update([
            'total_harga' => $total
        ]);

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
        $LaundryData = LaundryCard::where('kode_kartu', $data->kode_kartu)->first();

        // kurangi total harga
        $total = $LaundryData->total_harga - $data->total;

        // update laundry card
        $LaundryData->update([
            'total_harga' => $total
        ]);

        $data->delete();
        return redirect()->route('laundry-card.show', $LaundryData->id);
    }
}
