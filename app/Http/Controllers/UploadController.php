<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('uploads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Upload::class);

        $path = $request->file('file')->store('uploads');
        $upload = new Upload;
        $upload->user_id = Auth::id();
        $upload->name = $request->name;
        $upload->path = $path;
        if($request->shareoptions != 'none') {
            $upload->metadata = json_encode([
                "Allow Groups (View)" => $request->shareoptions
            ]);
        } else { $upload->metadata = json_encode([], JSON_FORCE_OBJECT); }
        $upload->save();

        return redirect()->to('/uploads/'.$upload->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        $this->authorize('view', $upload);

        $size = Storage::size($upload->path);
        $size = self::showReadableBytes($size);
        $url = Storage::temporaryUrl($upload->path, now()->addDay());
        $metadata = json_decode($upload->metadata, true);
        return view('uploads.show', compact(['upload','metadata', 'size', 'url']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit(Upload $upload)
    {
        $this->authorize('update', $upload);

        return view('uploads.edit', compact('upload'));
    }

    /**
     * Show the form for confirming deletion of the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete(Upload $upload)
    {
        $this->authorize('delete', $upload);

        $size = Storage::size($upload->path);
        $size = self::showReadableBytes($size);
        return view('uploads.confirmdelete', compact(['upload', 'size']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upload $upload)
    {
        $this->authorize('update', $upload);

        if($request->actiontype == 'perms') {
            // Currently all we're doing here is working with metadata and permissons.
            $metadata = json_decode($upload->metadata, true);

            // We will work one of two ways depending on whether we're adding or removing users/groups from metadata.
            if ($request->action == "add") {
                foreach ($request->members as $member) {
                    // Take advantage of conventions we've laid out to treat user and group additions the same way.
                    $metadata["Allow " . $request->member_type . "s (" . $request->access_level . ")"][] = $member;
                    $upload->metadata = json_encode($metadata);
                    $upload->save();
                }
                return back();
            } elseif ($request->action == "remove") {
                $metadata["Allow " . $request->member_type . "s (" . $request->access_level . ")"] = array_diff(array_values($metadata["Allow " . $request->member_type . "s (" . $request->access_level . ")"]), array($request->member_id));
                $upload->metadata = json_encode($metadata);
                $upload->save();
                return back();
            }
        }

        elseif($request->actiontype == 'rename') {
            $upload->name = $request->name;
            $upload->save();
            return redirect()->to('/uploads/'.$upload->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        $this->authorize('delete', $upload);

        Storage::delete($upload->path);
        $upload->delete();

        return redirect()->to('/uploads');
    }

    public static function showReadableBytes($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
