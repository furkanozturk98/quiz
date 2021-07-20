<x-app-layout>
    <x-slot name="header">
        {{ $quiz->title }}
    </x-slot>

    <x-slot name="breadcrumb">
        {{ $quiz->title }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="card-text">
                <form method="POST" action="{{ route('quiz.join.store',$quiz->slug )  }}">
                    @csrf
                    @foreach($quiz->questions as $question)

                        <strong> {{ $loop->iteration .'. '. $question->question }}</strong>

                        @if($question->image)
                            <img src="{{asset('uploads/'.$question->image)}}" style="width: 35%;"
                                 class="img-responsive"/>
                        @endif

                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                   id="{{ $question->id}}1"
                                   value="option_a" required>
                            <label class="form-check-label" for="{{ $question->id}}1">
                                {{$question->option_a}}
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                   id="{{ $question->id}}2"
                                   value="option_b" required>
                            <label class="form-check-label" for="{{ $question->id}}2">
                                {{$question->option_b}}
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                   id="{{ $question->id}}3"
                                   value="option_c" required>
                            <label class="form-check-label" for="{{ $question->id}}3">
                                {{$question->option_c}}
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                   id="{{ $question->id}}4"
                                   value="option_d" required>
                            <label class="form-check-label" for="{{ $question->id}}4">
                                {{$question->option_d}}
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                   id="{{ $question->id}}5"
                                   value="option_e" required>
                            <label class="form-check-label" for="{{ $question->id}}5">
                                {{$question->option_e}}
                            </label>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach

                    <button type="submit" class="btn btn-primary float-right">End quiz</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
