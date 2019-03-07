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
        if($request->shareoptions != 'none')
        {
            $paste->metadata = json_encode([
            "language" => $request->language,
            "Allow Groups (View)" => array($request->shareoptions)
            ]);
        }
        else { $paste->metadata = json_encode(["language" => $request->language]); }
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
        $this->authorize('view', $paste);

        $metadata = json_decode($paste->metadata, true);
        $geshi = new GeSHi($paste->body, $metadata['language']);
        $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
        $paste->body = $geshi->parse_code();
        return view('pastes.show', compact(['paste','metadata']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paste  $paste
     * @return \Illuminate\Http\Response
     */
    public function edit(Paste $paste)
    {
        $this->authorize('update', $paste);

        return view('pastes.edit', compact('paste'));
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
        $this->authorize('update', $paste);

        if($request->actiontype == 'perms') {
            // If the request was sent with an empty set, kick it back.
            if ($request->members == null) { return back(); }

            // Currently all we're doing here is working with metadata and permissons.
            $metadata = json_decode($paste->metadata, true);

            // We will work one of two ways depending on whether we're adding or removing users/groups from metadata.
            if ($request->action == "add") {
                foreach ($request->members as $member) {
                    // Take advantage of conventions we've laid out to treat user and group additions the same way.
                    $metadata["Allow " . $request->member_type . "s (" . $request->access_level . ")"][] = $member;
                    $paste->metadata = json_encode($metadata);
                    $paste->save();
                }
                return back();
            } elseif ($request->action == "remove") {
                $metadata["Allow " . $request->member_type . "s (" . $request->access_level . ")"] = array_diff(array_values($metadata["Allow " . $request->member_type . "s (" . $request->access_level . ")"]), array($request->member_id));
                $paste->metadata = json_encode($metadata);
                $paste->save();
                return back();
            }
        }

        elseif($request->actiontype == 'rename') {
            $paste->name = $request->name;
            $paste->save();
            return redirect()->to('/pastes/'.$paste->id);
        }
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
