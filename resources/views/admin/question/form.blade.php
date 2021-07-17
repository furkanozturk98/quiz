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
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Answer 1</label>
                            <textarea name="answer1"
                                      class="form-control {{ $errors->has('answer1') ? 'is-invalid' : '' }}" rows="2">{{ old('answer1' ,$question->answer1) }}</textarea>

                            @if ($errors->has('answer1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('answer1') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Answer 2</label>
                            <textarea name="answer2"
                                      class="form-control {{ $errors->has('answer2') ? 'is-invalid' : '' }}" rows="2">{{old('answer2' ,$question->answer2) }}</textarea>

                            @if ($errors->has('answer2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('answer2') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Answer 3</label>
                            <textarea name="answer3"
                                      class="form-control {{ $errors->has('answer3') ? 'is-invalid' : '' }}" rows="2">{{ old('answer3' ,$question->answer3) }}</textarea>

                            @if ($errors->has('answer3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('answer3') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Answer 4</label>
                            <textarea name="answer4"
                                      class="form-control {{ $errors->has('answer4') ? 'is-invalid' : '' }}" rows="2">{{ old('answer4' ,$question->answer4) }}</textarea>

                            @if ($errors->has('answer4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('answer4') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <select name="correct_answer" class="form-control">
                        <option value="answer1">First answer</option>
                        <option value="answer2">Second answer</option>
                        <option value="answer3">Third answer</option>
                        <option value="answer4">Fourth answer</option>
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
