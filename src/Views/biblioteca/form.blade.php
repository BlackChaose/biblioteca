@if($form_type==='create')
    <div class="form-group">
        {{ Form::label('добавить книгу', 'книга',['class'=>'form-label']) }}
        {{ Form::textArea('name',null,['class'=>'form-control ','rows'=>'2','required'=>'required','placeholder'=>'новая книга']) }}
        <div class="invalid-feedback">
            Добавть книгу
        </div>
        <div class="valid-feedback">
            ok!
        </div>
        {{ Form::textArea('description',null,['class'=>'form-control ', 'rows'=>'3', 'placeholder'=>'описание']) }}
        <div class="invalid-feedback">
            Добавьте описание
        </div>
        <div class="valid-feedback">
            ok!
        </div>
        {{ Form::text('lang',null,['class'=>'form-control ', 'placeholder'=>'ES->RU', 'value'=>'ES-RU']) }}
        <div class="invalid-feedback">
            Добавьте язык, например испанско-русский - "ES->RU"
        </div>
        <div class="valid-feedback">
            ok!
        </div>
        {{ Form::text('author',null,['class'=>'form-control ', 'placeholder'=>'Автор', 'value'=>'Автор']) }}
        <div class="invalid-feedback">
            Добавьте имя автора
        </div>
        <div class="valid-feedback">
            ok!
        </div>
        {{ Form::file('book_file',null,['class'=>'form-control'])}}
        <div class="invalid-feedback">
            Добавьте файл
        </div>
        <div class="valid-feedback">
            ok!
        </div>
    </div>
@endif
@if($form_type==='edit')
    <div class="form-group">
        {{ Form::label('название книги', 'название книги',['class'=>'form-label']) }}
        {{ Form::textArea('name',null,['class'=>'form-control ','rows'=>'2','required'=>'required','placeholder'=>'Назавание']) }}
        <div class="invalid-feedback">
            поле название обязательно для заполнения
        </div>
        <div class="valid-feedback">
            ok!
        </div>
        {{ Form::textArea('description',null,['class'=>'form-control ', 'rows'=>'3', 'required'=>'required','placeholder'=>'описание']) }}
        <div class="invalid-feedback">
            описание книги
        </div>
        <div class="valid-feedback">
            ok!
        </div>
        {{ Form::text('lang',null,['class'=>'form-control ', 'required'=>'required', 'placeholder'=>'ES->RU']) }}
        <div class="invalid-feedback">
            язык книги
        </div>
        <div class="valid-feedback">
            ok!
        </div>
        {{ Form::text('author',null,['class'=>'form-control ', 'required'=>'required', 'placeholder'=>'1', 'value'=>'аффтор!']) }}
        <div class="invalid-feedback">
            имя автора книги
        </div>
        <div class="valid-feedback">
            ok!
        </div>
        @if(!empty($biblioteca->attached_file[0]))
            <div class="bg-light p-1 m-1 rounded-1"><a class="btn btn-link" id="attached_book" href="{{url($biblioteca->attached_file[0]->id)}}">{{$biblioteca->attached_file[0]->file_orig_name}}</a><a id="delete_attached_book" class="btn btn-link" href="#"><i class="fas fa-trash-alt"></i></a></div>
            <input id="input_ab" name="file_delete" type="hidden" value="FALSE">
            <span id="input_ab_warning" class="text-warning small d-none">файл книги будет удален!</span>
        @else
            {{ Form::file('book_file',null,['class'=>'form-control'])}}
            <div class="invalid-feedback">
                файл книги
            </div>
            <div class="valid-feedback">
                ok!
            </div>
        @endif
    </div>
@endif
