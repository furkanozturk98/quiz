<x-app-layout>
    <x-slot name="header">
        Quizzes
    </x-slot>

    <x-slot name="breadcrumb">
        <a href="{{ route('quizzes.index',$quiz) }}">Quizzes</a> &#x2192; <a href="{{ route('questions.index',$quiz) }}">{{ $quiz->title }}</a> &#x2192; {{ $question->exists ? 'Edit' : 'Create' }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ $question->exists ? route('questions.update', [$quiz, $question] ) : route('questions.store',$quiz)}}" enctype="multipart/form-data" method="POST">
                @csrf

                @if($question->exists)
                    {{ method_field('PUT') }}
                @endif

                <div class="form-group">
                    <label>Question</label>
                    <textarea type="text" name="question" class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" rows="4">{{ old('question', $question->question) }}</textarea>

                    @if ($errors->has('question'))
                        <div class="invalid-feedback">
                            {{ $errors->first('question') }}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">

                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif

                    @if($question->image)
                        <img src="{{asset('uploads/'.$question->image)}}" height="150" width="200" style="margin-top: 15px">
                    @endif
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Answer 1</label>
                            <textarea name="option_a"
                                      class="form-control {{ $errors->has('option_a') ? 'is-invalid' : '' }}" rows="2">{{ old('option_a' ,$question->option_a) }}</textarea>

                            @if ($errors->has('option_a'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('option_a') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Answer 2</label>
                            <textarea name="option_b"
                                      class="form-control {{ $errors->has('option_b') ? 'is-invalid' : '' }}" rows="2">{{old('option_b' ,$question->option_b) }}</textarea>

                            @if ($errors->has('option_b'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('option_b') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Answer 3</label>
                            <textarea name="option_c"
                                      class="form-control {{ $errors->has('option_c') ? 'is-invalid' : '' }}" rows="2">{{ old('option_c' ,$question->option_c) }}</textarea>

                            @if ($errors->has('option_c'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('option_c') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Answer 4</label>
                            <textarea name="option_d"
                                      class="form-control {{ $errors->has('option_d') ? 'is-invalid' : '' }}" rows="2">{{ old('option_d' ,$question->option_d) }}</textarea>

                            @if ($errors->has('option_d'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('option_d') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Answer 4</label>
                            <textarea name="option_e"
                                      class="form-control {{ $errors->has('option_e') ? 'is-invalid' : '' }}" rows="2">{{ old('option_e' ,$question->option_e) }}</textarea>

                            @if ($errors->has('option_e'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('option_e') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Correct Answer</label>
                    <select name="correct_answer" class="form-control">
                        <option value="option_a">A</option>
                        <option value="option_b">B</option>
                        <option value="option_c">C</option>
                        <option value="option_d">D</option>
                        <option value="option_e">E</option>
                    </select>
                </div>

                <div class="float-right">
                    <button type="submit" class="btn btn-primary">{{ $question->exists ? 'Edit' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="js">
        <script>
            function change() {
                let element = document.getElementById('finished');

                if (element.style.display === 'none') {
                    element.style.display = 'block';
                    return;
                }
                element.style.display = 'none';
            }
        </script>
    </x-slot>


</x-app-layout>
