<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Polls extends Model
{
    protected $table= 'polls';
	protected $primaryKey= 'id';
	protected $fillable = [
        'title',
        'description',
        'videosrc',
        'videoposter',
        'rewardflag',
        'rewarded',
        'starttime',
        'endtime'
    ];

    public function votes(){
    	return $this->hasMany('App\Models\Votes','poll_id','id');
    }
    public function answerrecords(){
        return $this->hasMany('App\Models\Answerrecord','poll_id','id');
    }
    public function reward(){
        return $this->hasMany('App\Models\Reward','poll_id','id');
    }
    public function updateRewarded($pollid){
        return $this->where('id',$pollid)
                    ->update(['rewarded'=>1]);
    }
}
