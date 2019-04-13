<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Reward extends Model
{
	protected $table= 'reward';
	protected $primaryKey= 'id';
	protected $fillable = [
        'poll_id',
        'answeruser_id',
        'delflag',
        'rightcounts'
    ];
    public function answerUser(){
    	return $this->belongsTo('App\Models\AnswerUser','answeruser_id');
    }
    public function poll(){
    	return $this->belongsTo('App\Models\Polls','poll_id');
    }
    //get reward with the selected poll
    public function getRewardPoll($pollid){
    	return $this->where('poll_id',$pollid)
    				->where('delflag',0)
    				->with(['answerUser'=>function($query){
    					$query->where('delflag',0);
    				}])
    				->orderBy('rightcounts','desc')
    				->get();
    }
    //insert抽奖record
    
    public function insRewardRecord($pollid,$lotteries){
        $answerRecords=array();
        $lotteries = json_decode($lotteries,true);
        foreach($lotteries as $lottery){
            $answerRecords[]=array('poll_id'=>$pollid,
                            'answeruser_id'=>$lottery['id'],
                            'rightcounts'=>$lottery['answerrecord_count']);
        }
        $insRst = DB::table($this->getTable())
                        ->insert($answerRecords);
    }
}
