<x-app-layout>
    <x-slot name="header">
        Quizzes
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <a href="{{ route('quizzes.create')  }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Create</a>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Quiz</th>
                    <th scope="col">Status</th>
                    <th scope="col">End Date</th>
                    <th scope="col" style="width:10%"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($quizzes as $quiz)
                    <tr>
                        <th> {{ $quiz->title }} </th>
                        <td> {{ $quiz->status }} </td>
                        <td> {{ $quiz->finished_at }} </td>
                        <td>
                            <a href="{{ route('quizzes.edit' ,$quiz) }}" class="btn btn-secondary btn-sm" style="display:inline-block;margin-right:10px;"> <i class="fa fa-pen"></i></a>

                            <form action="{{ route('quizzes.destroy' ,$quiz) }}" method="POST" style="display:inline-block;">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                {{ method_field('DELETE') }}
                                {!! csrf_field() !!}
                            </form>
                            {{--<a href="{{ route('quizzes.destroy' ,$quiz) }}" class="btn btn-danger btn-sm"> </a>--}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            {{ $quizzes->links()  }}
        </div>
    </div>

</x-app-layout>
