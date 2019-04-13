<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Options extends Model
{
    protected $table= 'options';
	protected $primaryKey= 'id';
	protected $fillable = [
        'info'
    ];
    public function votes(){
    	return $this->belongsTo('App\Models\Votes','vote_id');
    }
    public function answerrecord(){
    	return $this->hasMany('App\Models\Answerrecord','option_id','id');
    }
    public function delVoteOptions($voteid){
        return $this->where('vote_id',$voteid)
                    ->update(['delflag'=>1]);
    }
    public function addVoteOptions($voteid,$options){
        $tempOptions = array();
        foreach($options as $option){
            $tempOptions[] = array('vote_id'=>$voteid,
                                'info'=>$option['info'],
                                'rightflag'=>$option['rightflag'],
                                'delflag'=>$option['delflag']);
        }
        return DB::table($this->getTable())
                        ->insert($tempOptions);
    }
}
