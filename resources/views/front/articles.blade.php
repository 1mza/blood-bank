@extends('front.master')
@section('content')
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">المقالات</li>
                    </ol>
                </nav>
            </div>

            <!--requests-->
            <div class="requests">
                <div class="head-text">
                    <h2>المقالات</h2>
                </div>
                <div class="content">
                    <div class="patients">
                            @foreach($posts as $post)
                                <div class="details">
                                    <div>
                                        <img height="300" width="700" style="border-radius: 10%" src="{{asset('images/'.$post->image)}}">
                                    </div>
                                    <ul>
                                        <li><span><strong>العنوان:</strong></span>{{ $post->title }}</li>
                                        <li><span><strong>قسم:</strong></span>{{ $post->category->name }}</li>
                                        <li><span><strong>تفاصيل:</strong></span>{{ $post->detailed_title }}</li>
                                    </ul>
                                    <a href="{{ url('articles/' . $post->id) }}">التفاصيل</a>
                                </div>
                            @endforeach

                    </div>
                    <div class="pages">
                        <nav aria-label="Page navigation example" dir="ltr">
                                {{ $posts->total() <= 10 ? null : $posts->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
