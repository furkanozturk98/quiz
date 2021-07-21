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

            @if(!empty($quiz->topTen))
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
                    <p class="card-text mb-3">{{ $quiz->description }}</p>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Name Surname</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Correct</th>
                            <th scope="col">Incorrect</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quiz->results as $result)
                            <tr>
                                <td>{{ $result->user->name }}</td>
                                <td>{{ $result->grade }}</td>
                                <td>{{ $result->correct }}</td>
                                <td>{{ $result->wrong }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
