<?php
namespace App\Services;

use App\Models\Files;
use App\Models\FileTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FilesManager
{

    protected $upload_s3;

    public function __construct()
    {
        $this->upload_s3 = env('UPLOAD_S3');
    }

    public function uploadFiles(Request $request)
    {
        try {

            $file = $request->file('file');
            $result = FileTypes::select('id', 'directory')->firstWhere('directory', $request->input('path'));

            if (!$file || !$result)
                return json_encode(["error" => "Nenhum diretorio encontrado"]);

            $path = "/files/$result->directory/";
            $file_name = Str::random(4) . '-' . $file->getClientOriginalName();

            if ($this->upload_s3) {
                Storage::disk('s3')->put($path, $file_name);
            } else {
                $file->move(public_path($path), $file_name);
            }

            $res = Files::create(
                [
                    'path' => $path . $file_name,
                    'file_type_id' => $result->id,
                    'size' => 0
                ]
            );
        } catch (\Throwable $th) {
            Log::info("FilesManager - uploadFiles:". $th->getMessage());
            return json_encode(["error" => $th->getMessage()]);
        }

        return json_encode($res);
    }
}
