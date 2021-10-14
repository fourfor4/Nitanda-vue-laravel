<template>
  <component
    :is="tag"
    v-on="$listeners"
  >
    <div class="chat-info flex-grow-1">
      <h5 class="mb-0">
        {{ department.name }}
      </h5>
    </div>
  </component>
</template>

<script>
import { BAvatar, BBadge } from 'bootstrap-vue'
import { formatDateToMonthShort } from '@core/utils/filter'

export default {
  components: {
    BAvatar,
    BBadge,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    department: {
      type: Object,
      required: true,
    },
    isChatContact: {
      type: Boolean,
      dedfault: false,
    },
  },
  setup() {
    return { formatDateToMonthShort }
  },
}
</script>

<style>

</style>
