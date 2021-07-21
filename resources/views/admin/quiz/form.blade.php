<x-app-layout>
    <x-slot name="header">
        Quizzes
    </x-slot>

    <x-slot name="breadcrumb">
        <a href="{{ route('quizzes.index') }}">Quizzes</a> &#x2192; {{ $quiz->exists ? 'Edit' : 'Create' }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ $quiz->exists ? route('quizzes.update',$quiz) : route('quizzes.store')}}" method="POST">
                @csrf

                @if($quiz->exists)
                    {{ method_field('PUT') }}
                @endif

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
                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="4">{{ old('description' ,$quiz->description) }}</textarea>

                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        @foreach($status as $name => $value)

                            <option value={{ $value }} {{ $value == $quiz->status ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>

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
                        @if($quiz->finished_at) value="{{  $quiz->finished_at }} @endif"
                    >

                    @if ($errors->has('finished_at'))
                        <div class="invalid-feedback">
                            {{ $errors->first('finished_at') }}
                        </div>
                    @endif
                </div>

                <div class="float-right">
                    <button type="submit"
                            class="btn btn-primary">{{ $quiz->exists ? 'Edit' : 'Create' }} Quiz
                    </button>
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

