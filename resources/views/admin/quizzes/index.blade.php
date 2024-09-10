@extends('layouts.admin')
@section('content')

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.quizzes.create") }}">
                    {{ trans('global.add') }} Quiz
                </a>
            </div>
        </div>

    <div class="card">
        <div class="card-header">
            Quizzes List
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Quiz">
                    <thead>
                    <tr>
                        <th width="10"></th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quizzes as $quiz)
                        <tr data-entry-id="{{ $quiz->id }}">
                            <td></td>
                            <td>{{ $quiz->id }}</td>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->course->name ?? '' }}</td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.quizzes.show', $quiz->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    <a class="btn btn-xs btn-info" href="{{ route('admin.quizzes.edit', $quiz->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
