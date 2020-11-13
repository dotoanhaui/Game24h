<?php

namespace App\Http\Controllers;

use App\loaitin;
use App\theloai;
use Illuminate\Http\Request;

class LoaiTinController extends Controller
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
    public function getDanhSach(){
        $loaitin = loaitin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem(){
        $theloai = theloai::all();
        return view('admin/loaitin/them',['theloai' =>$theloai]);
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100|unique:loaitin,Ten',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'bạn chưa nhập tên loại tin',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên loại tin phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max' => 'Tên loại tin phải có độ dài từ 3 đến 100 kí tự',
                'TheLoai.required' => 'bạn chưa chọn thể loại'
            ]);
        $loaitin = new loaitin;
        $loaitin-> Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');

    }
    public function getSua($id){
        $theloai = theloai::all();
        $loaitin = loaitin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $loaitin = loaitin::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:theloai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'bạn chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max' => 'Tên loại tin phải có độ dài từ 3 đến 100 kí tự',
                'TheLoai.required' => 'bạn chưa chọn thể loại'
            ]);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','bạn đã sửa thành công');
    }
    public function getXoa($id){
        $loaitin = loaitin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao', 'bạn đã xóa thành công');
    }
}
