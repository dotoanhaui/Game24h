@extends('layout.index')
@section('content')
<!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on: {{
                	$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">
                	{!! $tintuc->NoiDung !!}

                </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                   <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3&appId=2435766243189370&autoLogAppEvents=1"></script>
<div class="fb-comments" data-href="{{"http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']}}" data-width="100%" data-numposts="5"></div>
                </div>
                <hr>
                <!-- Posted Comments -->
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                    	@foreach($tinlienquan as  $tt)
	                        <!-- item -->
	                        <div class="row" style="margin-top: 10px;">
	                            <div class="col-md-5">
	                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
	                                    <img class="img-responsive" src="
	                                    upload/tintuc/{{$tt->Hinh}}" alt="">
	                                </a>
	                            </div>
	                            <div class="col-md-7">
	                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><b>{{$tt->TieuDe}}</b></a>
	                            </div>
	                            <p style="padding-left: 5px;">{{$tt->TomTat}}</p>
	                            <div class="break"></div>
	                        </div>
	                        <!-- end item -->
                        @endforeach

                        
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                    @foreach($tinnoibat as $tt)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                	<img class="img-responsive" src="
	                                    upload/tintuc/{{$tt->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
	                                <a href="#"><b>{{$tt->TieuDe}}</b></a>
	                            </div>
	                            <p style="padding-left: 5px;">{{$tt->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endforeach

                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection