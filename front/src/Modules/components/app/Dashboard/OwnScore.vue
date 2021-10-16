<template>
  <b-card border-variant="primary" no-body>    
    <b-card-body class="p-3">
      <b-row>
        <b-col cols="6" class="mb-1">
          <div class="d-flex align-items-start">
            <span class="badge bg-light-primary p-75 rounded">
              <feather-icon
                icon="CheckIcon"
                class="font-medium-2"/>
            </span>
            <div class="ms-75 ml-1">
              <h4 class="mb-0">10位</h4>
              <small>月間ランキング</small>
            </div>
          </div>
        </b-col>
        <b-col cols="6" class="mb-1">
          <div class="d-flex align-items-start">
            <span class="badge bg-light-primary p-75 rounded">
              <feather-icon
                icon="BriefcaseIcon"
                class="font-medium-2"/>
            </span>
            <div class="ms-75 ml-1">
              <h4 class="mb-0">568</h4>
              <small>月間スコア</small>
            </div>
          </div>
        </b-col>
        <b-col cols="6" class="mb-1">
          <div class="d-flex align-items-start">
            <span class="badge bg-light-primary p-75 rounded">
              <feather-icon
                icon="CheckIcon"
                class="font-medium-2"/>
            </span>
            <div class="ms-75 ml-1">
              <h4 class="mb-0">1.01k</h4>
              <small> 投 稿 数 </small>
            </div>
          </div>
        </b-col>
        <b-col cols="6" class="mb-1">
          <div class="d-flex align-items-start">
            <span class="badge bg-light-primary p-75 rounded">
              <feather-icon
                icon="BriefcaseIcon"
                class="font-medium-2"/>
            </span>
            <div class="ms-75 ml-1">
              <h4 class="mb-0">568</h4>
              <small> 回　答　数 </small>
            </div>
          </div>
        </b-col>
      </b-row>
    </b-card-body>
  </b-card>
</template>
<script>
import { defineComponent } from '@vue/composition-api'
import {
  BCard,
  BCardBody,
  BRow,
  BCol
} from 'bootstrap-vue'

export default defineComponent({
  components: {
    BCard,
    BCardBody,
    BRow,
    BCol
  },
  setup() {
    
  },
})
</script>
