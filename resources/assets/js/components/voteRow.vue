<template>
    <div id="voterow">
        <el-row>
            <el-col :span="4" :offset="4">投票题目</el-col>
            <el-col :span="12">
                <el-input v-model="vote.title" placeholder="请输入投票题目"></el-input>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="4" :offset="4">开始时间</el-col>
            <el-col :span="12">
                <el-input v-model="vote.start_at"></el-input>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="4" :offset="4">停留时间</el-col>
            <el-col :span="12">
                <el-input v-model="vote.staytime"></el-input>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="12" :offset="6">
                <el-button type="primary" icon="el-icon-plus" @click="addOption">
                    添加选项
                </el-button>
            </el-col>
        </el-row>
        <div v-for="(option,index) in vote.options">
            <el-row>
                <el-col :span="2" :offset="6">选项{{ index+1 }}</el-col>
                <el-col :span="10">
                    <el-input v-model="option.info"></el-input>
                </el-col>
                <el-col :span="3" justify="center" align="middle" style="height:40px;">
                    <!-- <el-radio v-model="rightOption" :label="index" @change="cc(index)" border>正确
                    </el-radio> -->
                    <span class="my-radio">
                        <input 
                        type="radio" 
                        name="radios" 
                        :id="index" 
                        v-model="rightOption" 
                        :value="index">
                        <label :for="index">
                            正确
                        </label>
                    </span>
                </el-col>
                <el-col :span="2">
                    <el-button
                        type="danger"
                        plain
                        size="small"
                        icon="el-icon-minus"
                        circle
                        @click="delOption(index)">
                    </el-button>
                </el-col>
            </el-row>
        </div>
        <el-row>
            <el-col :span="4" :offset="4">描述</el-col>
            <el-col :span="12">
                <el-input type="textarea" v-model="vote.description"></el-input>
            </el-col>
        </el-row>
        <el-row type="flex" justify="center">
            <el-button type="primary" @click="onSumit">确定</el-button>
        </el-row>
    </div>
</template>

<script>
// import optionrow from './optionRow.vue'
    export default {
        name: 'voteRow',
        // components: { optionrow},
        props:{
            pollid:{
                type:Number,
                default:0,
            },
            voteid:{
                type:Number,
                default:0,
            },
        },
        data:function(){
            return {
                vote:{
                    id:0,
                    pollid:this.pollid,
                    title:'',
                    description:'',
                    delflag:0,
                    start_at:0,
                    staytime:6,
                    options:[],
                },
                rightOption:0,
                oldIndex:0
            }
        },
        // computed:{
        //     vote:function(){
        //         return this.$store.state.vote;
        //     },
        // },
        created:function(){
            if(this.voteid){
                this.getVote();
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            getVote:function(){
                axios.get("/admin/votes/getvote/"+this.voteid)
                  .then(function (data) {
                    var data=data.data;
                    var voteinfo=data.data;
                    this.vote={
                        id:voteinfo.id,
                        poll_id:voteinfo.poll_id,
                        title:voteinfo.title,
                        description:voteinfo.description,
                        delflag:voteinfo.delflag,
                        start_at:voteinfo.start_at,
                        staytime:voteinfo.staytime,
                        options:voteinfo.options,
                      };
                      this.rightOption = this.setRightOption(voteinfo.options);
                  }.bind(this))
                  .catch(function (error) {console.log("error");
                  //console.log(error.response.data.message);
                    // this.$message({
                    //   message: error.response.data.message,
                    //   type: 'warning'
                    // });
                  }.bind(this));
            },
            setRightOption:function(options){
                for(let i in options){
                    if(options[i].rightflag){
                        this.oldIndex = i;
                        return i;
                    }
                }
            },
            addOption:function(){
                this.vote.options.push({
                    id:0,
                    vote_id:this.vote.id,
                    info:'',
                    rightflag:0,
                    delflag:0
                    });
            },
            delOption:function(index){
                if(index == this.oldIndex){
                    this.oldIndex=0;
                }
                if(index == this.rightOption){
                    this.rightOption = 0;
                }
                this.vote.options.splice(index,1);
            },
            onSumit:function(){
                let that = this;
                let oldRight = this.oldIndex;
                let newRight = this.rightOption;
                if(this.vote.options.length>0){
                    this.vote.options[oldRight].rightflag=0;
                    this.vote.options[newRight].rightflag=1;
                }
                if(this.vote.id==0){
                    axios.post('/admin/votes', {pollid:this.pollid,vote:this.vote})
                    .then(function(response){
                        that.$message({
                            message:response.data['message'],
                            type:'success'
                            });
                    });
                }
                else{
                    axios.put('/admin/votes/'+this.vote.id, {pollid:this.pollid,vote:this.vote})
                    .then(function(response){
                        that.$message({
                            message:response.data['message'],
                            type:'success'
                            });
                    });
                }
            },
            cc:function(index){
            }
        }
    }
</script>
<style>
    #voterow{
        /*border-bottom: solid #909399;*/
    }
    .el-row {
        margin-top: 10px;
        margin-bottom: 10px;
    /*&:last-child {
      border-bottom: solid #606266;
    }*/
     }
     .my-radio{
        margin:auto;
        padding: 5px 10px; 
        height: 40px;
        color:#777;
     }
</style>
