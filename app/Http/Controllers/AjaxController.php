<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaitin;
use App\theloai;

class AjaxController extends Controller
{
    //
    public function getLoaiTin($idTheLoai){
        $loaitin = loaitin::where('idTheLoai', $idTheLoai)->get();
        foreach ($loaitin as $lt){
            echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
        }
    }
}
