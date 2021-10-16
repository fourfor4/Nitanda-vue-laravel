<template>
  <div>
    <b-card no-body>
      <b-card-header>
        <div>
          <b-card-title class="mb-1">
            年間推移
          </b-card-title>
          <b-card-sub-title>スコア、投稿数、回答数</b-card-sub-title>
        </div>
      </b-card-header>
      <b-card-body>
        <b-card-header>
          <div>
            <b-card-title class="mb-1">
              統計
            </b-card-title>
            <b-card-sub-title>商業ネットワークと企業</b-card-sub-title>
          </div>
        </b-card-header>
        <b-card-body>
          <chartjs-component-line-chart
            :height="400"
            :data="chartjsData.lineChart.data"
            :options="chartjsData.lineChart.options"
          />
        </b-card-body>
      </b-card-body>
    </b-card>
    <b-row>
      <b-col cols="6">
        <b-card no-body class="pb-1">
          <b-card-header>
            <b-card-title>
              月間ランキング（1-10）
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
      </b-col>
      <b-col cols="6">
        <b-card no-body class="pb-1">
          <b-card-header>
            <b-card-title>
              月間ランキング（1-10）
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
      </b-col>
    </b-row>
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
  BTable
} from 'bootstrap-vue'
import ChartjsComponentLineChart from '@/Modules/components/layouts/charts/ChartjsComponentLineChart.vue'
import chartjsData from './chartjsData'

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
    //
    ChartjsComponentLineChart
  },
  setup() {
    return {
      chartjsData,
      tableFields:[
        '順位',
        '名前',
       'スコア数'
      ],
      tableItems:[{
        順位:'よく',
        名前:'よく',
        スコア数:'よく'
      }],
    }
  },
})
</script>
