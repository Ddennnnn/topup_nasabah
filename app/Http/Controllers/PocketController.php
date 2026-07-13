<?php

namespace App\Http\Controllers;

use App\Models\Pocket;
use App\Http\Requests\StorePocketRequest;
use App\Http\Requests\UpdatePocketRequest;
use Illuminate\Support\Facades\Auth;

class PocketController extends Controller
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
        $pockets = Auth::user()->pockets()->latest()->get();

        return view('pocket.index', compact('pockets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = [
            '#667eea' => 'Ungu Primer',
            '#764ba2' => 'Ungu Sekunder',
            '#f59e0b' => 'Oranye',
            '#10b981' => 'Hijau',
            '#3b82f6' => 'Biru',
            '#ef4444' => 'Merah',
            '#ec4899' => 'Pink',
            '#6366f1' => 'Indigo',
        ];

        return view('pocket.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePocketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePocketRequest $request)
    {
        $data = $request->validated();
        $data['saldo'] = 0;

        Auth::user()->pockets()->create($data);

        return redirect()->route('pocket.index')->with('success', 'Pocket berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pocket  $pocket
     * @return \Illuminate\Http\Response
     */
    public function show(Pocket $pocket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pocket  $pocket
     * @return \Illuminate\Http\Response
     */
    public function edit(Pocket $pocket)
    {
        $this->authorize('update', $pocket);

        $colors = [
            '#667eea' => 'Ungu Primer',
            '#764ba2' => 'Ungu Sekunder',
            '#f59e0b' => 'Oranye',
            '#10b981' => 'Hijau',
            '#3b82f6' => 'Biru',
            '#ef4444' => 'Merah',
            '#ec4899' => 'Pink',
            '#6366f1' => 'Indigo',
        ];

        return view('pocket.edit', compact('pocket', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePocketRequest  $request
     * @param  \App\Models\Pocket  $pocket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePocketRequest $request, Pocket $pocket)
    {
        $this->authorize('update', $pocket);

        $pocket->update($request->validated());

        return redirect()->route('pocket.index')->with('success', 'Pocket berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pocket  $pocket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pocket $pocket)
    {
        $this->authorize('delete', $pocket);

        $pocket->delete();

        return redirect()->route('pocket.index')->with('success', 'Pocket berhasil dihapus!');
    }
}

