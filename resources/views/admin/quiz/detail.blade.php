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
                    <span class="badge badge-primary badge-pill">{{ $quiz->questions_count }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    The number of participants
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Average Grade
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $quiz->description }}</p>
                    <a href="#" class="btn btn-primary float-right">Click to start quiz</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
