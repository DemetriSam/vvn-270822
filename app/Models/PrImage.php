<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PrImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'orig_img',
        'imageable_id',
        'imageable_type'
    ];

    public $pr_image_resizes = [];



    /**
     * Get the parent imageable model (user or post).
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    public function make_resizes($sizes, $toReplace = false)
    {

        if(gettype($sizes) === 'object') {
            $sizes = $sizes->resizes;
        }

        $image = Image::make(Storage::path($this->orig_img));

        [$dir_path, $filename_body, $filename_ext] = $this->parse_filepath($this->orig_img);

        $resizes = [];

        foreach ($sizes as $size) {
            $case = $size[0];
            $width = $size[1];
            $height = $size[2];
            
            $resize = clone $image;

            if ($case === 'product') {
                $resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } elseif ($case === 'rec') {
                $resize->fit($width, $height);
            } else {
                $resize->fit($width, $height);
            }
            
            
            $resize_format = $width . 'x' . $height;

            if(!collect($this->resizes)->groupBy('format')->has($resize_format) or $toReplace) {
                $resize_file_name = $filename_body . '_' . $resize_format . '.' . $filename_ext;
                
                $full_path = Storage::disk('public')->path($dir_path) . $resize_file_name;

                $resize->save(
                    $full_path,
                    100
                );

                $short_path = $dir_path . $resize_file_name;
    
                $fordb = (object) [
                    'format' => $resize_format,
                    'case' => $case,
                    'file' => $short_path
                ];
    
                $resizes[] = $fordb;
            }

        }
        
        $this->resizes = collect($resizes)->toJson();

    }

    public function parse_filepath($filepath)
    {
        $members = explode('/', $filepath);
        $reversed = array_reverse($members);

        $file_name = $reversed[0];
        $filename_members = explode('.', $file_name);
        $filename_members_reversed = array_reverse($filename_members);

        $filename_ext = $filename_members_reversed[0];

        unset($filename_members_reversed[0]);
        $filename_members = array_reverse($filename_members_reversed);

        $filename_body = implode('.', $filename_members);

        unset($reversed[0]);
        $straight = array_reverse($reversed);

        $dir_path = implode('/', $straight) . '/';

        return [$dir_path, $filename_body, $filename_ext];
    }

    /**
     * $zize - это строка типа 300x300
     */
    public function get_resize($size, $get_path_in_filesystem = false)
    {

        $resizes = json_decode($this->resizes);

        $proper = collect($resizes)->firstWhere('format', $size);

        if ($proper) {
            $short_path = $proper->file;
        } else {
            return;
        }
        
        if ($get_path_in_filesystem) {    
            return Storage::disk('public')->path($short_path);
            
        }

        return Storage::disk('public')->url($short_path);

    }
}
