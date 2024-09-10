@extends('layouts.admin')
@section('content')

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.questions.create") }}">
                    {{ trans('global.add') }} Question
                </a>
            </div>
        </div>

    <div class="card">
        <div class="card-header">
            Questions List
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Question">
                    <thead>
                    <tr>
                        <th width="10"></th>
                        <th>ID</th>
                        <th>Question Text</th>
                        <th>Quiz</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td></td>
                            <td>{{ $question->id }}</td>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ $question->quiz->title ?? '' }}</td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.questions.show', $question->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    <a class="btn btn-xs btn-info" href="{{ route('admin.questions.edit', $question->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
