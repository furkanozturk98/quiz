<x-app-layout>
    <x-slot name="header">
        {{ $quiz->exists ? 'Edit' : 'Create' }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ $quiz->exist ? route('quizzes.update',$quiz) : route('quizzes.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                           value="{{ old('title', $quiz->title) }}">

                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description"
                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="4">
                            {{ old('description' ,$quiz->description) }}
                        </textarea>

                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input type="checkbox" @if($quiz->finished_at !== null) checked @endif onchange="change()">
                    <label>Will there be an end date?</label>
                </div>
                <div id="finished" class="form-group" @if($quiz->finished_at == null ) style="display: none" @endif>
                    <label>End Date</label>

                    <input
                        type="datetime-local" name="finished_at"
                        class="form-control {{ $errors->has('finished_at') ? 'is-invalid' : '' }}"
                        value="{{ old('finished_at', date('Y-m-d\TH:i',strtotime($quiz->finished_at))) }}"
                    >

                    @if ($errors->has('finished_at'))
                        <div class="invalid-feedback">
                            {{ $errors->first('finished_at') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Quiz Create</button>
                </div>

            </form>
        </div>
    </div>

    <x-slot name="js">
        <script>
            function change() {
                let element = document.getElementById('finished');

                if (element.style.display === 'none') {
                    element.style.display = 'block';
                    return;
                }
                element.style.display = 'none';
            }
        </script>
    </x-slot>


</x-app-layout>
