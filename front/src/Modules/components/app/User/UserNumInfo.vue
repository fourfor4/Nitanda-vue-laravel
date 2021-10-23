<template>
  <section id="user-num-info">
    <b-row>
      <b-col lg="2" sm="4" v-for="userNum in userNumInfo" :key="userNum.desc">
        <b-card no-body>
          <b-card-body class="d-flex align-items-center justify-content-between">
            <div>
              <h3 class="fw-bolder mb-75">
                {{userNum.num}}
              </h3>
              <span>
                {{userNum.desc}}
              </span>
            </div>
            <b-avatar :variant="userNum.color" size="lg">
              <feather-icon :icon="userNum.icon" size="20"></feather-icon>
            </b-avatar>
          </b-card-body>
        </b-card>
      </b-col>
    </b-row>
  </section>
</template>
<script>
import { defineComponent } from '@vue/composition-api'
import {
  BRow,
  BCol,
  BCardBody,
  BCard,
  BAvatar
} from 'bootstrap-vue'

export default defineComponent({
  components: {
    BRow,
    BCol,
    BCardBody,
    BCard,
    BAvatar
  },
  setup() {
    const userNumInfo = [
      {
        num: 55,
        desc: '社員数',
        icon: 'UserIcon',
        color: 'light-primary'
      },
      {
        num: 5,
        desc: '企画開発',
        icon: 'UserPlusIcon',
        color: 'light-danger'
      },
      {
        num: 6,
        desc: '営業部',
        icon: 'UserCheckIcon',
        color: 'light-success'
      },
      {
        num: 6,
        desc: '管理部',
        icon: 'UserXIcon',
        color: 'light-warning'
      },
      {
        num: 25,
        desc: '医療システム部',
        icon: 'UserXIcon',
        color: 'light-warning'
      },
      {
        num: 3,
        desc: 'システム管理',
        icon: 'UserXIcon',
        color: 'light-warning'
      },
    ]
    return {
      userNumInfo
    }
  },
})
</script>
