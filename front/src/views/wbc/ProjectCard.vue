<template>
    <section id="wbc-project-card">
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
                        <b-col md="4">
                            <b-input-group>
                                <b-form-input
                                    id="shop-search"
                                    placeholder="検索"
                                />
                                <b-input-group-append is-text>
                                    <feather-icon icon="SearchIcon" />
                                </b-input-group-append>
                            </b-input-group>
                        </b-col>
                        <b-col md="4" class="d-flex">
                            <b-button
                                class="ml-auto"
                                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                                v-b-modal.create_project_modal
                                variant="outline-primary"
                            >
                                新規プロジェクト
                            </b-button>
                        </b-col>
                    </b-row>
                </b-form>
            </b-col>
        </b-row>
        <!-- main cards content -->
        <b-row>
            <b-col md="3" v-for="item in items" v-bind:key="item.id">
                <b-card>
                    <b-card-body>
                        <b-card-title>{{item.title}}</b-card-title>
                        <b-card-text>
                            {{item.text}}
                        </b-card-text>
                    </b-card-body>
                    <b-card-footer>
                        <small class="text-muted">
                            {{item.time}}
                            <span class="star star-gold">&nbsp; ★</span>
                        </small>
                        <b-dropdown class="small-dropdown e-caret-hide">
                            <b-dropdown-item>説明 1</b-dropdown-item>
                            <b-dropdown-item>説明 2</b-dropdown-item>
                            <b-dropdown-item>説明 3</b-dropdown-item>
                        </b-dropdown>
                    </b-card-footer>
                </b-card>
            </b-col>
        </b-row>
        <!-- new task button -->
        <b-row>
            <b-col md="12" class="newtask">
                <b-button
                    class="btn-icon rounded-circle"
                    variant="outline-primary"
                >
                    <feather-icon icon="PlusIcon" />
                </b-button>
            </b-col>
        </b-row>

        <!-- modal -->
        <b-modal
            id="create_project_modal"
            cancel-variant="secondary"
            ok-only
            ok-title="登録"
            centered
            size="md"
            title="新規プロジェクトの作成"
        >
            <b-card-text>
                <b-row>
                    <b-col cols="12">
                        <b-form-group
                            label="プロジェクト名"
                            label-for="new_project_title"
                        >
                            <b-form-input 
                                id="new_project_title"
                                placeholder="プロジェクト名"
                            />
                        </b-form-group>
                    </b-col>
                    <b-col cols="12">
                        <b-form-group
                            label="説明"
                            label-for="new_project_description"
                        >
                            <b-form-textarea 
                                id="new_project_description"
                                placeholder="説明"
                                rows="3"
                            />
                        </b-form-group>
                    </b-col>
                    <b-col cols="12">
                        <b-form-group
                            label="分類"
                            label-for="classification"
                            label-cols-md="3"
                        >
                            <b-button-group>
                                <b-button
                                v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                                variant="outline-primary"
                                >
                                    導入
                                </b-button>
                                <b-button
                                v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                                variant="outline-primary"
                                >
                                    新規
                                </b-button>
                                <b-button
                                v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                                variant="outline-primary"
                                >
                                    テスト
                                </b-button>
                            </b-button-group>
                        </b-form-group>
                    </b-col>
                    <b-col cols="12">
                        <b-form-group
                            label="添付"
                            label-for="attached"
                            label-cols-md="3"
                        >
                            <b-form-file
                                id="attached"
                                placeholder="0000000.pdf"
                            />
                        </b-form-group>
                    </b-col>
                    <b-col cols="12">
                        <b-form-group
                            label="期間"
                            label-for="fp_range"
                            label-cols-md="3"
                        >
                            <flat-pickr
                                v-model="fp_range"
                                name="fp_range"
                                :config="config"
                                class="form-control"
                                placeholder="YYYY-MM-DD to YYYY-MM-DD"
                            ></flat-pickr>
                        </b-form-group>
                    </b-col>
                    <b-col cols="12">
                        <b-form-group
                            label="メイン担当"
                            label-for="main_charge"
                            label-cols-md="3"
                        >
                            <b-avatar
                                variant="light-primary"
                                rounded
                                size="lg"
                                :src="require('@/assets/images/portrait/small/avatar-s-12.jpg')"
                            />
                        </b-form-group>
                    </b-col>
                    <b-col cols="12">
                        <b-form-group
                            label="サブ担当"
                            label-for="sub_charge"
                            label-cols-md="3"
                        >
                            <b-avatar
                                variant="light-primary"
                                rounded
                                size="lg"
                                :src="require('@/assets/images/portrait/small/avatar-s-22.jpg')"
                                class="mr-2"
                            />
                            <b-avatar
                                variant="light-primary"
                                rounded
                                size="lg"
                                :src="require('@/assets/images/portrait/small/avatar-s-26.jpg')"
                            />                        
                        </b-form-group>
                    </b-col>
                    <b-col cols="12">
                        <b-form-group
                            label="営業担当"
                            label-for="sales_staff"
                            label-cols-md="3"
                        >
                            <b-avatar
                                variant="light-primary"
                                rounded
                                size="lg"
                                :src="require('@/assets/images/portrait/small/avatar-s-3.jpg')"
                            />
                        </b-form-group>
                    </b-col>
                </b-row>
            </b-card-text>
        </b-modal>
    </section>
