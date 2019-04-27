<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Answerrecord;
use App\Models\Votes;
use App\Models\Options;
use App\Models\AnswerUser;
use App\Models\Polls;
use App\Models\Reward;

class AnswerrecordController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->answerRecord = new Answerrecord();
        $this->answerUser = new AnswerUser();
        $this->poll = new Polls();
        $this->reward = new Reward();
        $this->vote = new Votes();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answerrecords=Answerrecord::where('delflag',0)
                                    ->with(['answerUser'=>function($query){
                                        $query->where('delflag',0);
                                    },
                                    'poll'=>function($query){
                                        $query->where('delflag',0);
                                    },
                                    'votes'=>function($query){
                                        $query->where('delflag',0);
                                    },
                                    'option'=>function($query){
                                        $query->where('delflag',0);
                                    }])
                                    ->orderBy('id','desc')
                                    ->paginate(15);
        return view('admin.answerrecords.index')->withAnswerrecords($answerrecords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //var_dump($request->input('params.answertime'));
        $answeruser=AnswerUser::firstOrCreate(['name' => $request->input('params.telphone')]);
        $answerrecord=new Answerrecord;
        $answerrecord->au_id=$request->input('params.au_id');
        $answerrecord->poll_id=$request->input('params.poll_id');
        $answerrecord->votes_id=$request->input('params.votes_id');
        //$answerrecord->answertime=$request->input('params.answertime');
        date_default_timezone_set("Asia/Shanghai");
        $answerrecord->answertime=date("Y-m-d H:i:s");
        $answerrecord->option_id=$request->input('params.option_id');
        $answerrecord->telphone=$request->input('params.telphone');
        $answerrecord->answeruser_id=$answeruser->id;
        $answerrecord->save();
        return response()->json([
            'status' => true,
            'data'=>[
                'successflag' => true
            ],
            'message' => '成功',
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hasVoted(Request $request)
    {
        $telphone=$request->input('params.telphone');
        //$voteid=$request->input('params.voteid');
        $pollid=$request->input('params.pollid');
        $answerrecord=Answerrecord::where('delflag',0)
                                    ->where('poll_id',$pollid)
                                    ->where('telphone',$telphone)
                                    ->get();

        // $answerrecord=Answerrecord::where('delflag',0)
        //                             ->where('telphone',$telphone)
        //                             ->whereHas('votes.polls',function($query) use ($pollid){
        //                                 $query->where('id',intval($pollid));
        //                             })
        //                             ->get();
                                    
        //return $answerrecord;                            
        if($answerrecord->count()==0){
            return response()->json([
                'status' => true,
                'data'=>[],
                'message' => '成功',
            ])->setStatusCode(200);
        }
        else{
            return response()->json([
                'status' => false,
                'data'=>[],
                'message' => '您已经参加了活动！',
            ])->setStatusCode(400);
        }
    }

    //lottery
    public function lottery(Request $request){
        $pollid=$request->input('pollid');
        $rewardCounts=$request->input('rewardCounts');
        //$lotteryRst=$this->answerRecord->lottery($pollid,$rewardCounts);
        $lotteryRst=$this->answerUser->lottery($pollid,$rewardCounts);
        if($lotteryRst){
            $updateRewardRst = $this->poll->updateRewarded($pollid);
            $insAnswerRecord = $this->reward->insRewardRecord($pollid,$lotteryRst);
            return response()->json([
                'status' => true,
                'data'=>$lotteryRst,
                'message' => '成功'
            ])->setStatusCode(200);
        }
    }

    //获取全部答对用户
    public function getAllRightUsers(Request $request){
        $pollid=$request->input('params.pollid');
        $votes=$this->vote->getVotes($pollid);
        //$allRightUsers=$this->answerUser->getAllRight($pollid);
        $num=intval(config('answer.showRightCounts'));
        $allRightUsers=$this->answerUser->lottery($pollid,$num);
        if($allRightUsers){
            return response()->json([
                'status' => "success",
                'data' => $allRightUsers,
                'votescount' => count($votes),
            ])->setStatusCode(200);
        }
        else{
            return response()->json([
                'status' => "fail",
                'data' => ""
            ])->setStatusCode(400);
        }
    }
}
