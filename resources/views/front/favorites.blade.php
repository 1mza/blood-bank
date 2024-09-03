@extends('front.master')
@section('content')
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">المفضلة</li>
                    </ol>
                </nav>
            </div>

            <!--requests-->
            <div class="requests">
                <div class="head-text">
                    <h2>المفضلة</h2>
                </div>
                <div class="content">
                    <div class="patients">
                            @foreach($favorites as $favorite)
                                <div class="details">
                                    <div>
                                        <img height="300" width="700" style="border-radius: 10%" src="{{asset('images/'.$favorite->post->image)}}">
                                    </div>
                                    <ul>
                                        <li><span><strong>العنوان:</strong></span>{{ $favorite->post->title }}</li>
                                        <li><span><strong>قسم:</strong></span>{{ $favorite->post->category->name }}</li>
                                        <li><span><strong>تفاصيل:</strong></span>{{ $favorite->post->detailed_title }}</li>
                                    </ul>
                                    <a href="{{ url('articles/' . $favorite->post->id) }}">التفاصيل</a>
                                </div>
                            @endforeach

                    </div>
                    <div class="pages">
                        <nav aria-label="Page navigation example" dir="ltr">
                                {{ $favorites->total() <= 10 ? null : $favorites->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
