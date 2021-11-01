<template>
  <b-nav-item-dropdown
    right
    toggle-class="d-flex align-items-center dropdown-user-link"
    class="dropdown-user"
  >
    <template #button-content>
      <div class="d-sm-flex d-none user-nav ml-2">
        <p class="user-name font-weight-bolder mb-0">
          {{current_user ? current_user.employee_name : ''}}
        </p>
        <span class="user-status">
          {{current_user && common_states.roles.filter(item => item.id == current_user.role_id).length > 0 ?  common_states.roles.filter(item => item.id == current_user.role_id)[0].role_name : ''}}
        </span>
      </div>


      <b-avatar
        v-if="current_user && current_user.avatar_url"
        size="40"
        variant="light-primary"
        badge
        class="badge-minimal"
        badge-variant="success"
        :src="appConfig.serverUrl + current_user.avatar_url"
      >
      </b-avatar>
      <b-avatar
        v-if="current_user && !current_user.avatar_url"
        size="40"
        variant="light-primary"
        badge
        class="badge-minimal"
        badge-variant="success"
      >
        <feather-icon
          icon="UserIcon"
          size="22"
        />
      </b-avatar>
    </template>

    <b-dropdown-item
      link-class="d-flex align-items-center"
    >
      <feather-icon
        size="16"
        icon="UserIcon"
        class="mr-50"
      />
      <span>プロフィール</span>
    </b-dropdown-item>
    <b-dropdown-item
      link-class="d-flex align-items-center"
    >
      <feather-icon
        size="16"
        icon="SettingsIcon"
        class="mr-50"
      />
      <span>設定</span>
    </b-dropdown-item>
    <b-dropdown-item
      link-class="d-flex align-items-center"
      @click="logout"
    >
      <feather-icon
        size="16"
        icon="LogOutIcon"
        class="mr-50"
      />
      <span>ログアウト</span>
    </b-dropdown-item></b-nav-item-dropdown>
</template>

<script>
import {
  BNavItemDropdown, BDropdownItem, BDropdownDivider, BAvatar,
} from 'bootstrap-vue'
import { mapGetters } from 'vuex'
import appConfig from '@/appConfig'

export default {
  components: {
    BNavItemDropdown,
    BDropdownItem,
    BDropdownDivider,
    BAvatar,
  },
  data() {
    return {
      appConfig: appConfig
    }
  },
  computed: {
    ...mapGetters({
      current_user: 'auth/current_user',
      common_states: 'common/common_states'
    })
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout')
    },
  },
  mounted() {
    this.$store.dispatch('auth/retrieveUser')
    this.$store.dispatch('common/retrieveDepartments')
    this.$store.dispatch('common/retrieveRoles')
    this.$store.dispatch('common/retrieveTags')
  }
}
</script>
