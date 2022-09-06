<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\CurrencyStoreRequest;
use App\Http\Requests\CurrencyUpdateRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = User::find(Auth::user()->id)->currencies()->get();;

        return view('currency.index', compact('currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencyAll = Currency::all();
        
        $currency = User::first()->currencies()->get();
                
        return view('currency.create', compact('currency','currencyAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyStoreRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $currency_id = $request->input('currency_id');
        $user->currencies()->toggle($currency_id);
       
        return redirect()->route('currency.index')->with('success',' Currencies added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency = Currency::find($id);
        $url = 'http://api.nbp.pl/api/exchangerates/rates/A/' . $currency['code'] .'/';
        
        $response = json_decode(Http::get($url), true);
        $data = $response['rates'];

        return view('currency.show', compact('currency','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currencyAll = Currency::all();
        $currency_user = User::find(Auth::user()->id)->currencies()->get();
        $selected_currencies = [];
        $currency = Currency::find($id);
              
        foreach($currency_user as $cur)
            {
            $selected_currencies[] = $cur->id;
            }
        return view('currency.edit',compact('currency','currencyAll','selected_currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyUpdateRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $currency_id = $request->input('currency_id');
        $user->currencies()->sync($currency_id);
       
        return redirect()->route('currency.index')->with('success',' Currencies updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
       
        return redirect()->route('currency.index')->with('success',' Currency deleted!');
    }
}
