<x-app-layout>
    <x-slot name="header">
        {{ $quiz->title }}
    </x-slot>

    <x-slot name="breadcrumb">
        {{ $quiz->title }}
    </x-slot>

    <div class="row">
        <div class="col-4">
            <ul class="list-group">
                @if($quiz->my_rank)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Your Rank
                        <span class="badge badge-success badge-pill">#{{ $quiz->my_rank}}</span>
                    </li>
                @endif
                @if($quiz->result)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Grade
                        <span class="badge badge-primary badge-pill">{{ $quiz?->result->grade}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Number of correct / incorrect questions
                        <span
                            class="badge badge-warning badge-pill">{{ $quiz?->result->correct }} / {{ $quiz?->result->wrong }}</span>
                    </li>
                @endif
                @if($quiz->finished_at)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Last Date to join
                        <span class="badge badge-danger badge-pill">{{ $quiz->finished_at->diffForHumans() }}</span>
                    </li>
                @endif
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Question count
                    <span class="badge badge-info badge-pill">{{ $quiz->questions_count }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    The number of participants
                    <span class="badge badge-secondary badge-pill">{{ $quiz->details['join_count'] }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Average Grade
                    <span class="badge badge-info badge-pill">{{ $quiz->details['average'] }}</span>
                </li>
            </ul>

            @if(empty($quiz->topTen))
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Top 10</h5>
                        <ul class="list-group">
                            @foreach($quiz->topTen as $item )
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong class="h-3">{{ $loop->iteration }}.</strong>
                                    <img src="{{ $item->user->profile_photo_url }}" alt="{{ $item->user->name }}"
                                         class="w-8 h-8 rounded-full">
                                    {{ $item->user->name }}
                                    <span class="badge badge-success badge-pill"> {{$item->grade}} </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>


        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $quiz->description }}</p>
                    @if($quiz->result)
                        <a href="{{ route('quiz.join', $quiz->slug)  }}" class="btn btn-warning float-right">
                            Show Quiz
                        </a>
                    @elseif($quiz->finished_at && $quiz->finished_at < now())
                        <button type="button" class="btn btn-danger float-right" disabled="">You can no longer join to this quiz</button>
                    @else
                        <a href="{{ route('quiz.join', $quiz->slug)  }}" class="btn btn-primary float-right">
                            Click to start quiz
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
