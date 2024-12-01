<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = Wallet::all();
       
        return view('admin.Auth.my_wallet',compact('wallets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'transaction_type' => 'required|string',
        ]);

        Wallet::create($request->all());
        return response()->json(['success' => 'Money added successfully']);
    }

    public function update(Request $request, Wallet $wallet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'transaction_type' => 'required|string',
        ]);

        $wallet->update($request->all());
        return response()->json(['success' => 'Transaction updated successfully']);
    }

    public function destroy($id)
    {
        // Find the wallet entry by ID and delete it
        $wallet = Wallet::find($id);
    
        if ($wallet) {
            $wallet->delete();
            return response()->json(['success' => 'Wallet deleted successfully.']);
        }
    
        return response()->json(['error' => 'Wallet not found.'], 404);
    }
}
