<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkImage extends Model
{
    protected $fillable = ['image', 'work_id'];

    protected $hidden = ['created_at', 'updated_at'];

}
