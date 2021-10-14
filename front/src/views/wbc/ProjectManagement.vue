<template>
  <section id="wbc-project-management">
    <!-- top search bar -->
    <b-row class="mb-3">
      <b-col md=12>
          <b-form @submit.prevent>
              <b-row>
                <b-col md="4">
                  <b-form-select
                    v-model="projectname"
                    :options="options"
                  />
                </b-col>
                <b-col md="5">
                  <b-button
                    v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                    v-b-modal.create_project_modal
                    variant="outline-success"
                    class="mr-2"
                  >
                    フィルター
                  </b-button>
                  <b-button
                    v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                    v-b-modal.create_project_modal
                    variant="outline-danger"
                    class="mr-2"
                  >
                    フォロー
                  </b-button>
                  <b-button
                    v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                    v-b-modal.create_project_modal
                    variant="outline-warning"
                  >
                    折り畳む
                  </b-button>
                </b-col>
                <b-col md="3">
                  <b-input-group>
                    <b-form-input
                      id="shop-search"
                      placeholder="タスクを探す"
                    />
                    <b-input-group-append is-text>
                      <feather-icon icon="SearchIcon" />
                    </b-input-group-append>
                  </b-input-group>
                </b-col>
              </b-row>
          </b-form>
      </b-col>
    </b-row>
    <!-- main content -->
    <b-row>
      <b-col md="3">
        <b-card>
          <b-card-title>未着手　１</b-card-title>
          <b-card-text>
            <b-row>
              <b-col md="12">
                <b-button
                  variant="outline-primary"
                  block
                  v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                  class="mb-1"
                  v-b-toggle.task_collapse
                > 
                  + タスクを追加 
                </b-button>
                <b-collapse
                  id="task_collapse"
                >
                  <b-form-group>
                    <b-form-input 
                      id="add_board_title"
                      placeholder="追加"
                    />
                  </b-form-group>
                  <b-form-group>
                    <b-button
                      variant="primary"
                      size="sm"
                      class="mr-3"
                    >
                      追加
                    </b-button>
                    <b-button
                      variant="outline-secondary"
                      size="sm"
                    >
                      キャンセル
                    </b-button>
                  </b-form-group>
                </b-collapse>
              </b-col>
            </b-row>
            <b-row
              class="task-field-container"
            >
              <b-col 
                md="12" 
                v-for="task in tasks" v-bind:key="task.id"
                class="task"
                v-b-modal.create_task_modal
              >
                <span>{{task.title}}</span>
                <span>{{task.responsible}}</span>
                <span>{{task.state}}</span>
              </b-col>
            </b-row>
          </b-card-text>
        </b-card>
      </b-col>
      <b-col md="3">
        <b-card>
          <b-card-title>進行中　1</b-card-title>
          <b-card-text>
            <b-row>
              <b-col md="12">
                <b-button
                  variant="outline-primary"
                  block
                  v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                  class="mb-1"
                  v-b-toggle.new_task_collapse
                > 
                  + タスクを追加 
                </b-button>
                <b-collapse
                  id="new_task_collapse"
                >
                  <b-form-group>
                    <b-form-input 
                      id="add_new_board"
                      placeholder="追加"
                    />
                  </b-form-group>
                  <b-form-group>
                    <b-button
                      variant="primary"
                      size="sm"
                      class="mr-3"
                    >
                      追加
                    </b-button>
                    <b-button
                      variant="outline-secondary"
                      size="sm"
                    >
                      キャンセル
                    </b-button>
                  </b-form-group>
                </b-collapse>
              </b-col>
            </b-row>
            <b-row
              class="task-field-container"
            >
              <b-col 
                md="12" 
                v-for="ntask in newTasks" v-bind:key="ntask.id"
                class="task"
                v-b-modal.create_task_modal
              >
                <span>{{ntask.title}}</span>
                <span>{{ntask.state}}</span>
              </b-col>
            </b-row>
          </b-card-text>
        </b-card>
      </b-col>
    </b-row>
    <!-- modal -->
    <b-modal
      id="create_task_modal"
      cancel-variant="secondary"
      ok-only
      ok-title="登録"
      centered
      size="lg"
      title="新規タスクの作成"
    >
      <b-card-text>
        <b-row>
          <b-col cols="6">
            <b-row>
              <b-col cols="12">
                <b-form-group
                  label="タイトル"
                  label-for="new_task_title"
                >
                  <b-form-input 
                    id="new_task_title"
                    placeholder="タイトル"
                    rounded
                  />
                </b-form-group>
              </b-col>
              <b-col cols="12">
                <b-form-group
                  label="作業内容"
                  label-for="new_task_detail"
                >
                  <b-form-textarea 
                    id="new_task_detail"
                    placeholder="作業内容"
                    rows="3"
                    rounded
                  />
                </b-form-group>
              </b-col>
              <b-col cols="12">
                <b-button
                  variant="outline-secondary"
                  class="mb-1"
                >タグ</b-button>
              </b-col>
              <b-col cols="12">
                <b-button
                  variant="outline-secondary"
                  class="mr-1 mb-1"
                >プロジェクト</b-button>
                <b-button
                  variant="outline-secondary"
                  class="mb-1"
                >取引先</b-button>
              </b-col>
              <b-col cols="12" class="mb-1">
                <b-row>
                  <b-col cols="3">
                    <b-button 
                      variant="outline-secondary"
                    >
                      期間
                    </b-button>
                  </b-col>
                  <b-col cols="9">
                    <flat-pickr
                      v-model="fp_range"
                      name="fp_range"
                      :config="config"
                      class="form-control"
                      placeholder="YYYY-MM-DD to YYYY-MM-DD"
                    ></flat-pickr>
                  </b-col>
                </b-row>
              </b-col>
              <b-col cols="12" class="mb-1">
                <b-row>
                  <b-col cols="3">
                    <b-button
                      variant="outline-secondary"
                    >
                      担当者
                    </b-button>
                  </b-col>
                  <b-col cols="3">
                    <b-button
                      variant="outline-secondary"
                    >
                      状態
                    </b-button>
                  </b-col>
                  <b-col cols="6">
                    <b-form-select
                      v-model="taskname"
                      :options="options"
                    ></b-form-select>
                  </b-col>
                </b-row>
              </b-col>
              <b-col cols="12" class="d-flex mb-1">
                <b-button
                  variant="outline-secondary"
                >チェックリスト新規作成</b-button>
                <b-button
                  variant="outline-secondary"
                  class="ml-auto"
                >展開する</b-button>                
              </b-col>
              <b-col cols="12">
                <table class="test">
                  <tr>
                    <td class="testresult">テスト</td>
                    <td>O / O</td>
                    <td class="fix-task">修正</td>
                    <td class="delete-task">削除</td>
                  </tr>
                  <tr>
                    <td class="testresult">テスト2</td>
                    <td>O / O</td>
                    <td class="fix-task">修正</td>
                    <td class="delete-task">削除</td>
                  </tr>
                </table>
              </b-col>
            </b-row>
          </b-col>
          <b-col cols="6">
            <b-row>
              <b-col cols="12" class="">
                <b-form-group
                  label="コメント"
                  label-for="new_task_comment"
                >
                  <b-form-textarea 
                    id="new_task_comment"
                    placeholder="コメント"
                    rows="3"
                    rounded
                  />
                </b-form-group>
              </b-col>
              <b-col cols="12" class="d-flex mb-1">
                <b-button
                  variant="outline-secondary"
                  class="ml-auto"
                >
                  投稿
                </b-button>
                <b-button
                  variant="outline-secondary"
                  class="ml-1"
                >
                  添付
                </b-button>
              </b-col>
              <b-col cols="12" class="d-flex align-items-center mb-3">
                <b-avatar
                  :src="require('@/assets/images/portrait/small/avatar-s-5.jpg')"
                />
                <div class="ml-50 w-100">
                  <h6 class="mb-0">コメント　太郎　2021年09月24日　（金）</h6>
                  <div>
                    <table class="test">
                      <tr>
                        <td class="testresult"></td>
                        <td class="delete-task">削除</td>
                      </tr>
                      <tr>
                        <td class="testresult"></td>
                        <td class="fix-task">修正</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </b-col>
              <b-col cols="12" class="d-flex align-items-center">
                <b-avatar
                  :src="require('@/assets/images/portrait/small/avatar-s-5.jpg')"
                />
                <div class="ml-50 w-100">
                  <h6 class="mb-0">コメント　太郎　2021年09月24日　（金）</h6>
                  <div>
                    <table class="test">
                      <tr>
                        <td class="testresult"></td>
                        <td class="delete-task">削除</td>
                      </tr>
                      <tr>
                        <td class="testresult"></td>
                        <td class="fix-task">修正</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </b-col>
            </b-row>
          </b-col>
        </b-row>
      </b-card-text>
    </b-modal>
  </section>
