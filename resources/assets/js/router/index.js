import Vue from 'vue'
import Router from 'vue-router'
import voterow from '@/components/voteRow'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/voterow',
      name: 'voterow',
      component: voterow
    },
    // {
    //   path: '/startanswer',
    //   name: 'basesrc',
    //   component: basesrc
    // }
  ]
})
