<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['user_id', 'quiz_id', 'score'];


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submissionAnswers()
    {
        return $this->hasMany(SubmissionAnswer::class);
    }

    public function answers()
    {
        return $this->hasMany(SubmissionAnswer::class);
    }



}
