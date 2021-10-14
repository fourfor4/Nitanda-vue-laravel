<template>
  <section id="wbc-dashboard-ranking">
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
      <div class="content-body">
        <section class="app-user-view-account">
          <b-row>
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
              <!-- User Card -->
              <div class="card">
                <div class="card-body">
                <div class="row my-2">
                  <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                    <div class="d-flex align-items-center justify-content-center">
                      <img class="img-fluid rounded mt-3 mb-2" src="../../assets/app-assets/images/portrait/small/avatar-s-2.jpg" height="110" width="110" alt="User avatar" />
                    </div>
                    </div>
                  <div class="col-12 col-md-7">
                    <div class="info-container">
                      <ul class="list-unstyled">
                        <li class="mb-75">
                          <span class="fw-bolder me-25">名前:</span>
                          <span>Seo</span>
                        </li>
                        <li class="mb-75">
                          <span class="fw-bolder me-25">社員ID:</span>
                          <span>008965</span>
                        </li>
                        <li class="mb-75">
                          <span class="fw-bolder me-25">メール:</span>
                          <span>seo@vultukir.org</span>
                        </li>
                        <li class="mb-75">
                          <span class="fw-bolder me-25">役職:</span>
                          <span class="badge bg-light-success">取締役</span>
                        </li>
                        <li class="mb-75">
                          <span class="fw-bolder me-25">部署:</span>
                          <span></span>
                        </li>
                        <li class="mb-75">
                          <span class="fw-bolder me-25">等級:</span>
                          <span>311</span>
                        </li>
                        <li class="mb-75">
                          <span class="fw-bolder me-25">サークル:</span>
                          <span>マラソン</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <hr  style="padding:0px"/>
                </div>
                <div class="row my-2">
                  <div class="col-12 col-md-6">
                    <p class="card-text"><span class="text-primary">自分の目標</span></p>
                      今年は・・・・
                    <p class="card-text">
                    </p>
                  </div>
                  <div class="col-12 col-md-6">
                    <p class="card-text"><span class="text-primary">部署の目標</span></p>
                      部署全体の・・・
                    <p class="card-text">
                    </p>
                </div>
                </div>
                <div class="row my-2">
                  <p class="card-text w-100 ml-1"><span class="text-primary">チームメンバー</span></p>
                  <div class="col-12 col-md-6">
                    <a class="d-flex" href="#">					
                      <div class="list-item d-flex align-items-start">
                        <div class="me-1">
                          <div class="avatar"><img src="../../assets/app-assets/images/portrait/small/avatar-s-3.jpg" alt="avatar" width="32" height="32"></div>
                        </div>
                        <div class="me-1 ml-1">
                          <div class="avatar"><img src="../../assets/app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" width="32" height="32"></div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                </div>
              </div>
              <!-- /User Card -->
              <!-- Plan Card -->
              <div class="card border-primary">
                <div class="card-body d-flex justify-content-around">
                  <div class="d-flex my-2 pt-75 " style="flex-direction:column">
                    <div class="d-flex align-items-start me-2 ">
                      <span class="badge bg-light-primary p-75 rounded mb-2">
                        <feather-icon
                          icon="CheckIcon"
                          class="font-medium-2"/>
                      </span>
                      <div class="ms-75 ml-1">
                        <h4 class="mb-0">10位</h4>
                        <small>月間ランキング</small>
                      </div>
                    </div>
                    <div class="d-flex align-items-start me-2 ">
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
                  </div>
                  <div class="d-flex my-2 pt-75 " style="flex-direction:column">
                    <div class="d-flex align-items-start ">
                      <span class="badge bg-light-primary p-75 rounded mb-2">
                        <feather-icon
                          icon="BriefcaseIcon"
                          class="font-medium-2"
                        />
                      </span>
                      <div class="ms-75 ml-1">
                        <h4 class="mb-0">568</h4>
                        <small>月間スコア</small>
                      </div>
                    </div>
                    <div class="d-flex align-items-start flex4">
                      <span class="badge bg-light-primary p-75 rounded">
                        <feather-icon
                          icon="BriefcaseIcon"
                          class="font-medium-2"
                        />
                      </span>
                      <div class="ms-75 ml-1">
                          <h4 class="mb-0">568</h4>
                          <small> 回　答　数 </small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Plan Card -->
            </div>
            <!--/ User Sidebar -->
            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
              <!-- User Pills -->
              <ul class="nav nav-pills mb-2">
                <li class="nav-item">
                  <router-link to="/dashboard">
                  <a class="nav-link">
                    <feather-icon icon="UserIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">基本情報</span></a>
                  </router-link>
                </li>
                <li class="nav-item">
                  <a class="nav-link">
                    <feather-icon icon="LockIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">投稿</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link">
                    <feather-icon icon="BookmarkIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">回答待ち</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" >
                    <feather-icon icon="BellIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">ランキング</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" >
                    <feather-icon icon="LinkIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">チームタスク</span>
                  </a>
                </li>
              </ul>
              <!--/ User Pills -->
            <!-- Line Chart Starts-->
            <b-row>
              <b-col cols="12">
                <div class="card">
                  <div class="card-header">
                    <div>
                      <h4 class="card-title">年間推移</h4>
                      <span class="card-subtitle text-muted">スコア、投稿数、回答数</span>
                    </div>
                  </div>
                  <div class="card-body">
                    <chartjs-line-chart />
                  </div>
                </div>
              </b-col>
            </b-row>
            <!-- Line Chart Ends-->
            <!-- Project table -->
            <b-row>
              <b-col cols="6">
                <div class="card">
                  <h4 class="card-header">月間ランキング（1-10）</h4>
                  <div class="table-responsive">
                    <b-table 
                      responsive
                      :items="item1"
                      :fields="field1"
                      class="mb-0"
                    >
                      <template #cell()="data">
                        {{data.value}}
                      </template>
                    </b-table>
                  </div>
                </div>
              </b-col>
              <b-col cols="6">
                <div class="card">
                  <h4 class="card-header">年間ランキング（1-10）</h4>
                  <div class="table-responsive">
                    <b-table 
                    responsive
                    :items="item2"
                    :fields="field2"
                    class="mb-0">
                      <template #cell()="data">
                        {{data.value}}
                      </template>
                    </b-table>
                  </div>
                </div>
              </b-col>
            </b-row>
            <!-- /Project table -->
            </div>
            <!--/ User Content -->
          </b-row>
        </section>
      </div>
    </div>
  </section>
</template>

<script>
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {BTable} from 'bootstrap-vue'
import { BRow, BCol, BLink } from 'bootstrap-vue'

import ChartjsLineChart from './chart/ChartjsLineChart.vue'

export default {
  components: {
    BRow,
    BCol,
    BLink,
    BTable,
    ChartjsLineChart,
  },
  data() {
    return {
      field1:[
        '順位',
        '名前',
       'スコア数'
      ],
      item1:[{
        順位:'よく',
        名前:'よく',
        スコア数:'よく'
      }],
       field2:[
        '順位',
        '名前',
       'スコア数'
      ],
      item2:[{
        順位:'よく',
        名前:'よく',
        スコア数:'よく'
      }],
    }
  },
  created() {

  },
}
</script>

<style lang="scss">
  @import '@core/scss/vue/libs/chart-apex.scss';
</style>
