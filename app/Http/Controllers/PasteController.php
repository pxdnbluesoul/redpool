<?php

namespace App\Http\Controllers;

use App\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GeSHi;

class PasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pastes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $g = new GeSHi;
        $languages = $g->get_supported_languages(true);
        return view('pastes.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Paste::class);

        $paste = new Paste;
        $paste->name = $request->name;
        $paste->user_id = Auth::id();
        $paste->body = $request->body;
        $paste->metadata = json_encode([
            "language" => $request->language
        ]);
        $paste->save();
        return redirect()->to('/pastes/'.$paste->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paste  $paste
     * @return \Illuminate\Http\Response
     */
    public function show(Paste $paste)
    {
        $metadata = json_decode($paste->metadata, true);
        $geshi = new GeSHi($paste->body, $metadata['language']);
        $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
        $paste->body = $geshi->parse_code();
        return view('pastes.show', compact('paste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paste  $paste
     * @return \Illuminate\Http\Response
     */
    public function edit(Paste $paste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paste  $paste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paste $paste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paste  $paste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paste $paste)
    {
        //
    }
}
