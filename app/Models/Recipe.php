<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function updateImage(Request $request)
    {
        if($request->imageBase64 === null) {
            return;
        }

        Storage::delete(storage_path('app/'.$this->image));

        if($request->web) {
            [$fileContent, $extension] = $this->getBase64FromWeb($request->imageBase64);
        } else {
            [$fileContent, $extension] = $this->getBase64FromMobile($request);
        }

        $filePath = $this->generatePath($extension);
        Storage::put($filePath, $fileContent);
        $this->image = $filePath;

        return $filePath;
    }


    public function generatePath($extension)
    {
        return 'recipes/'.Str::random(40).'.'.$extension;
    }


    protected function getBase64FromWeb($base64Image)
    {
        $image_parts = explode(";base64,", $base64Image);
        $extension = explode('/', mime_content_type($base64Image))[1];
        
        return [base64_decode($image_parts[1]), $extension];
    }


    protected function getBase64FromMobile(Request $request)
    {
        $path = parse_url($request->image, PHP_URL_PATH);
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        return [base64_decode($request->imageBase64), $extension];
    }
}
