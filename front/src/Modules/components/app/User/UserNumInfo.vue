<template>
  <section id="user-num-info">
    <b-row>
      <b-col lg="2" sm="4">
        <b-card no-body>
          <b-card-body class="d-flex align-items-center justify-content-between">
            <div>
              <h3 class="fw-bolder mb-75">
                {{userList.length}}
              </h3>
              <span>
                {{'総従業員数'}}
              </span>
            </div>
            <b-avatar variant="light-primary" size="lg">
              <feather-icon icon="UserIcon" size="20"></feather-icon>
            </b-avatar>
          </b-card-body>
        </b-card>
      </b-col>
      <b-col lg="2" sm="4" v-for="department in common_states.departments" :key="department.id">
        <b-card no-body>
          <b-card-body class="d-flex align-items-center justify-content-between">
            <div>
              <h3 class="fw-bolder mb-75">
                {{userList.filter(item => item.department_id == department.id).length}}
              </h3>
              <span>
                {{department.department_name}}
              </span>
            </div>
            <b-avatar variant="light-primary" size="lg">
              <feather-icon icon="UserIcon" size="20"></feather-icon>
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
import { mapGetters } from 'vuex'

export default defineComponent({
  components: {
    BRow,
    BCol,
    BCardBody,
    BCard,
    BAvatar
  },
  computed: {
    ...mapGetters({
      userList: 'auth/userList',
      common_states: 'common/common_states',
    })
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
