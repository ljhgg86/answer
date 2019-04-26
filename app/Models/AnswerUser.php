<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AnswerUser extends Model
{
    protected $table= 'answeruser';
	protected $primaryKey= 'id';
	protected $fillable = [
        'name',
        'delflag'
    ];
    public function answerrecord(){
        return $this->hasMany('App\Models\Answerrecord','answeruser_id','id');
    }
    public function reward(){
        return $this->hasMany('App\Models\Reward','answeruser_id','id');
    }
    public function lottery($pollid,$rewardCounts){
        $lotteries=$this->withCount(['answerrecord'=>function($query) use($pollid){
                            $query->where('poll_id' , $pollid)
                                ->where('delflag',0)
                                ->whereHas('option',function($query){
                                    $query->where('delflag',0)
                                        ->where('rightflag',1);
                                });
                        }])
                        ->orderBy('answerrecord_count','desc')
                        ->orderBy(DB::raw('RAND()'))
                        ->take($rewardCounts)
                        ->get();
        //return json_encode($lotteries);
        return $lotteries;
    }
    public function getAllRight($pollid){
        $users=$this->withCount(['answerrecord'=>function($query) use($pollid){
                            $query->where('poll_id' , $pollid)
                                ->where('delflag',0)
                                ->where('option',function($query){
                                    $query->where('delflag',0)
                                        ->where('rightflag',1);
                                });
                        }])
                        ->orderBy('answerrecord_count','desc')
                        ->orderBy(DB::raw('RAND()'))
                        ->take(20)
                        ->get();
        return $users;
    }
}
