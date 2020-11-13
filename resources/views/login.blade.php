<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trang quản trị tin tức</title>
        <!-- Fonts -->
       <link rel="stylesheet" href="{!! asset('css_login/css/css.css')!!}"/>
       <link rel="stylesheet" href="{!! asset('css_login/css/bootstrap.min.css')!!}"/>
        <style type="text/css">
            .wrapper {    
                margin-top: 80px;
                margin-bottom: 20px;
            }

            .form-signin {
                  max-width: 420px;
                  padding: 30px 38px 66px;
                  margin: 0 auto;
                  background-color: #eee;
                  border: 3px dotted rgba(0,0,0,0.1);
              }

            .form-signin-heading {
                  text-align:center;
                  margin-bottom: 30px;
            }

            .form-control {
                  position: relative;
                  font-size: 16px;
                  height: auto;
                  padding: 10px;
            }

            input[type="text"] {
                 margin-bottom: 0px;
            }
            .colorgraph {
                  height: 7px;
                  border-top: 0;
                  background: #c4e17f;
                  border-radius: 5px;
            }
        </style>
    </head>
    <body>
       <div class = "container">
    <div class="wrapper">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        @if(session('thongbao'))
                {{session('thongbao')}}
        @endif
        <form action="{{url('login')}}" method="post" name="Login_Form" class="form-signin">
            <h3 class="form-signin-heading">Trang quản trị website</h3>
              <hr class="colorgraph"><br>
               @if($errors->has('logginMessage'))
                <p class="text-danger">{{$errors->first('logginMessage')}}</p>
              @endif
              <input type="text" class="form-control" name="email" placeholder="Email"  autofocus="" />
              @if($errors->has('email'))
                <p class="text-danger">{{$errors->first('username')}}</p>
              @endif
              <input type="password" class="form-control mt-2" name="password" placeholder="Mật khẩu" />@if($errors->has('password'))
                <p class="text-danger">{{$errors->first('password')}}</p>
              @endif
              {!! csrf_field() !!}
              <button class="btn btn-lg btn-primary btn-block mt-2"  name="Submit" value="login" type="Submit">Đăng nhập</button>            
        </form>         
    </div>
</div>
    </body>
</html>
