<?php

namespace App\Http\Controllers\admin;

use App\CucianItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LaundryCard;
use App\Customer;
use Carbon\Carbon;

class LaundryCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = LaundryCard::with([
            'datacuci'
        ])->get();
        // die($items);

        return view('pages.admin.laundry-card.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_kartu = Carbon::now()->year . "-" . Carbon::now()->month . "-" . $this->generateRandomString(6);
        $waktu_masuk = Carbon::now();
        $custumers = Customer::all();

        return view('pages.admin.laundry-card.create', [
            'customers' => $custumers,
            'kode_kartu' => $kode_kartu,
            'waktu_masuk' => $waktu_masuk
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
        $data['pembayaran'] = "Belum Bayar";
        $data['status'] = "Hold";
        $data['total_harga'] = 0;

        LaundryCard::create($data);
        return redirect()->route('laundry-card.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = LaundryCard::findOrFail($id);
        $customer = Customer::findOrFail($item->id_pelanggan);
        $CucianItems = CucianItem::with([
            'getDetailItem'
        ])->where('kode_kartu', $item->kode_kartu)->get();

        return view('pages.admin.laundry-card.detail', [
            'item' => $item,
            'customer' => $customer,
            'CucianItems' => $CucianItems
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
        $item = LaundryCard::findOrFail($id);
        // $data->waktu_diambil = Carbon::now();
        $item->update([
            'waktu_diambil' => Carbon::now()
        ]);
        // $item->update($data);

        return redirect()->route('laundry-card.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = LaundryCard::findOrFail($id);
        $data->delete();
        return redirect()->route('laundry-card.index');
    }

    // generate kode registrasi
    public  function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