</template>

<script>
import { BRow, BCol, BFormGroup, BFormFile, BFormTextarea, BInputGroup, BForm, BFormSelect, BFormInput, BInputGroupAppend, BButton, BCard, BCardBody, BCardFooter, BCardTitle, BCardText, BDropdown, BDropdownItem, BModal, BButtonGroup, BAvatar } from 'bootstrap-vue'
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
    BDropdown,
    BDropdownItem,
    BModal,
    BAvatar,
    flatPickr
  },
  directives: {
    Ripple
  },
  data() {
    return {
      fp_range: null,
      options: [
        "チームのタスク",
        "OOOOOOOOOO",
        "OOOOOOOOOO"
      ],
      items: [
        {
          title: 'テストプロジェクト',
          text: '説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・',
          time: '今日の期限のタスク 0件'
        },
        {
          title: 'テストプロジェクト',
          text: '説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・',
          time: '今日の期限のタスク 0件'
        },
        {
          title: 'テストプロジェクト',
          text: '説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・',
          time: '今日の期限のタスク 0件'
        },
        {
          title: 'テストプロジェクト',
          text: '説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・',
          time: '今日の期限のタスク 0件'
        },
        {
          title: 'テストプロジェクト',
          text: '説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・',
          time: '今日の期限のタスク 0件'
        },
        {
          title: 'テストプロジェクト',
          text: '説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・',
          time: '今日の期限のタスク 0件'
        },
        {
          title: 'テストプロジェクト',
          text: '説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・ 説明・・・・・・・・・・・',
          time: '今日の期限のタスク 0件'
        }
      ],
      config: {
        mode: 'range',
        altFormat: 'M j, Y',
        altInput: true,
        dateFormat: 'YYYY-MM-DD',
      },
      projectname: 'wbc'
    }
  },
  created() {

  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/chart-apex.scss';

// .modal-position{
// 	float:right;
// }
.card-body{
    padding-bottom: 0.8rem;
}
.card-footer{
	font-size:0.8rem !important;
	padding:0.3rem 1.5rem;
}
.card-footer span{
	
	vertical-align: middle !important;
}
.star{
	font-size: 1.3rem;
}
.star-gold{
	color:rgb(252, 210, 26);
}
.small-dropdown{
    float: right;
}
.small-dropdown button{
    padding: 4px;
    border-radius: 50%;
    // background-color: #bbc0c5 !important;
    // border: 1px solid #82868b !important;
}
.small-dropdown button::after{
    left: 0rem !important;
}
.newtask button{
    float: right;
}
</style>
