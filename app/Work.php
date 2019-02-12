<?php

namespace App;

use App\WorkImage;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['main_img', 'title', 'detail', 'content', 'iframe1', 'iframe2'];

    protected $hidden = ['created_at', 'updated_at'];

    public function images()
    {
    	return $this->hasMany('App\WorkImage', 'work_id', 'id');
    }
}
