@extends('front.template')

@section('main')

    <div class="row">

        <div class="col-lg-12">
            {!! Form::open(['url' => 'blog/search', 'method' => 'get', 'role' => 'form', 'class' => 'pull-right']) !!}  
                {!! Form::controlBootstrap('text', 12, 'search', $errors, null, null, null, trans('front/blog.search')) !!}
            {!! Form::close() !!}
        </div>

    </div>

    <div class="row">

        @foreach($posts as $post)
            <div class="box">
                <div class="col-lg-12 text-center">
                    <h2>
                    @if(App::isLocale('en'))
                        {{ $post->title_en }}
                    @else
                        {{ $post->title_bn }}
                    @endif
                    <br>
                    <small>{!! $post->user->username . ' ' . trans('front/blog.on') . ' ' . strstr($post->created_at, ' ', true) . ($post->created_at != $post->updated_at ? trans('front/blog.updated') . strstr($post->updated_at, ' ', true) : '') !!}</small>
                    </h2>
                </div>
                <div class="col-lg-12">
                    <p>
                    @if(App::isLocale('en'))
                        {!! $post->summary_en !!}
                    @else
                        {!! $post->summary_bn !!}
                    @endif</p>
                </div>
                <div class="col-lg-12 text-center">
                    {!! link_to('blog/' . $post->slug, trans('front/blog.button'), ['class' => 'btn btn-default btn-lg']) !!}
                    <hr>
                </div>
            </div>
        @endforeach
     
        <div class="col-lg-12 text-center">
            {!! $posts->links() !!}
        </div>

    </div>

@endsection

