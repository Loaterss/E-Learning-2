@extends('navbar')

@section('content')
    <div class="container" style="border: 1px solid #ddd; padding: 20px; padding-bottom: 5px; border-radius: 5px;" >
        <div class="row">
            @foreach ($courses as $course)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img class="img-responsive center-block" style=" height: 250px;" src='{{asset("coursePic/".$course->coursePic)}}'>
                    <div class="caption">
                        <h3><a href="/courses/{{$course->id}}"> {{$course->subject}}</a></h3>
                        <p>Added by: {{$course->lecturer->fullName}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

