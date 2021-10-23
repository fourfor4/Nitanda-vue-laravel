<template>
  <layout-vertical>
    <router-view />
  </layout-vertical>
</template>

<script>
import LayoutVertical from '@/Modules/theme-layouts/layout-vertical/LayoutVertical.vue'
import { $themeConfig } from '@themeConfig'

export default {
  components: {
    LayoutVertical,
  },
  data() {
    return {
      showCustomizer: $themeConfig.layout.customizer,
    }
  },
}
</script>
