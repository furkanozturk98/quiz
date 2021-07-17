<x-app-layout>
    <x-slot name="header">
        Questions
    </x-slot>

    <x-slot name="breadcrumb">
        <a href="{{route('quizzes.index')}}"> Quizzes </a> &#x2192; {{ $quiz->title }} &#x2192; Questions
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <a href="{{ route('questions.create',$quiz)  }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i>
                    Create
                </a>
            </div>
            @if($quiz->questions->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Question</th>
                    <th>Image</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                    <th>Correct Answer</th>
                    <th style="width:100px"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($quiz->questions as $question)
                    <tr>
                        <td> {{ $question->question }} </td>
                        <td>
                            @if($question->image)
                                <a href="{{asset('uploads/'.$question->image)}}" target = "_blank" class="btn btn-sm btn-secondary">Show</a>
                            @endif
                        </td>
                        <td> {{ $question->option_a }} </td>
                        <td> {{ $question->option_b }} </td>
                        <td> {{ $question->option_c }} </td>
                        <td> {{ $question->option_d }} </td>
                        <td> {{ $question->option_e }} </td>
                        <td> {{ \App\QuestionOptions::getLabel($question->correct_answer) }} </td>
                        <td>
                            <a href="{{ route('questions.edit' ,[ $quiz, $question ]) }}" class="btn btn-outline-secondary btn-sm"
                               style="display:inline-block;margin-right:3px;"> <i class="fa fa-pen"></i></a>

                            <form action="{{ route('questions.destroy' ,[ $quiz, $question ]) }}" method="POST"
                                  style="display:inline-block;">
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                                {{ method_field('DELETE') }}
                                {!! csrf_field() !!}
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            @else
                <div class="alert alert-danger">This quiz dont have any question yet</div>
            @endif
            {{--{{ $quizzes->links()  }}--}}
        </div>
    </div>

</x-app-layout>
