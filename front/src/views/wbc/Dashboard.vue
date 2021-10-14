<template>
  <section id="wbc-dashboard">
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="app-user-view-account">
          <b-row> 
            <!-- User Sidebar -->
            <b-col xl="4" lg="5" md="5" class="rder-1 order-md-0">
              <!-- User Card -->
              <div class="card">
                <div class="card-body">
                  <b-row class="my-2">
                    <b-col cols="12" md="5" class="d-flex align-items-center justify-content-center mb-2 mb-md-0">
                      <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid rounded mt-3 mb-2" src="../../assets/app-assets/images/portrait/small/avatar-s-2.jpg" height="110" width="110" alt="User avatar" />
                      </div>
                    </b-col>
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
                    <hr style="padding:0px" />
                  </b-row>
                <b-row class="my-2">
                  <b-col cols="12" md="6">
                    <p class="card-text"><span class="text-primary">自分の目標</span></p>
                      今年は・・・・
                    <p class="card-text">
                    </p>
                  </b-col>
                  <b-col cols="12" md="6">
                    <p class="card-text"><span class="text-primary">部署の目標</span></p>
                      部署全体の・・・
                    <p class="card-text">
                    </p>
                  </b-col>
                </b-row>
                <b-row class="my-2">
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
                  </b-row>
                </div>
              </div>
              <!-- /User Card -->
              <!-- Plan Card -->
              <div class="card border-primary">
                <div class="card-body d-flex justify-content-around">
                  <div class="d-flex my-2 pt-75 " style="flex-direction:column">
                    <div class="d-flex align-items-start me-2 flex5 mg-b1">
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
                    <div class="d-flex align-items-start me-2 flex5">
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
                    <div class="d-flex align-items-start flex4 mg-b1">
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
            </b-col>
            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
              <!-- User Pills -->
              <ul class="nav nav-pills mb-2">
                <li class="nav-item">
                  <a class="nav-link active" >
                    <feather-icon icon="UserIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">基本情報</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" >
                    <feather-icon icon="LockIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">投稿</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" >
                    <feather-icon icon="BookmarkIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">回答待ち</span>
                  </a>
                </li>
                <li class="nav-item"  >
                  <router-link to="/dashboard-ranking">
                    <a class="nav-link"  >
                      <feather-icon icon="BellIcon" class="font-medium-3 me-50"/>
                      <span class="fw-bold">ランキング</span>
                    </a>
                  </router-link>
                </li>
                <li class="nav-item">
                  <a class="nav-link" >
                    <feather-icon icon="LinkIcon" class="font-medium-3 me-50"/>
                    <span class="fw-bold">チームタスク</span>
                  </a>
                </li>
              </ul>
              <!--/ User Pills -->
              <!-- Project table -->
              <div class="card">
                <h4 class="card-header">プロジェクト一覧</h4>
                <div class="table-responsive">
                  <b-table
                    responsive
                    :items="items"
                    :fields="fields"
                    class="mb-0"
                  >
                    <template #cell()="data">
                      {{data.value}}
                    </template>
                  </b-table>
                </div>
              </div>
              <!-- /Project table -->
              <!-- Activity Timeline -->
              <div class="card">
                <h4 class="card-header">進捗情報</h4>
                <div class="card-body pt-1">
                  <ul class="timeline ms-50">
                    <li class="timeline-item">
                      <span class="timeline-point timeline-point-indicator"></span>
                      <div class="timeline-event">
                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                          <h6>作業を完了しました。</h6>
                          <span class="timeline-event-time me-1">12 時前</span>
                        </div>
                        <p> 2:12pm</p>
                      </div>
                    </li>
                    <li class="timeline-item">
                      <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                      <div class="timeline-event">
                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                          <h6>〇〇投稿へ回答が来ました。</h6>
                          <span class="timeline-event-time me-1">45 時前</span>
                        </div>
                        <p>〇〇でどうでしょうか？ @10:15am</p>
                        <div class="d-flex flex-row align-items-center mb-50">
                          <div class="avatar me-50">
                            <img src="../../assets/app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" width="38" height="38" />
                          </div>
                          <div class="user-info ml-1">
                            <h6 class="mb-0">はなこ (お客様)</h6>
                            <p class="mb-0">Web デザイン者</p>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="timeline-item">
                      <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                      <div class="timeline-event">
                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                          <h6>〇〇プロジェクトのメンバーへ登録されました。</h6>
                          <span class="timeline-event-time me-1">2 月前</span>
                        </div>
                        <p>●月○日稼働予定　営業担当：〇〇</p>
                      </div>
                    </li>
                    <li class="timeline-item">
                      <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                      <div class="timeline-event">
                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                          <h6>クライアントの請求書を作成する</h6>
                          <span class="timeline-event-time me-1">12 時前</span>
                        </div>
                        <p class="mb-0">新しい請求書を作成し、お客様に送信します</p>
                        <div class="d-flex flex-row align-items-center mt-50">
                          <img class="me-1 mr-1" src="../../assets/app-assets/images/icons/pdf.png" alt="data.json" height="25" />
                          <h6 class="mb-0　">辞書.pdf</h6>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- /Activity Timeline -->
            </div>
            <!--/ User Content -->
          </b-row>
        </section>
      </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
  </section>
</template>

<script>
import { BRow, BCol,BTable } from 'bootstrap-vue'
import 'vue-feather-icons'
import FeatherIcon from '@/@core/components/feather-icon/FeatherIcon.vue'
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

export default {
  components: {
    BRow,
    BCol,
    FeatherIcon,
    BTable,
  },
  data() {
    return {
      fields:[
        'No',
        'プロジェクト名',
        '全作業数',
        '進捗',
        '期間',
        'メンバー'
      ],
      items:[
        {
          No:'１',
          プロジェクト名:'ありがと',
          全作業数:'ありがと',
          進捗:'ありがと',
          期間:'ありがと',
          メンバー:'ありがと'
        }
      ],
      data: {},
    }
  },
  created() {

  },
}
</script>
<style lang="scss">
  @import '@core/scss/vue/libs/chart-apex.scss';
</style>
