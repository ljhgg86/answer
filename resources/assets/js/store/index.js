import Vue from 'vue'
import Vuex from 'vuex'
import 'babel-polyfill'

Vue.use(Vuex)

const state = {
	votes:[],
	vote:{},
	answerShow: false,
	videoShow:true,
	countdown:0,
	videoSrc:'',
	videoPoster:'',
	voteInfos:[],
	voteInfo:{},
	votedFlag:false,
};

const getters = {
};

const mutations = {
	//shwo answer page
	setVotes(state,data){
		state.votes=data;
	},
	//shwo answer page
	setVote(state,data){
		state.vote=data;
	},
	//shwo answer page
	setAnswerShow(state,data){
		state.answerShow=data;
	},
	//show video
	setVideoShow(state,data){
		state.videoShow=data;
	},
	//count down
	setCountdown(state,data){
		state.countdown=data;
	},
	//video source
	setVideoSrc(state,data){
		state.videoSrc=data;
	},
	//video poster
	setVideoPoster(state,data){
		state.videoPoster=data;
	},
	//vote infos
	setVoteInfos(state,data){
		state.voteInfos=data;
	},
	//now vote info
	setVoteInfo(state,data){
		state.voteInfo=data;
	},
	//has voted
	setVotedFlag(state,data){
		state.votedFlag=data;
	},
};

const actions = {
};

export default new Vuex.Store({
  state,
  getters,
  mutations,
  actions,
})