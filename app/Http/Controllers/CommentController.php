<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;

class CommentController extends Controller
{
    public function getXoa($id,$idTinTuc){
        $comment = comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua'.$idTinTuc)->with('thongbao', ' xóa thành công');
    }
}
