<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;
use App\Models\User;
use App\Models\QAFollow;

class Answer extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question() {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function qafollow() {
        return $this->hasMany(QAFollow::class);
    }
}
