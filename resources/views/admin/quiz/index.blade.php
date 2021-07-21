<x-app-layout>
    <x-slot name="header">
        Quizzes
    </x-slot>

    <x-slot name="breadcrumb">
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
                <a href="{{ route('quizzes.create')  }}" class="btn btn-sm btn-primary float-right"> <i
                        class="fa fa-plus"></i>
                    Create</a>
            </div>
                <form action="" method="GET" class="mb-2">
                    <div class="form-row">
                        <div class="col-md-2">
                            <input type="text" name="title" placeholder="Quiz Name" class="form-control"
                                   value="{{ request()->get('title') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                @foreach($status as $name => $value)
                                    <option
                                        value={{ $value }} @if(request()->get('status') == $value) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Clear</a>
                        </div>
                    </div>
                </form>
            @if($quizzes->count())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="width:40%" class="text-center">Name</th>
                            <th scope="col" class="text-center">Question Count</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">End Date</th>
                            <th scope="col" style="width:15%"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($quizzes as $quiz)
                            <tr>
                                <td> {{ $quiz->title }} </td>
                                <td class="text-center"> {{ $quiz->questions->count()  }} </td>
                                <td class="text-center">
                                    <div
                                        class="badge badge-{{\App\QuizStatus::getClass($quiz->status)}}">{{ \App\QuizStatus::getLabel($quiz->status) }}
                                    </div>
                                </td>
                                <td class="text-center"> {{ $quiz->finished_at?->diffForHumans() }} </td>
                                <td>
                                    <a href="{{ route('quizzes.show' ,$quiz) }}" class="btn btn-outline-secondary btn-sm"
                                       style="display:inline-block;margin-right:3px;"> <i
                                            class="fa fa-info-circle"></i></a>

                                    <a href="{{ route('questions.index' ,$quiz) }}" class="btn btn-outline-info btn-sm"
                                       style="display:inline-block;margin-right:3px;"> <i
                                            class="fa fa-question"></i></a>

                                    <a href="{{ route('quizzes.edit' ,$quiz) }}"
                                       class="btn btn-outline-secondary btn-sm"
                                       style="display:inline-block;margin-right:3px;"> <i class="fa fa-pen"></i></a>

                                    <form action="{{ route('quizzes.destroy' ,$quiz) }}" method="POST"
                                          style="display:inline-block;">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return deleteQuiz()"><i class="fa fa-trash"></i></button>
                                        {{ method_field('DELETE') }}
                                        {!! csrf_field() !!}
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">There is no quiz </div>
            @endif
            {{ $quizzes->links()  }}
        </div>
    </div>

    <script>
        function deleteQuiz() {
            if (!confirm("Are You Sure to delete this"))
                event.preventDefault();
        }
    </script>

</x-app-layout>
