<template>
  <section id="user">
    <user-num-info class="mb-1"></user-num-info>
    <user-list-table></user-list-table>
  </section>
</template>
<script>
import { defineComponent } from '@vue/composition-api'
import UserNumInfo from '@/Modules/components/app/User/UserNumInfo.vue'
import UserListTable from '@/Modules/components/app/User/UserListTable.vue'

export default defineComponent({
  components: {
    //user define
    UserNumInfo,
    UserListTable
  },
  setup() {
    
  },
})
</script>
