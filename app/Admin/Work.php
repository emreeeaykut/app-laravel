<?php

namespace App\Admin;

// use App\Admin\WorkImage;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['main_img', 'title', 'detail', 'content', 'iframe1', 'iframe2', 'created_at', 'updated_at'];

    // public function workImages()
    // {
    // 	return $this->hasMany(WorkImage::class);
    // }
}
