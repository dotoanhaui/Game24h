<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;

class TheLoaiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $admin = session('admin');
            if($admin && $admin['name'] != ''){
                return $next($request);
            }else{
                return redirect('login');
            }
        });
      parent::__construct();
    }
    //
    public function getDanhSach(){
        $theloai = theloai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
    public function getThem(){
        return view('admin/theloai/them');
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100|unique:theloai,Ten'
            ],
            [
                'Ten.required' => 'bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
            ]);
        $theloai = new theloai;
        $theloai-> Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');

    }
    public function getSua($id){
        $theloai = theloai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $theloai = theloai::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:theloai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
            ]);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao','bạn đã sửa thành công');
    }
    public function getXoa($id){
        $theloai = theloai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao', 'bạn đã xóa thành công');
    }
}
