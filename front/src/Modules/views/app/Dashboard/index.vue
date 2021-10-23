<template>
  <section id="dashboard">
    <b-row>
      <b-col xl="4" lg="5" md="5">
        <own-info></own-info>
        <own-score></own-score>
      </b-col>
      <b-col xl="8" lg="7" md="7">
        <div class="mb-2">
          <nav-button
            v-for="navButton in navButtons"
            :key="navButton.title + $route.path"
            :navButton="navButton"
          />
        </div>
        <main-info v-if="params === ''"></main-info>
        <ranking-info v-if="params === 'ranking'"></ranking-info>
      </b-col>
    </b-row>
  </section>
</template>
<script>
import { defineComponent } from '@vue/composition-api'

import {
  BRow,
  BCol,
  BButton,
  BTab,
  BTabs
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import NavButton from '@/Modules/components/app/Dashboard/NavButton.vue'
import OwnInfo from '@/Modules/components/app/Dashboard/OwnInfo.vue'
import OwnScore from '@/Modules/components/app/Dashboard/OwnScore.vue'
import RankingInfo from '@/Modules/components/app/Dashboard/RankingInfo.vue'
import MainInfo from '@/Modules/components/app/Dashboard/MainInfo.vue'
import { mapGetters } from 'vuex'
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default defineComponent({
  components: {
    BRow,
    BCol,
    BButton,
    BTabs,
    BTab,

    //Custom
    NavButton,
    OwnInfo,
    OwnScore,
    RankingInfo,
    MainInfo
  },
  directives: {
    Ripple
  },
  computed: {
    //Get params of url
    params : function() {
      return this.$route.params.label ? this.$route.params.label : ""
    },
    ...mapGetters({
      userData: 'auth/current_user'
    }),
  },
  setup() {
    const navButtons = [
      { title: '基本情報', icon: 'UserIcon', route: { name: 'dashboard', params: {}} },
      { title: '投稿', icon: 'LockIcon', route: { name: 'dashboard-label', params: { label: 'post' } } },
      { title: '回答待ち', icon: 'BookmarkIcon', route: { name: 'dashboard-label', params: { label: 'bookmark' } } },
      { title: 'ランキング', icon: 'BellIcon', route: { name: 'dashboard-label', params: { label: 'ranking' } } },
      { title: 'チームタスク', icon: 'LinkIcon', route: { name: 'dashboard-label', params: { label: 'teamtask' } } },
    ]
    const userInfo = {}
    return {
      navButtons,
      userInfo
    }
  },
  mounted() {
    // this.$toast({
    //   component: ToastificationContent,
    //   props: {
    //     title: `Welcome `,
    //     icon: 'CoffeeIcon',
    //     variant: 'success',
    //     text: `You have successfully logged in as . Now you can start to explore!`,
    //   },
    // })
  }
})
</script>