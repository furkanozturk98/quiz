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
                <a href="{{ route('questions.create',$quiz)  }}" class="btn btn-sm btn-primary float-right mb-2"> <i
                        class="fa fa-plus"></i>
                    Create
                </a>
            </div>
            @if($questions->count())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Question</th>
                            <th scope="col" class="text-center">A</th>
                            <th scope="col" class="text-center">B</th>
                            <th scope="col" class="text-center">C</th>
                            <th scope="col" class="text-center">D</th>
                            <th scope="col" class="text-center">E</th>
                            <th scope="col" class="text-center">Answer</th>
                            <th style="width:100px"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($questions as $question)
                            <tr>
                                <td> {{ $question->question }} </td>
                                <td class="text-center"> {{ $question->option_a }} </td>
                                <td class="text-center"> {{ $question->option_b }} </td>
                                <td class="text-center"> {{ $question->option_c }} </td>
                                <td class="text-center"> {{ $question->option_d }} </td>
                                <td class="text-center"> {{ $question->option_e }} </td>
                                <td class="text-center"> <div class="badge badge-success" style="font-size: 15px">{{ \App\QuestionOptions::getLabel($question->correct_answer) }} </div></td>
                                <td>
                                    <a href="{{ route('questions.edit' ,[ $quiz, $question ]) }}"
                                       class="btn btn-outline-secondary btn-sm"
                                       style="display:inline-block;margin-right:3px;"> <i class="fa fa-pen"></i></a>

                                    <form action="{{ route('questions.destroy' ,[ $quiz, $question ]) }}" method="POST"
                                          style="display:inline-block;">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return deleteQuestion();"><i class="fa fa-trash"></i></button>
                                        {{ method_field('DELETE') }}
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">This quiz dont have any question yet</div>
            @endif
            {{ $questions->links() }}
        </div>
    </div>

    <script>
        function deleteQuestion() {
            if (!confirm("Are You Sure to delete this"))
                event.preventDefault();
        }
    </script>

</x-app-layout>
