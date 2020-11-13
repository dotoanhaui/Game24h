<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaitin extends Model
{
    //
    protected $table = "loaitin";

    public function theloai(){
        return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }

    public function tintuc(){
        return $this->hasMany('App\Tintuc','idLoaiTin','id');
    }
}
