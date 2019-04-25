<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    protected $table= 'votes';
	protected $primaryKey= 'id';
	protected $fillable = [
        'title',
        'description',
        'start_at',
        'staytime'
    ];

    public function polls(){
    	return $this->belongsTo('App\Models\Polls','poll_id');
    }
    public function options(){
    	return $this->hasMany('App\Models\Options','vote_id','id');
    }
    public function answerrecord(){
        return $this->hasMany('App\Models\Answerrecord','votes_id','id');
    }
    public function getVotes($pollid){
        return $this->where('poll_id',$pollid)
                    ->where('delflag',0)
                    ->get();
    }
}
