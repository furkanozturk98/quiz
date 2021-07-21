<x-app-layout>
    <x-slot name="header">
        {{ $quiz->title }}
    </x-slot>

    <x-slot name="breadcrumb">
        {{ $quiz->title }}  {{ $quiz->result ? ' Result' : '' }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="card-text">

                @if($quiz->result)

                    <h2 class="mb-3">
                        Grade: <strong>{{ $quiz->result->grade }}</strong>
                    </h2>

                    <div class="alert alert-info mb-3">
                        <i class="fa fa-square"></i> Your choice<br>
                        <i class="fa fa-check text-success"></i> Correct Answer<br>
                        <i class="fa fa-times text-danger"></i> Incorrect Answer<br>
                    </div>
                @endif

                <form method="POST" action="{{ route('quiz.join.store',$quiz->slug )  }}">
                    @csrf
                    @foreach($quiz->questions as $question)

                        <p class="text-sm text-info">Users gave {{ $question->true_percent }}% correct answer to this question</p>

                        @if($quiz->result)
                            @if($question->correct_answer == $question->my_answer->answer)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        @endif
                        <strong>{{ $loop->iteration .'. '. $question->question }}</strong>

                        @if($question->image)
                            <img src="{{asset('uploads/'.$question->image)}}" style="width: 35%;"
                                 class="img-responsive"/>
                        @endif

                        <div class="form-check mt-2">
                            @if(!$quiz->result)
                                <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                       id="{{ $question->id}}1"
                                       value="option_a" required>
                            @else
                                @if($question->correct_answer == 'option_a')
                                    <i class="fa fa-check text-success"></i>
                                @elseif($question->my_answer->answer == 'option_a')
                                    <i class="fa fa-circle"></i>
                                @endif
                            @endif
                            <label class="form-check-label" for="{{ $question->id}}1">
                                {{$question->option_a}}
                            </label>
                        </div>

                        <div class="form-check">
                            @if(!$quiz->result)
                                <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                       id="{{ $question->id}}2"
                                       value="option_b" required>
                            @else
                                @if($question->correct_answer == 'option_b')
                                    <i class="fa fa-check text-success"></i>
                                @elseif($question->my_answer->answer == 'option_b')
                                    <i class="fa fa-circle"></i>
                                @endif
                            @endif
                            <label class="form-check-label" for="{{ $question->id}}2">
                                {{$question->option_b}}
                            </label>
                        </div>

                        <div class="form-check">

                            @if(!$quiz->result)
                                <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                       id="{{ $question->id}}3"
                                       value="option_c" required>
                            @else
                                @if($question->correct_answer == 'option_c')
                                    <i class="fa fa-check text-success"></i>
                                @elseif($question->my_answer->answer == 'option_c')
                                    <i class="fa fa-circle"></i>
                                @endif
                            @endif

                            <label class="form-check-label" for="{{ $question->id}}3">
                                {{$question->option_c}}
                            </label>
                        </div>

                        <div class="form-check">
                            @if(!$quiz->result)
                                <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                       id="{{ $question->id}}4"
                                       value="option_d" required>
                            @else
                                @if($question->correct_answer == 'option_d')
                                    <i class="fa fa-check text-success"></i>
                                @elseif($question->my_answer->answer == 'option_d')
                                    <i class="fa fa-circle"></i>
                                @endif
                            @endif

                            <label class="form-check-label" for="{{ $question->id}}4">
                                {{$question->option_d}}
                            </label>
                        </div>


                        <div class="form-check">
                            @if(!$quiz->result)
                                <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                       id="{{ $question->id}}5"
                                       value="option_e" required>
                            @else
                                @if($question->correct_answer == 'option_e')
                                    <i class="fa fa-check text-success"></i>
                                @elseif($question->my_answer->answer == 'option_e')
                                    <i class="fa fa-circle"></i>
                                @endif
                            @endif

                            <label class="form-check-label" for="{{ $question->id}}5">
                                {{$question->option_e}}
                            </label>
                        </div>

                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach

                    @if(!$quiz->result)
                        <button type="submit" class="btn btn-primary float-right">End quiz</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
