<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slide;


class SlideController extends Controller
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
        $slide = slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getThem(){
        return view('admin/slide/them');
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required',
                'NoiDung' => 'required',
            ],
            [
                'Ten.required' => 'bạn chưa nhập tên',
                'NoiDung.required' => 'Bạn chưa nhập tên nội dung',

            ]);
        $slide = new slide;
        $slide-> Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link')){
            $slide->link = $request->link;
        }

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }
        else{
            $slide->Hinh = "";
        }
        $slide->save();

        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');

    }
    public function getSua($id){
        $slide = slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,
            [
                'Ten' => 'required',
                'NoiDung' => 'required',
            ],
            [
                'Ten.required' => 'bạn chưa nhập tên',
                'NoiDung.required' => 'Bạn chưa nhập tên nội dung',

            ]);
        $slide = slide::find($id);
        $slide-> Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link')){
            $slide->link = $request->link;
        }

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            unlink("upload/slide/".$slide->Hinh);
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }

        $slide->save();

        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');

    }
    public function getXoa($id){
        $slide = slide::find($id);
        $slide->delete();

        return redirect('admin/slide/danhsach')->with('thongbao', 'bạn đã xóa thành công');
    }
}
