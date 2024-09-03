@extends('front.master')
@section('content')
    @section('classname')
        article-details
    @endsection

        <!--inside-article-->
        <div class="inside-article">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="/articles">المقالات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">الوقاية من الأمراض</li>
                        </ol>
                    </nav>
                </div>
                <div class="article-image">
                    <img height="588" width="888"  src="{{asset('images/'.$post->image)}}">
                </div>
                <div class="article-title col-12">
                    <div class="h-text col-6">
                        <h4>{{$post->title}}</h4>
                    </div>
                    <div class="icon col-6">
                        @livewire('post-like', ['post' => $post])
                    </div>
                </div>

                <!--text-->
                <div class="text">
                    <p>{{$post->detailed_title}}</p>
                    <br>
                    <p>{{$post->content}}</p>
                </div>

                <!--articles-->
                <div class="articles">
                    <div class="title">
                        <div class="head-text">
                            <h2>مقالات ذات صلة</h2>
                        </div>
                    </div>
                    <div class="view">
                        <div class="row">
                            <!-- Set up your HTML -->
                            <div class="owl-carousel articles-carousel">
                                <div class="card">
                                    <div class="photo">
                                        <img src="{{asset('front/imgs/p2.jpg')}}" class="card-img-top" alt="...">
                                        <a href="article-details.html" class="click">المزيد</a>
                                    </div>
                                    <a href="#" class="favourite">
                                        <i class="far fa-heart"></i>
                                    </a>

                                    <div class="card-body">
                                        <h5 class="card-title">طريقة الوقاية من الأمراض</h5>
                                        <p class="card-text">
                                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                                        </p>
                                    </div>
                                </div>
                                @foreach(\App\Models\Post::get() as $posts)
                                    @if($post->id != $posts->id)
                                    <div class="card" style="width: 350px; height: 400px;">
                                        <div class="photo">
                                            <img width="347.73" height="230.26" src="{{ asset('images/'.$posts->image) }}"
                                                 class="card-img-top" alt="...">
                                            <a href="{{url('articles/'.$posts->id)}}" class="click">المزيد</a>
                                        </div>
                                        @livewire('post-like', ['post' => $posts])

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $posts->title }}</h5>
                                            <p class="card-text">{{ $posts->detailed_title }}</p>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
