<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;

use App\loaitin;
use App\tintuc;
use App\comment;

class TinTucController extends Controller
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
        $tintuc = tintuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getThem(){
        $theloai = theloai::all();
        $loaitin = loaitin::all();
        return view('admin/tintuc/them',['theloai' => $theloai, 'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'LoaiTin' => 'required',
                'TieuDe' => 'required|min:3|max:200|unique:tintuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'LoaiTin.required' => 'bạn chưa chọn loại tin',
                'TieuDe.unique' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.min' => 'Tiêu đề phải có độ dài ít nhất 3 kí tự',
                'TieuDe.max' => 'Tiêu đề có độ dài lớn nhất 200 kí tự',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung'
            ]);
        $tintuc = new tintuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();

        return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');

    }
    public function getSua($id){
        $theloai = theloai::all();
        $loaitin = loaitin::all();
        $tintuc = tintuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(Request $request,$id){
        $tintuc = tintuc::find($id);
        $this->validate($request,
            [
                'LoaiTin' => 'required',
                'TieuDe' => 'required|min:3|max:200|unique:tintuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'LoaiTin.required' => 'bạn chưa chọn loại tin',
                'TieuDe.unique' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.min' => 'Tiêu đề phải có độ dài ít nhất 3 kí tự',
                'TieuDe.max' => 'Tiêu đề có độ dài lớn nhất 200 kí tự',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung'
            ]);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();

        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','bạn đã sửa thành công');
    }
    public function getXoa($id){
        $tintuc = tintuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'bạn đã xóa thành công');
    }
}
