<?php

namespace App\Http\Controllers;

use Brackets\AdminUI\WysiwygMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class WysiwygUploadController extends Controller
{
    public function uploads3(Request $request)
    {
        // get image from request and check validity
        $temporaryFile = $request->file('fileToUpload');
        if (!$temporaryFile->isFile() || !in_array($temporaryFile->getMimeType(), ['image/png', 'image/jpeg', 'image/gif', 'image/svg+xml'])) {
            return response()->json([
                'success' => false
            ]);
        }


        // generate path that it will be saved to
        $name = $temporaryFile->getClientOriginalName();
        $savedPath = Config::get('wysiwyg-media.media_folder') . '/' . time() . $name;
        $s3 = Storage::disk('s3');

        // create directory in which we will be uploading into
        if (!File::isDirectory(Config::get('wysiwyg-media.media_folder'))) {
            File::makeDirectory(Config::get('wysiwyg-media.media_folder'), 0755, true);
        }

        // resize and save image
        $image = Image::make($temporaryFile->path())
            ->resize(Config::get('wysiwyg-media.maximum_image_width'), null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->stream();

        $s3->put($savedPath, $image, 'public');
        // optimize image
        // OptimizerChainFactory::create()->optimize(Storage::disk('s3')->url($savedPath));
        // create related model
        $wysiwygMedia = WysiwygMedia::create(['file_path' => $savedPath]);
        // return image's path to use in wysiwyg
        return response()->json([
            'file' => Storage::disk('s3')->url($savedPath),
            'mediaId' => $wysiwygMedia->id,
            'success' => true
        ]);
    }
}
