 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#ff8100;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="trangchu" style="color: #fff !important;">GAME 24h</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form action="timkiem" method="post" class="navbar-form" role="search">
                    <input type="hidden" name="_token" value="{{csrf_token()}}";>
			        <div class="form-group">
			          <input type="text" name="tukhoa" class="form-control" placeholder="Tìm kiếm">
			        </div>
			        <button type="submit" class="btn btn-default">Tìm</button>
                    <a href="lienhe" style="color: #fff !important;font-size: 18px;padding-top: 5px" class="pull-right">Liên hệ</a>
			    </form>
            </div>



            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <style type="text/css">
        .btn-primary {
             background-color: #ff8100;
            border-color: #ff8100;
            color: #fff !important;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #ff8100;
            border-color: #ff8100;
        }
    </style>