<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Question;
use App\Models\QAFollow;
use App\Models\QATagRelation;

class QATagRelation extends Model
{
    use HasFactory;

    public function question() {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
