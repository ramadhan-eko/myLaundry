<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Payment;
use App\CucianItem;
use App\LaundryCard;
use App\Customer;
use App\Promo;
use App\UserLevel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Payment::all();
        return view('pages.admin.payment.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kode_kartu)
    {
        $kode_inv = 'INV-' . Carbon::now()->year . "-" . Carbon::now()->month . "-" . substr($kode_kartu, -6);
        $dataKartu = LaundryCard::where('kode_kartu', $kode_kartu)->firstOrFail();
        $customer = Customer::findOrFail($dataKartu->id_pelanggan);
        $level = UserLevel::findOrFail($customer->id_level);
        $CucianItems = CucianItem::with([
            'getDetailItem'
        ])->where('kode_kartu', $kode_kartu)->get();
        $hargaAkhir = $CucianItems->sum('total') - ($CucianItems->sum('total') * $level->diskon);
        $promos = Promo::all();


        return view('pages.admin.payment.create', [
            'kode_kartu' => $kode_kartu,
            'kode_inv' => $kode_inv,
            'customer' => $customer,
            'level' => $level,
            'cucianItems' => $CucianItems,
            'hargaAkhir' => $hargaAkhir,
            'promos' => $promos
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
        if ($data['kode_promo'] != null) {
            $promo = Promo::where('kd_promo', $request->kode_promo)->firstOrFail();
            $data['kode_promo'] = $promo->kd_promo;
            $data['diskon'] = $promo->diskon;

            // nantinya dikirim dari form ketika sudah menggunakan jquery
            $total_bayar = ($request->total_cuci - ($request->total_cuci * ($promo->diskon / 100)));
            $data['total_bayar'] = $total_bayar;
        } else {
            $data['kode_promo'] = null;
            $data['diskon'] = 0;

            // nantinya dikirim dari form ketika sudah menggunakan jquery
            $data['total_bayar'] = $request->total_cuci;
        }

        $data['waktu_bayar'] = Carbon::now();

        $dataKartu = LaundryCard::where('kode_kartu', $request->kode_kartu)->firstOrFail();

        $dataKartu->update([
            'pembayaran' => 'Sudah Bayar'
        ]);

        Payment::create($data);

        return redirect()->route('laundry-card.show', $dataKartu->id)->with('success', 'Data laundry untuk kode ' . $dataKartu->kode_kartu . ' sudah dibayarkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // route show digunakan untuk create invoice
    public function show($kode_kartu)
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
        //
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
        //
    }

    // generate kode invoice
    public  function generateRandomString($length = 20)
    {
        $characters = '0123456789QWERTYUIOPASDFGHJKLZXCVBNM';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
