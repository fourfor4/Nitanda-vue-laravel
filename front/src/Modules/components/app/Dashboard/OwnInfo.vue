<template>
  <b-card no-body>    
    <b-card-body class="pt-3 pb-3">
      <b-row class="mb-2">
        <b-col md="5" class="d-flex align-items-center justify-content-center">
          <b-img 
            rounded
            alt="Rounded image"
            class="d-inline-block"
            :src="require('@/assets/images/portrait/small/avatar-s-2.jpg')"
            width="110"
            height="110"
          />
        </b-col>
        <b-col md="7">
          <p class="mb-50">名前:Seo</p>
          <p class="mb-50">社員ID:008965</p>
          <p class="mb-50">メール:seo@vultukir.org</p>
          <p class="mb-50">役職:<b-badge variant="light-success">取締役</b-badge></p>
          <p class="mb-50">部署:</p>
          <p class="mb-50">等級:311</p>
          <p class="mb-50">サークル:マラソン</p>
        </b-col>
      </b-row>
      <b-row>
        <b-col cols="6">
          <p class="text-primary">自分の目標</p>
        </b-col>
        <b-col cols="6">
          <p class="text-primary">部署の目標</p>
        </b-col>
      </b-row>
      <b-row>
        <b-col cols="6">
          <p class="">今年は・・・・</p>
        </b-col>
        <b-col cols="6">
          <p class="">部署全体の・・・</p>
        </b-col>
      </b-row>
      <b-row>
        <b-col cols="6">
          <p class="text-primary">チームメンバー</p>
        </b-col>
      </b-row>
      <b-row>
        <b-col cols="12">
          <b-avatar
            class="mr-1"
            :src="require('@/assets/images/portrait/small/avatar-s-14.jpg')"
          />
          <b-avatar
            :src="require('@/assets/images/portrait/small/avatar-s-4.jpg')"
          />
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
  BBadge,
  BAvatar,
  BImg,
  BRow,
  BCol
} from 'bootstrap-vue'

export default defineComponent({
  components: {
    BCard,
    BCardBody,
    BBadge,
    BAvatar,
    BImg,
    BRow,
    BCol
  },
  setup() {
    
  },
})
</script>
