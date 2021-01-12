<x-app-layout>
    <x-slot name="header">
        Questions
    </x-slot>

    <x-slot name="breadcrumb">
        <a href="{{route('quizzes.index')}}"> Quizzes </a> &#x2192; Questions
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

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Image</th>
                    <th scope="col">1. Answer</th>
                    <th scope="col">2. Answer</th>
                    <th scope="col">3. Answer</th>
                    <th scope="col">4. Answer</th>
                    <th scope="col">Correct Answer</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($quiz->questions as $question)
                    <tr>
                        <th> {{ $question->question }} </th>
                        <td> {{ $question->image }} </td>
                        <td> {{ $question->answer1 }} </td>
                        <td> {{ $question->answer2 }} </td>
                        <td> {{ $question->answer3 }} </td>
                        <td> {{ $question->answer4 }} </td>
                        <td> {{ $question->correct_answer }} </td>
                        <td>
                            <a href="{{ route('questions.index' ,$question) }}" class="btn btn-warning btn-sm"
                               style="display:inline-block;margin-right:3px;"> <i class="fa fa-question"></i></a>

                            <a href="{{ route('questions.edit' ,[ $quiz, $question ]) }}" class="btn btn-secondary btn-sm"
                               style="display:inline-block;margin-right:3px;"> <i class="fa fa-pen"></i></a>

                            <form action="{{ route('questions.destroy' ,[ $quiz, $question ]) }}" method="POST"
                                  style="display:inline-block;">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                {{ method_field('DELETE') }}
                                {!! csrf_field() !!}
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            {{--{{ $quizzes->links()  }}--}}
        </div>
    </div>

</x-app-layout>
