<template>
    <div id="lotteryform">
        <el-row v-if='rewardflag' :gutter="20" type="flex" justify="center" align="middle">
            <el-col :span="3">中奖数量</el-col>
            <el-col :span="7">
                <el-input-number 
                v-model="rewardCounts" 
                @change="handleChange"
                :min="1" 
                :max="1000" 
                label="中奖人数">
                </el-input-number>
            </el-col>
            <el-col :span="4">
                <el-button 
                type="primary" 
                icon="el-icon-check" 
                plain 
                :disabled="checkStatus"
                @click="onSumit">
                    抽奖
                </el-button>
            </el-col>
        </el-row>
        <el-table v-else
          :data="rewards"
          style="width: 100%">
          <el-table-column label="中奖名单" align="center">
              <el-table-column
               type="index"
               label="序号"
               align="center"
               width="80">
              </el-table-column>
              <el-table-column
                prop="answer_user.name"
                label="用户名"
                align="center"
                width="200">
              </el-table-column>
              <el-table-column
                prop="rightcounts"
                label="答对数"
                align="center"
                width="80">
              </el-table-column>
          </el-table-column>
        </el-table>
    </div>
</template>

<script>
    export default {
        name: 'lotteryForm',
        props:{
            pollid:{
                type:Number,
                default:0,
            },
            rewarded:0
        },
        data:function(){
            return {
                rewardCounts:{
                    type:Number,
                    default:0
                },
                flagtemp:0,
                rewards:[]
            }
        },
        computed:{
            checkStatus:function(){
                return this.rewardCounts>=1 ? false : true;
            },
            rewardflag:function(){
                return !(this.rewarded || this.flagtemp);
            }
        },
        created:function(){
            if(!this.rewardflag){
                this.getRewards();
            }
        },
        mounted() {
            
        },
        methods:{
            handleChange:function(value){
                //console.log(value);
            },
            getRewards:function(){
                let that=this;
                axios.get('../../polls/getRewards/'+this.pollid)
                .then(function(response){
                    that.rewards=response.data.data;
                });
            },
            onSumit:function(){
                let that = this;
                axios.post('../../answerrecord/lottery',{pollid:this.pollid,rewardCounts:this.rewardCounts})
                .then(function(response){
                    console.log(response.data);
                    // if(!response.data.status){
                    //     return;
                    // }
                    that.flagtemp=1;
                    let data=response.data.data;
                    for(let i in data){
                        let reward = new Object;
                        reward.answer_user = new Object;
                        reward.answer_user.name=data[i].name;
                        reward.rightcounts=data[i].answerrecord_count;
                        that.rewards.push(reward);
                    }
                });
            },
        }
    }
</script>
<style>
    #lotteryform{
        /*border-bottom: solid #909399;*/
    }
    .el-row {
        margin-top: 10px;
        margin-bottom: 10px;
    /*&:last-child {
      border-bottom: solid #606266;
    }*/
  }
</style>
