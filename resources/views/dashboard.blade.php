<x-app-layout>
    <x-slot name="header">
        Home
    </x-slot>

    <x-slot name="breadcrumb">
        Home
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-8">
            <div class="list-group">
                @if($quizzes->count())
                    @foreach($quizzes as $quiz)
                        <a href="{{ route('quiz.detail', $quiz->slug) }}"
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$quiz->title}}</h5>
                                <small>{{ $quiz->finished_at ? 'Ends in ' . $quiz->finished_at->diffForHumans() : ''}}</small>
                            </div>
                            <p class="mb-1">{{ Str::limit($quiz->description,100)}}</p>
                            <small>{{ $quiz->questions_count . ' questions' }}</small>
                        </a>
                    @endforeach

                    <div class="mt-2">
                        {{ $quizzes->links() }}
                    </div>
                @else
                    <div class="alert alert-danger">There is no active quiz yet.</div>
                @endif
            </div>
        </div>

        @if(empty($results))
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Quiz Results
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($results as $result)
                            <li class="list-group-item">
                                <span class="badge badge-success">{{ $result->grade }} </span>
                                <a href="{{route('quiz.detail',$result->quiz->slug)}}">{{ $result->quiz->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
