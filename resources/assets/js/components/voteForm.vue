<template>
    <div id="voteform">
        <el-table
            :data="votes"
            stripe
            style="width: 100%">
            <el-table-column
              type="index"
              label="序号">
            </el-table-column>
            <el-table-column
              prop="title"
              label="标题"
              width="180">
            </el-table-column>
            <el-table-column
              label="操作">
              <template slot-scope="scope">
                <el-button
                  size="mini"
                  @click="route('admin.votes.edit',scope.$index)">编辑</el-button>
                <el-button
                  size="mini"
                  type="danger"
                  @click="handleDelete(scope.$index, scope.row)">删除</el-button>
              </template>
            </el-table-column>
        </el-table>
        <!-- <div v-for="(vote,index) in votes">
            <voterow
            :rowid="index">
            </voterow>
        </div> -->
    </div>
</template>

<script>
import voterow from './voteRow.vue'
    export default {
        name: 'voteForm',
        components: { voterow},
        props:{
            pollid:{
                type:Number,
                default:0,
            },
        },
        data:function(){
            return {
                csrfToken:document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                //votes:[],
            }
        },
        computed:{
            votes:function(){
                return this.$store.state.votes;
            },
        },
        created:function(){
            this.getVotes();
        },
        mounted() {
            console.log(this.pollid);
        },
        methods:{
            getVotes:function(){
                axios.get("/admin/votes/listvotes/"+this.pollid)
                  .then(function (data) {
                    var data=data.data;
                    var voteinfos=data.data;
                    var temparr=[];
                    for(var i in voteinfos){
                      temparr.push({
                        id:voteinfos[i].id,
                        title:voteinfos[i].title,
                        description:voteinfos[i].description,
                        delflag:voteinfos[i].delflag,
                        start_at:voteinfos[i].start_at,
                        staytime:voteinfos[i].staytime,
                        options:(voteinfos[i].options),
                      });
                    }
                    this.$store.commit('setVotes',temparr);
                  }.bind(this))
                  .catch(function (error) {console.log("error");
                  //console.log(error.response.data.message);
                    // this.$message({
                    //   message: error.response.data.message,
                    //   type: 'warning'
                    // });
                  }.bind(this));
            },
            handleEdit(index, row) {
                console.log(index, row);
            },
            handleDelete(index, row) {
                console.log(index, row);
            },
        },
    }
</script>
<style>
    el-form{
        width:100%;
    }
</style>
