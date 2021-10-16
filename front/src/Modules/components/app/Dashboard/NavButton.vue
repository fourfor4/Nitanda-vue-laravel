<template>
  <b-button
    :navButton = navButton
    v-ripple.400="'rgba(255, 255, 255, 0.15)'"
    :variant="params.label === navButton.route.params.label ? `primary` : `flat-primary`"
    :to="navButton.route"
  >
  <div class="d-flex align-items-center">
    <feather-icon
      :icon="navButton.icon"
      class="mr-50"
      size="18"
    />
    <span>
      {{navButton.title}}
    </span>
  </div>
  </b-button>
</template>

<script>
import { defineComponent } from '@vue/composition-api'
import { BButton } from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'

export default defineComponent({
  props: ['navButton'],
  components: {
    BButton
  },
  directives: {
    Ripple
  },
  computed: {
    params : function() {
      return this.$route.params
    }
  }
})
</script>
