<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function download(Attachment $attachment)
    {
        return Storage::download($attachment->path, $attachment->name);
    }

    public function destroy(Attachment $attachment)
    {
        $record = $attachment->record;
        Storage::delete($attachment->path);
        $attachment->delete();

        return redirect()->route('records.edit', $record)->with('success', 'Attachment deleted successfully.');
    }
}