</template>

<script>
import { BRow, BCol, BFormGroup, BFormFile, BFormTextarea, BInputGroup, BForm, BFormSelect, BFormInput, BInputGroupAppend, BButton, BCard, BCardBody, BCardFooter, BCardTitle, BCardText, BButtonGroup, BCollapse, VBToggle, BModal, BAvatar } from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

export default {
components: {
    BRow,
    BCol,
    BInputGroup, 
    BFormInput,
    BForm, 
    BFormGroup,
    BFormTextarea,
    BFormSelect, 
    BFormFile,
    BInputGroupAppend, 
    BButton,
    BButtonGroup,
    BCard, 
    BCardBody, 
    BCardFooter, 
    BCardTitle, 
    BCardText,
    BCollapse,
    BModal,
    flatPickr,
    BAvatar
  },
  directives: {
    'b-toggle': VBToggle,
    Ripple
  },
  data() {
    return {
      projectname: "wbc",
      taskname: "wbc",
      fp_range: null,
      options: [
          "チームのタスク",
          "OOOOOOOOOO",
          "OOOOOOOOOO"
      ],
      tasks: [
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          responsible: "担当：〇〇　　　期限　○/○",
          state: "指示待ち　　　　№001"
        },
      ],
      newTasks: [
        {
          title: "サンプルタスク　　　･･･",
          state: "№001"
        },
        {
          title: "サンプルタスク　　　･･･",
          state: "№001"
        },        {
          title: "サンプルタスク　　　･･･",
          state: "№001"
        },      
      ],
      config: {
        mode: 'range',
        altFormat: 'M j, Y',
        altInput: true,
        dateFormat: 'YYYY-MM-DD',
      },  
    }
  },
  created() {

  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/chart-apex.scss';
.task-field-container{
  overflow: auto;
  max-height: 800px;
  padding: 1rem;
}
.task-field-container .task{
  border-radius: 1rem;
  border: 1px solid #7367f0;
  padding: 0.5rem;
  margin-bottom: 1rem;
}
.task-field-container .task span{
  margin: 0.5rem;
  display: block;
}

.custom-label label{
  margin: 0 0.5rem;
  border: 1px solid #82868b;
  text-align: center;
  border-radius: 0.5rem;
}
.test, td, th {
	border: 1px solid #d1d1d1;
}
  
table {
	border-collapse: collapse;
	width: 100%;
}
  
td {
	text-align: center;
}
.testresult{
	width:60%;
}
.fix-task{
	background-color:lightblue;
}
.delete-task{
	background-color: orange;
}
#create_task_modal .modal-body .btn {
  padding: 0.786rem 0.7rem !important;
}

::-webkit-scrollbar {
  width: 5px;
  height: 0px;
}
::-webkit-scrollbar-track {
  background: transparent;
}
::-webkit-scrollbar-thumb {
  border-radius: 2px;
  background: rgba(228, 211, 211, 0.548);
}
</style>
