 @extends('layout.index')
 @section('content')

 <!-- Page Content -->
    <div class="container">

    	@include('layout.slide')

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#ff8100; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
					    
                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : 298 đường Cầu Diễn - phường Minh Khai - Bắc Từ Liêm - Hà Nội. 
                        </h4>
                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : toanhaui@gmail.com
                        </h4>
                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : 088 888 888
                        </h4>
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
 @endsection