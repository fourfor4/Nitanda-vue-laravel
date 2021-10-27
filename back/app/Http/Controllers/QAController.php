<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QAFollow;
use App\Models\QATagRelation;

use App\Events\QACreated;

use Illuminate\Http\Request;

class QAController extends Controller
{
    //

    function retrieveQAGroup(Request $request) {
        $current_count = $request->currentCount;
        $query = Question::with('user')
                        ->with('answer')
                        ->with('answer.user')
                        ->with('tagRelation')
                        ->where('del_flag', '0')
                        ->orderBy('updated_at', 'desc');

        $questions = $this->filter($query, $request->search)->skip($current_count)->take(5)->get();

        foreach ($questions as $key => $question) {
            $question->score = QAFollow::where('follow_id', $question->id)->where('category', 1)->sum('score');
            $question->showAll = false;
            foreach ($question->answer as $key => $answer) {
                $answer->score = QAFollow::where('follow_id', $answer->id)->where('category', 2)->sum('score');
            }
        }
        
        return response()->json([
            'success' => true,
            'msg' => [
                'qaGroups' => $questions,
                'totalCount' => $this->filter(Question::where('del_flag', '0'), $request->search)->count()
            ]
        ]);
    }

    function filter($query, $filters) {
        $temp = $query;
        foreach ($filters as $filter) {
            $temp = $temp->contentFilter($filter);
        }
        return $temp;
    }

    function postQuestion(Request $request) {
        $upload_path = public_path('upload/qa');
        $file = $request->file('attachment');
        $attachmentName = '';

        $question = new Question();

        if ($file) {
            $attachmentName = 'question' . time() . '.' . $file->extension();
            $file->move($upload_path, $attachmentName);
            $question->attachment = "upload/qa/".$attachmentName;
        }

        $question->content = $request->content;
        if ($request->anonymous == 'true') {
            $question->anonymous = auth()->user()->login_id;
        }

        $question->user_id = auth()->user()->id;
        $question->creator_id = auth()->user()->id;
        $question->save();

        if ($request->tag_id != 'null') {
            $qatag = new QATagRelation();
            $qatag->tag_id = $request->tag_id;
            $qatag->question_id = $question->id;
            $qatag->creator_id = auth()->user()->id;
            $qatag->save();
        }

        $notiQuestion = Question::with('user')->with('answer')->with('answer.user')->with('tagRelation')->where('id', $question->id)->where('del_flag', '0')->first();
        $notiQuestion->score = QAFollow::where('follow_id', $question->id)->where('category', 1)->sum('score');
        broadcast(new QACreated([
            'question' => $notiQuestion,
            'user' => auth()->user(),
            'category' => 1
        ]))->toOthers();

        return response()->json([
            'success' => true,
            'msg' => [
                'desc' => 'question is successfully posted',
                'question' => $notiQuestion
            ]
        ], 200);
    }

    function postAnswer(Request $request) {
        $upload_path = public_path('upload/qa');
        $file = $request->file('attachment');
        $attachmentName = '';

        $answer = new Answer();

        if ($file) {
            $attachmentName = 'answer' . time() . '.' . $file->extension();
            $file->move($upload_path, $attachmentName);
            $answer->attachment = "upload/qa/".$attachmentName;
        }
        $answer->content = $request->content;
        $answer->question_id = $request->question_id;
        $answer->user_id = auth()->user()->id;
        $answer->creator_id = auth()->user()->id;
        $answer->save();

        $notiAnswer = Answer::with('user')->where('id', $answer->id)->where('del_flag', '0')->first();
        $notiAnswer->score = QAFollow::where('follow_id', $answer->id)->where('category', 2)->sum('score');
        broadcast(new QACreated([
            'answer' => $notiAnswer,
            'question' => Question::where('id', $request->question_id)->first(),
            'user' => auth()->user(),
            'category' => 2
        ]))->toOthers();

        return response()->json([
            'success' => true,
            'msg' => [
                'desc' => 'answer is successfully posted',
                'answer' => $notiAnswer,
            ]
        ], 200);
    }

    function follow(Request $request) {
        if (! $follow = QAFollow::where('follow_id', $request->follow_id)->where('user_id', auth()->user()->id)->where('category', $request->category)->first()) {
            $newFollow = new QAFollow();
            $newFollow->follow_id = $request->follow_id;
            $newFollow->user_id = auth()->user()->id;
            $newFollow->category = $request->category;
            $newFollow->creator_id = auth()->user()->id;
            if ($request->type > 0) {
                $newFollow->score = 10;
            } else {
                $newFollow->score = -10;
            }
            $newFollow->save();
            $score = QAFollow::where('follow_id', $newFollow->follow_id)->where('category', $newFollow->category)->sum('score');
            return response()->json([
                'success' => true,
                'msg' => [
                    'follow' => $newFollow,
                    'question_id' => $request->question_id,
                    'score' => $score,
                    'message' => 'New Following is successfully.'
                ]
            ], 200);
        } else {
            $follow->updater_id = auth()->user()->id;
            if ($request->type > 0) {
                if ($follow->score > 0) {
                    return response()->json([
                        'success' => false,
                        'msg' => [
                            'follow' => $follow,
                            'question_id' => $request->question_id,
                            'message' => 'すでにお勧めです。'
                        ]
                    ], 200);
                }
                $follow->score = 10;
            } else {
                if ($follow->score < 0) {
                    return response()->json([
                        'success' => false,
                        'msg' => [
                            'follow' => $follow,
                            'question_id' => $request->question_id,
                            'message' => 'すでに反対しています。'
                        ]
                    ], 200);
                }
                $follow->score = -10;
            }
            $follow->save();
            $score = QAFollow::where('follow_id', $follow->follow_id)->where('category', $follow->category)->sum('score');
            return response()->json([
                'success' => true,
                'msg' => [
                    'follow' => $follow,
                    'question_id' => $request->question_id,
                    'score' => $score,
                    'message' => 'Following is successfully.'
                ]
            ], 200);
        }
    }
}
