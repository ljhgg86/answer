<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answerrecord extends Model
{
    protected $table= 'answerrecord';
	protected $primaryKey= 'id';
	protected $fillable = [
        'au_id',
        'answeruser_id',
        'telphone',
        'poll_id',
        'votes_id',
        'option_id',
        'answertime'
    ];
    public function votes(){
    	return $this->belongsTo('App\Models\Votes','votes_id');
    }
    public function option(){
    	return $this->belongsTo('App\Models\Options','option_id');
    }
    public function answerUser(){
        return $this->belongsTo('App\Models\AnswerUser','answeruser_id');
    }
}
