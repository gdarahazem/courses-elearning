@extends('layouts.admin')
@section('content')

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.answers.create") }}">
                    {{ trans('global.add') }} Answer
                </a>
            </div>
        </div>

    <div class="card">
        <div class="card-header">
            Answers List
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Answer">
                    <thead>
                    <tr>
                        <th width="10"></th>
                        <th>ID</th>
                        <th>Answer Text</th>
                        <th>Question</th>
                        <th>Is Correct</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($answers as $answer)
                        <tr>
                            <td></td>
                            <td>{{ $answer->id }}</td>
                            <td>{{ $answer->answer_text }}</td>
                            <td>{{ $answer->question->question_text ?? '' }}</td>
                            <td>{{ $answer->is_correct ? 'Yes' : 'No' }}</td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.answers.show', $answer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    <a class="btn btn-xs btn-info" href="{{ route('admin.answers.edit', $answer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.answers.destroy', $answer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
