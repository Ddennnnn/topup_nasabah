<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSendTransferRequest;
use App\Models\Pocket;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfers = Transfer::where('pengirim_id', Auth::id())
            ->orWhere('penerima_id', Auth::id())
            ->latest('created_at')
            ->paginate(15);

        return view('transfer.index', compact('transfers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pockets = Auth::user()->pockets()->get();

        return view('transfer.create', compact('pockets'));
    }

    /**
     * Store a newly created transfer in storage.
     *
     * @param  \App\Http\Requests\StoreSendTransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSendTransferRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $pengirim = Auth::user();
                $penerima = User::findOrFail($request->penerima_id);
                $nominal = $request->nominal;
                $pocket = $request->pocket_id ? Pocket::find($request->pocket_id) : null;

                if ($pocket === null) {
                    if ($pengirim->saldo < $nominal) {
                        throw new \Exception('Saldo utama Anda tidak mencukupi.');
                    }
                    $pengirim->decrement('saldo', $nominal);
                } else {
                    if ($pocket->saldo < $nominal) {
                        throw new \Exception('Saldo ' . $pocket->nama . ' tidak mencukupi.');
                    }
                    $pocket->decrement('saldo', $nominal);
                }

                $penerima->increment('saldo', $nominal);

                Transfer::create([
                    'pengirim_id' => $pengirim->id,
                    'penerima_id' => $penerima->id,
                    'pocket_id' => $request->pocket_id,
                    'nominal' => $nominal,
                    'keterangan' => $request->keterangan,
                    'status' => 'SUCCESS',
                    'created_at' => now(),
                ]);
            });

            return redirect()->route('transfer.index')->with('success', 'Transfer berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        return redirect()->route('transfer.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        return redirect()->route('transfer.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSendTransferRequest $request, Transfer $transfer)
    {
        return redirect()->route('transfer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        return redirect()->route('transfer.index');
    }
}
