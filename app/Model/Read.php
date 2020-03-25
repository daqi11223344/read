<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    public $primaryKey = 'id';

    protected $table = 'read';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = [];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
