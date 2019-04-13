<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Polls;
use App\Models\Votes;
use App\Models\Options;

class VotesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
        //$this->middleware('auth');
        $this->options = new Options();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vote=new votes();
        return view('admin.votes.create')->withVote($vote);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //var_dump($request->all());
        $vote = new Votes();
        $newVote = $request->input('vote');
        $vote->poll_id = $request->input('pollid');
        $vote->title=$newVote['title'];
        $vote->description=$newVote['description'];
        $vote->start_at=$newVote['start_at'];
        $vote->staytime=$newVote['staytime'];
        $rst=$vote->save();
        $this->options->addVoteOptions($vote->id,$newVote['options']);
        return response()->json([
                 'status' => true,
                 'data'=>'',
                 'message' => '保存成功',
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $vote=Votes::where('id',$id)
        //         ->first();
        // return view('admin.votes.edit')->with('vote',$vote);
        //return view('admin.votes.edit')->withVoteid($id);
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
        //var_dump($request->all());
        $vote = Votes::findOrFail($id);
        $newVote = $request->input('vote');
        $pollid = $request->input('pollid');
        $vote->title=$newVote['title'];
        $vote->description=$newVote['description'];
        $vote->start_at=$newVote['start_at'];
        $vote->staytime=$newVote['staytime'];
        $vote->save();
        $this->options->delVoteOptions($id);
        $this->options->addVoteOptions($id,$newVote['options']);
        return response()->json([
                 'status' => true,
                 'data'=>'',
                 'message' => '更新成功',
             ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function destroyvote($pollid,$id)
    {
        $vote = Votes::findOrFail($id);
        $vote->delflag=1;
        $vote->save();
        return redirect('/admin/votes/listvotes/'.$pollid)
                        ->withSuccess("'$vote->title' 删除成功.");
    }

    //list votes
    public function listvotes($pollid)
    {
        $votes=Votes::where('poll_id',$pollid)
                    ->where('delflag',0)
                    ->get();
        return view('admin.votes.listvotes')->with('votes',$votes)->withPollid($pollid);
    }
    //get vote
    public function getvote($id)
    {
        $vote=Votes::with(['options'=>function($query){
                            $query->where('delflag',0);
                        }])
                ->where('id',$id)
                ->first();
        return response()->json([
                 'status' => true,
                 'data'=>$vote,
                 'message' => '成功',
             ])->setStatusCode(200);
    }
    //edit votes
    public function editvotes($id,$pollid)
    {
        return view('admin.votes.editvotes')->withVoteid($id)->withPollid($pollid);
    }
}
