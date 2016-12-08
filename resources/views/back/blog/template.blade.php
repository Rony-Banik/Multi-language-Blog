@extends('back.template')

@section('head')

    {!! HTML::style('ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') !!}

@endsection

@section('main')

    @include('back.partials.entete', ['title' => trans('back/blog.dashboard'), 'icon' => 'pencil', 'fil' => link_to('blog', trans('back/blog.posts')) . ' / ' . trans('back/blog.creation')])

    <div class="col-sm-12">
        @yield('form')

            <div class="form-group checkbox pull-right">
                <label>
                    {!! Form::checkbox('active') !!}
                    {{ trans('back/blog.published') }}
                </label>
            </div>

            {!! Form::controlBootstrap('text', 0, 'title_en', $errors, trans('back/blog.title_en')) !!}
            {!! Form::controlBootstrap('text', 0, 'title_bn', $errors, trans('back/blog.title_bn')) !!}

            <div class="form-group {!! $errors->has('slug') ? 'has-error' : '' !!}">
                {!! Form::label('slug', trans('back/blog.permalink'), ['class' => 'control-label']) !!}
                {!! url('/') . '/blog/' . Form::text('slug', null, ['id' => 'permalink']) !!}
                <small class="text-danger">{!! $errors->first('slug') !!}</small>
            </div>

            {!! Form::controlBootstrap('textarea', 0, 'summary_en', $errors, trans('back/blog.summary_en')) !!}
            {!! Form::controlBootstrap('textarea', 0, 'summary_bn', $errors, trans('back/blog.summary_bn')) !!}
            {!! Form::controlBootstrap('textarea', 0, 'content_en', $errors, trans('back/blog.content_en')) !!}
            {!! Form::controlBootstrap('textarea', 0, 'content_bn', $errors, trans('back/blog.content_bn')) !!}
            {!! Form::controlBootstrap('text', 0, 'tags', $errors, trans('back/blog.tags'), isset($tags)? implode(',', $tags) : '') !!}

            {!! Form::submitBootstrap(trans('front/form.send')) !!}

        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')

    {!! HTML::script('ckeditor/ckeditor.js') !!}

    <script>

        var config = {
            codeSnippet_theme: 'Monokai',
            language: '{{ config('app.locale') }}',
            height: 100,
            filebrowserBrowseUrl: '/elfinder/ckeditor',
            toolbarGroups: [
                {name: 'clipboard', groups: ['clipboard', 'undo']},
                {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
                {name: 'links'},
                {name: 'insert'},
                {name: 'forms'},
                {name: 'tools'},
                {name: 'document', groups: ['mode', 'document', 'doctools']},
                {name: 'others'},
                //'/',
                {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
                {name: 'styles'},
                {name: 'colors'}
            ]
        };

        CKEDITOR.replace('summary_en', config);
        CKEDITOR.replace('summary_bn', config);


        config['height'] = 400;

        CKEDITOR.replace('content_en', config);
        CKEDITOR.replace('content_bn', config);

        function removeAccents(str) {
            var accent = [
                /[\300-\306]/g, /[\340-\346]/g, // A, a
                /[\310-\313]/g, /[\350-\353]/g, // E, e
                /[\314-\317]/g, /[\354-\357]/g, // I, i
                /[\322-\330]/g, /[\362-\370]/g, // O, o
                /[\331-\334]/g, /[\371-\374]/g, // U, u
                /[\321]/g, /[\361]/g, // N, n
                /[\307]/g, /[\347]/g // C, c
            ];
            var noaccent = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];
            for (var i = 0; i < accent.length; ++i) {
                str = str.replace(accent[i], noaccent[i]);
            }
            return str;
        }

        $("#title_en").keyup(function () {
            var str = removeAccents($(this).val())
                .replace(/[^a-zA-Z0-9\s]/g, "")
                .toLowerCase()
                .replace(/\s/g, '-');
            $("#permalink").val(str);
        });

    </script>

@endsection