@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.view') }} Answer
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.answers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>
                        ID
                    </th>
                    <td>
                        {{ $answer->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Answer Text
                    </th>
                    <td>
                        {{ $answer->answer_text }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Question
                    </th>
                    <td>
                        {{ $answer->question->question_text ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Is Correct?
                    </th>
                    <td>
                        {{ $answer->is_correct ? 'Yes' : 'No' }}
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.answers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>

@endsection
