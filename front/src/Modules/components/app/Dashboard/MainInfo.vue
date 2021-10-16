<template>
  <div>
    <b-card no-body class="pb-1">
      <b-card-header>
        <b-card-title>
          プロジェクト一覧
        </b-card-title>
      </b-card-header>
      <b-table 
        responsive
        :items="tableItems"
        :fields="tableFields"
        class="mb-0"
      >
        <template #cell()="data">
          {{data.value}}
        </template>
      </b-table>
    </b-card>
    <b-card no-body>
      <b-card-header>
        <b-card-title>
          進捗情報
        </b-card-title>
      </b-card-header>
      <b-card-body>
        <app-timeline>

          <app-timeline-item>
            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
              <h6>作業を完了しました。</h6>
              <small class="text-muted">12 時前</small>
            </div>
            <p> 2:12pm</p>
          </app-timeline-item>

          <app-timeline-item variant="warning">
            <div class="d-flex flex-sm-row flex-column flex-wrap justify-content-between mb-1 mb-sm-0">
              <h6>〇〇投稿へ回答が来ました。</h6>
              <small class="text-muted">45 時前</small>
            </div>
            <p>〇〇でどうでしょうか？ @10:15am</p>
            <b-media>
              <template #aside>
                <b-avatar :src="require('@/assets/images/avatars/12-small.png')" />
              </template>
              <h6>はなこ (お客様)</h6>
              <p>Web デザイン者</p>
            </b-media>
          </app-timeline-item>

          <app-timeline-item variant="success">
            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
              <h6>〇〇プロジェクトのメンバーへ登録されました。</h6>
              <small class="text-muted">2 月前</small>
            </div>
            <p>●月○日稼働予定　営業担当：〇〇</p>
          </app-timeline-item>

          <app-timeline-item variant="danger">
            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
              <h6>クライアントの請求書を作成する</h6>
              <small class="text-muted">12 時前</small>
            </div>
            <p>新しい請求書を作成し、お客様に送信します</p>
            <div class="d-flex flex-row align-items-center mt-50">
              <b-img :src="require('@/assets/images/icons/pdf.png')" height="25" />
              <h6 class="ml-1">辞書.pdf</h6>
            </div>
          </app-timeline-item>
        </app-timeline>
      </b-card-body>
    </b-card>
  </div>
</template>
<script>
import { defineComponent } from '@vue/composition-api'
import {
  BCard,
  BCardHeader,
  BCardBody,
  BCardTitle,
  BCardSubTitle,
  BRow,
  BCol,
  BTable,
  VBTooltip,
  VBToggle,
  BAvatar,
  BAvatarGroup,
  BImg,
  BMedia,
  BCollapse,
  BBadge,
  BButton,
  BListGroup,
  BListGroupItem,
} from 'bootstrap-vue'
import AppTimeline from '@core/components/app-timeline/AppTimeline.vue'
import AppTimelineItem from '@core/components/app-timeline/AppTimelineItem.vue'
import Ripple from 'vue-ripple-directive'

export default defineComponent({
  components: {
    BCard,
    BCardHeader,
    BCardBody,
    BCardTitle,
    BCardSubTitle,
    BRow,
    BCol,
    BTable,
    BAvatar,
    BAvatarGroup,
    BImg,
    BMedia,
    BCollapse,
    BBadge,
    BButton,
    BListGroup,
    BListGroupItem,
    //core component
    AppTimelineItem,
    AppTimeline
  },
  directives: { 'b-toggle': VBToggle, 'b-tooltip': VBTooltip, Ripple },
  setup() {
    return {
      tableFields:[
        'No',
        'プロジェクト名',
        '全作業数',
        '進捗',
        '期間',
        'メンバー'
      ],
      tableItems:[
        {
          No:'１',
          プロジェクト名:'ありがと',
          全作業数:'ありがと',
          進捗:'ありがと',
          期間:'ありがと',
          メンバー:'ありがと'
        }
      ],
    }
  },
})
</script>
