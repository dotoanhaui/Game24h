<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    //
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem(){
        return view('admin/user/them');
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'name.required' => 'bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 kí tự',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'email.unique' => 'email đã tồn tại',
                'password.required' => 'bạn chưa nhập password',
                'password.min' => 'mật khẩu phải có ít nhất 6 kí tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect('admin/user/them')->with('thongbao','Thêm thành công');

    }
    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,
            [
                'name' => 'required|min:3',
            ],
            [
                'name.required' => 'bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 kí tự',
            ]);
        $user = User::find($id);
        $user->name = $request->name;

        if($request->changePassword == "on"){
            $this->validate($request,
                [
                    'password' => 'required|min:6',
                    'passwordAgain' => 'required|same:password'
                ],
                [
                    'password.required' => 'bạn chưa nhập password',
                    'password.min' => 'mật khẩu phải có ít nhất 6 kí tự',
                    'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                    'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
                ]);
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');

    }
    public function getXoa($id){
        $user = User::find($id);
        $user->delete();

        return redirect('admin/user/danhsach')->with('thongbao', 'bạn đã xóa thành công');
    }

    public function getLogoutAdmin(Request $request){
        Auth::logout();
        $request->session()->put('admin',[]);
        return redirect('login');
    }
}
