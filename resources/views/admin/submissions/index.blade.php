@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Submissions List
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Submission">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Quiz</th>
                        <th>Score</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td>{{ $submission->id }}</td>
                            <td>{{ $submission->user->name }}</td>
                            <td>{{ $submission->quiz->title }}</td>
                            <td>
                                @php
                                    $totalQuestions = $submission->quiz->questions->count();
                                    $score = $submission->score;
                                    $scorePercentage = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;
                                @endphp
                                {{ $score }} / {{ $totalQuestions }} ({{ round($scorePercentage, 2) }}%)
                            </td>
                            <td>
                                @if($scorePercentage >= 50)
                                    <span class="badge badge-success">Succeeded</span>
                                @else
                                    <span class="badge badge-danger">Failed</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.submissions.show', $submission->id) }}">
                                    View
                                </a>

                                <form action="{{ route('admin.submissions.destroy', $submission->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
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
