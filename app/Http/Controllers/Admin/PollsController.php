<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Polls;
use App\Models\Votes;
use App\Models\Options;
use App\Models\Reward;

class PollsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->reward = new Reward();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls=Polls::where('delflag',0)
                    ->paginate(15);
        //var_dump($polls->currentPage());
        return view('admin.polls.index')->withPolls($polls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poll=new Polls();
        return view('admin.polls.create')->withPoll($poll);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poll=Polls::create([
            'title'=>$request->input('title'), 
            'description'=>$request->input('description'),
            'videosrc'=>$request->input('videosrc'),
            'videoposter'=>$request->input('videoposter'), 
            'starttime'=>$request->input('starttime'),
            'endtime'=>$request->input('endtime'),
            'rewardflag'=>$request->input('rewardflag')
        ]);
        return redirect('/admin/polls')
                        ->withSuccess("'$poll->title' 新建成功.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pollinfo=Polls::with(['votes.options'=>function($query){
                            $query->where('delflag',0);
                        }])
                    ->where('id',$id)
                    ->where('delflag',0)
                    ->firstOrFail();
        date_default_timezone_set("Asia/Shanghai");
        $srvtime=date("Y-m-d H:i:s");
        if($srvtime>$pollinfo->endtime){
            return response()->json([
                'status' => false,
                'data'=>$pollinfo,
                'message' => '该活动已结束！',
            ])->setStatusCode(200);
        }
        else if($srvtime<$pollinfo->starttime){
            return response()->json([
                'status' => false,
                'data'=>[],
                'message' => '该活动未开始！',
            ])->setStatusCode(400);
        }
        else{
            return response()->json([
                'status' => true,
                'data'=>$pollinfo,
                'message' => '成功',
            ])->setStatusCode(200);
        }
        //return json_encode($pollinfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poll=Polls::where('id',$id)
                ->first();
        $poll->starttime=date('Y-m-d',strtotime($poll->starttime))."T".date('H:i:s',strtotime($poll->starttime));
        $poll->endtime=date('Y-m-d',strtotime($poll->endtime))."T".date('H:i:s',strtotime($poll->endtime));
        return view('admin.polls.edit')->with('poll',$poll);
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
        $poll = Polls::findOrFail($id);
        $poll->title=$request->input('title');
        $poll->description=$request->input('description');
        $poll->videosrc=$request->input('videosrc');
        $poll->videoposter=$request->input('videoposter');
        $poll->starttime=$request->input('starttime');
        $poll->endtime=$request->input('endtime');
        $poll->rewardflag=$request->input('rewardflag');
        $poll->save();
        return redirect("/admin/polls/$id/edit")
                        ->withSuccess("'$poll->title' 更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poll = Polls::findOrFail($id);
        $poll->delflag=1;
        $poll->save();
        return redirect('/admin/polls')
                        ->withSuccess("'$poll->title' 删除成功.");
    }
    //list votes
    public function listvotes($pollid)
    {
        return view('admin.polls.listvotes')->withPollid($pollid);
    }

    public function getPolls($id)
    {
        $pollinfo=Polls::with(['votes.options'=>function($query){
                            $query->where('delflag',0);
                        }])
                    ->where('id',$id)
                    ->where('delflag',0)
                    ->firstOrFail();
        date_default_timezone_set("Asia/Shanghai");
        $srvtime=date("Y-m-d H:i:s");
        if($srvtime>$pollinfo->endtime){
            return response()->json([
                'status' => false,
                'data'=>$pollinfo,
                'message' => '该活动已结束！',
            ])->setStatusCode(200);
        }
        else if($srvtime<$pollinfo->starttime){
            return response()->json([
                'status' => false,
                'data'=>[],
                'message' => '该活动未开始！',
            ])->setStatusCode(400);
        }
        else{
            return response()->json([
                'status' => true,
                'data'=>$pollinfo,
                'message' => '成功',
            ])->setStatusCode(200);
        }
    }

    //获取POLL信息进入抽奖设置页面
    public function reward($pollid){
        $poll=Polls::where('id',$pollid)
                ->first();
        if($poll->rewardflag){
            return view('admin.polls.lottery')->with('poll',$poll);
        }
        //return redirect(url()->current())->with('lotteryWarn',"该活动未设置抽奖.");
    }
    //getrewards
    public function getRewards($pollid){
        $rewards=$this->reward->getRewardPoll($pollid);
       // $rewards=json_encode($rewards);
        return response()->json([
                'status' => true,
                'data'=>$rewards,
                'message' => '成功',
            ])->setStatusCode(200);
    }
}
