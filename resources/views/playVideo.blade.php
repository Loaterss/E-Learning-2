@extends('navbar')

@section('content')
    <div class="container">
        <a href="/courses/{{$course->id}}" style="text-decoration: none;">
            <h1 style="margin-top: -20px; margin-left: 15px;">{{$course->subject." Course"}}</h1>
        </a>
        <br>
        <div class="col-sm-6 col-md-9">
            <div class="thumbnail " >
                <video width="815" height="500" controls>
                    <source src='{{asset("courses/".$course->subject."_".$course->id."/".$videos[0]->video)}}'
                            type="video/{{$videos[0]->extension}}">
                </video>
                <div class="caption">
                    <h4>{{$videos[0]->name}}</h4>
                </div>
            </div>
        </div>

        @if(isset($videos[1]))
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail " style="height: 235px; max-height: 235px; overflow: hidden;">
                    <video width="245" height="140">
                        <source src="{{asset("courses/".$course->subject."_".$course->id."/".$videos[1]->video)}}"
                                type="video/{{$videos[1]->extension}}">
                    </video>
                    <div class="caption">
                        <hr class="custom-hr">
                        <a href="/playVideo/{{$videos[1]->id}}" style="color: #000; margin-top: -10px; display: block">{{$videos[1]->name}}</a>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($videos[2]))
            <div class="col-sm-6 col-md-3" style=" margin-top: 17px;">
                <div class="thumbnail " style="height: 235px; max-height: 235px; overflow: hidden;">
                    <video width="245" height="140">
                        <source src="{{asset("courses/".$course->subject."_".$course->id."/".$videos[2]->video)}}"
                                type="video/{{$videos[2]->extension}}">
                    </video>
                    <div class="caption">
                        <hr class="custom-hr">
                        <a href="/playVideo/{{$videos[2]->id}}" style="color: #000; margin-top: -10px; display: block">{{$videos[2]->name}}</a>
                    </div>
                </div>
            </div>
        @endif

        <div style="clear: both;"></div>
        <br>
        <div class="paging">
            @if(count($prevs)>=1)
                <a href="/playPreviousVideo/{{$videos[0]->id}}" class="previous"><i class="fas fa-angle-double-left"></i> Previous</a>
            @endif
            @if(isset($videos[1]))
                <a href="/playNextVideo/{{$videos[0]->id}}" class="next">Next <i class="fas fa-angle-double-right"></i></a>
            @endif
        </div>

        <br><br><br><br>

        <h2>Comments</h2>
        <hr class="custom-hr">
        @foreach($videos[0]->comments as $comment)
            <div class='row'>
                <div class="comment-box">
                    <div class='col-md-2 text-center'>
                        <a href="/student-profile/{{$comment->user->id}}"><img class="img-responsive center-block img-circle " style="border: 1px solid #aaa; width: 80px; height: 80px;" src="{{ asset("profilePic/".$comment->user->profilePic)}}" alt=""></a>
                        <a href="/student-profile/{{$comment->user->id}}" style="text-decoration: none; font-weight: bold; color:#000;">{{Session::get('frontSession')->fullName}}</a>
                    </div>

                    <form class="edit-comment-form" action="/updateComment/{{$comment->id}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <textarea name="comment" class='col-md-6 lead' style='background: #fff;' required>{{$comment->comment}}</textarea>
                        <input type='submit' class='btn btn-primary' value='Save Changes' style='margin: 100px 0px 0px -195px;'>
                    </form>
                    <div style="display: none;">
                        <button class='btn btn-danger discard' style="position: relative; left: 705px; top: -33px;">Discard</button>
                        {{--<hr class="custom-hr">--}}
                    </div>

                    <div class='col-md-6 lead'>{{$comment->comment}}</div>

                    {{--Controle Comment==========================================================================--}}

                    @if(Session::get('frontSession')->id == $comment->user_id)
                        <div class="col-md-4"><br>
                            <i class="fa fa-edit edit-comment" style="cursor: pointer;"></i>
                            <span style="margin-left: 20px;"></span>
                            <a href="/deleteComment/{{$comment->id}}" style="color: #333;">
                                <i class="fa fa-trash-alt"> </i>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
            <hr class="custom-hr">
        @endforeach

        <div class="row">
            <div class="col-md-offset-3">
                <div class="add-comment">
                    <h3>Add Your Comment</h3>
                    <form action="/storeComment" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="video_id" value="{{$videos[0]->id}}">
                        <textarea name="comment" required></textarea>
                        <input type="submit" class="btn btn-primary" value="Add Comment">
                    </form>
                </div>
            </div>
        </div>
        <br><br>
        @if(Session::get('type')=='lecturer' && Session::get('frontSession')->id==$course->lec_id)
            <span class="pull-right confirm"><a href="/deleteVideo/{{$videos[0]->id}}"> Delete This Video </a></span>
        @endif
        <br><br>
    </div>
@endsection