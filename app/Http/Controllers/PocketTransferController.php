<?php

namespace App\Http\Controllers;

use App\Models\PocketTransfer;
use App\Models\Pocket;
use App\Http\Requests\StorePocketTransferRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PocketTransferController extends Controller
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
        $transfers = Auth::user()->pocketTransfers()->latest('created_at')->paginate(15);

        return view('pocket_transfer.index', compact('transfers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $pockets = $user->pockets()->get();

        return view('pocket_transfer.create', compact('pockets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePocketTransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePocketTransferRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $user = Auth::user();
                $fromPocket = $request->from_pocket ? Pocket::find($request->from_pocket) : null;
                $toPocket = $request->to_pocket ? Pocket::find($request->to_pocket) : null;
                $nominal = $request->nominal;

                // Check source balance
                if ($fromPocket === null) {
                    // From main balance
                    if ($user->saldo < $nominal) {
                        throw new \Exception('Saldo utama tidak mencukupi.');
                    }
                    $user->decrement('saldo', $nominal);
                } else {
                    // From pocket
                    if ($fromPocket->saldo < $nominal) {
                        throw new \Exception('Saldo pocket ' . $fromPocket->nama . ' tidak mencukupi.');
                    }
                    $fromPocket->decrement('saldo', $nominal);
                }

                // Add to destination
                if ($toPocket === null) {
                    // To main balance
                    $user->increment('saldo', $nominal);
                } else {
                    // To pocket
                    $toPocket->increment('saldo', $nominal);
                }

                // Create transfer record
                $user->pocketTransfers()->create([
                    'from_pocket' => $request->from_pocket,
                    'to_pocket' => $request->to_pocket,
                    'nominal' => $nominal,
                    'keterangan' => $request->keterangan,
                    'created_at' => now(),
                ]);
            });

            return redirect()->route('pocket_transfer.index')->with('success', 'Pemindahan saldo berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PocketTransfer  $pocketTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(PocketTransfer $pocketTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PocketTransfer  $pocketTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit(PocketTransfer $pocketTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PocketTransfer  $pocketTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(PocketTransfer $pocketTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PocketTransfer  $pocketTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PocketTransfer $pocketTransfer)
    {
        //
    }
}

