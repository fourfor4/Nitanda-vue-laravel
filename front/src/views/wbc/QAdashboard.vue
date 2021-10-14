<template>
  <section id="wbc-qa-dashboard">
    <b-row>
      <b-col cols="12">
        <b-card no-body>
          <b-card-body>
            <b-row>
              <b-col sm="3">
                <b-input-group class="input-group-merge">
                  <b-form-input placeholder="検索" />
                  <b-input-group-append is-text>
                    <feather-icon icon="SearchIcon" />
                  </b-input-group-append>
                </b-input-group>
              </b-col>
            </b-row>
            <b-row class="mt-3">
              <b-col sm="8">
                <div class="qa-textarea p-1">
                  <b-form-textarea
                    id="textarea-default"
                    class="mb-1"
                    placeholder="質問内容"
                    rows="5"
                  />
                  <b-row>
                    <b-col lg="7">
                      <b-button-group
                        size="sm"
                      >
                        <b-button
                          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                          variant="outline-primary"
                        >
                          タグ
                        </b-button>
                        <b-button
                          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                          variant="outline-primary"
                        >
                          タグ1
                        </b-button>
                        <b-button
                          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                          variant="outline-primary"
                        >
                          タグ2
                        </b-button>
                        <b-button
                          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                          variant="outline-primary"
                        >
                          タグ3
                        </b-button>
                      </b-button-group>
                    </b-col>
                    <b-col lg="5">
                      <div class="d-flex align-items-center">
                        <feather-icon 
                          class="mr-2" 
                          icon="UploadIcon"
                          @click="onUploadBtnClick"
                        ></feather-icon>
                        <input 
                          ref="uploader"
                          class="d-none"
                          type="file"
                        />
                        <b-form-checkbox
                          v-model="selected"
                          value=""
                          class="custom-control-primary"
                        >
                          匿名投稿
                        </b-form-checkbox>
                        <b-button size="sm" class="ml-auto" variant="outline-primary">
                          送信
                        </b-button>
                      </div>
                    </b-col>
                  </b-row>
                </div>
              </b-col>
            </b-row>
          </b-card-body>
        </b-card>
        <b-card no-body>
          <b-card-body>
            <app-collapse accordion>
              <app-collapse-item 
                v-for="(blog, bindex) in blogs"
                v-bind:key="blog.id"
                v-bind:title="blog.time | timePipe"
                class="blog"
              >
              <div class="blog_container">
                <b-avatar
                  class="blog_avatar"
                  :src="blog.user.image"
                  size="lg"
                />
                <div class="blog_content">
                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column align-items-start">
                      <span class="user fav_color">{{blog.user.name}}</span>
                      <span class="detail">{{blog.detail}}</span>
                    </div>
                    <div class="right_header">
                      <span class="time">{{blog.timeago}}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="flex row justify-content-between">
                    <div class="col-md-3 d-flex justify-content-between">
                      <span class="score">スコア ( {{blog.totalScore}} )</span>
                      <span class="showallcomments">すべてコメントを見る ( {{blog.comments.length}} )</span>
                    </div>
                    <div class="d-flex col-md-4 justify-content-around">
                      <span class="favourite">★お気に入り</span>
                      <span class="nitanda-fix">修正</span>
                      <span class="nitanda-delete">削除</span>
                    </div>
                  </div>
                  <div class="comment_container">
                    <div class="media-list media-bordered">
                      <b-media
                        v-for="comment in blog.comments"
                        v-bind:key="comment.id"
                      >
                        <template #aside>
                          <b-avatar 
                            :src="comment.user.image"
                            size="lg"
                            class="mr-2"
                          />
                        </template>
                        <b-row>
                          <span class="col-md-3 fav_color">{{comment.user.name}}</span>
                          <span class="col-md-4 fav_color">{{comment.time}} {{comment.timeago}}</span>
                        </b-row>
                        <b-row>
                          <span>{{comment.detail}}</span>
                        </b-row>
                        <b-row>
                          <span class="mr-5">スコア ( {{comment.score}} )</span>
                          <span class="mr-5">★お気に入り</span>
                          <span class="mr-5">💛ベストアンサー</span>
                        </b-row>
                      </b-media>
                    </div>
                      <b-input-group class="input-group-merge mr-1">
                        <b-form-input
                          v-model="opinion"
                          placeholder="入力して送信"
                        />
                        <b-input-group-append is-text>
                          <feather-icon
                            icon="ImageIcon"
                            class="cursor-pointer"
                            v-on:click="attachmentFile(bindex)"
                          ></feather-icon>
                          <input type="file" ref="attachment" hidden/>
                        </b-input-group-append>
                      </b-input-group>
                  </div>
                </div>
              </div>
              </app-collapse-item>
            </app-collapse>
          </b-card-body>
        </b-card>
      </b-col>
    </b-row>
  </section>
</template>

<script>
import { 
  BRow, 
  BCol, 
  BCard, 
  BCardHeader, 
  BCardBody, 
  BCardTitle, 
  BButton, 
  BButtonGroup,
  BFormInput, 
  BFormGroup, 
  BFormSelect, 
  BForm, 
  BFormTextarea,
  BInputGroup,
  BInputGroupAppend,
  BTabs,
  BTab,
  BFormCheckbox,
  BAvatar,
  BMedia
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'

import AppCollapse from '@core/components/app-collapse/AppCollapse.vue'
import AppCollapseItem from './AppCollapseItem.vue'


export default {
  components: {
    BRow,
    BCol,
    BCard,
    BCardHeader,
    BCardBody,
    BCardTitle,
    BButton,
    BButtonGroup,
    BFormInput,
    BFormGroup,
    BFormSelect,
    BFormTextarea,
    BForm,
    BInputGroup,
    BInputGroupAppend,
    BTabs,
    BTab,
    BFormCheckbox,
    BAvatar,
    BMedia,
    AppCollapse,
    AppCollapseItem,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      selected: true,
      opinion: null,
      blogs: [
        {
          id: 1,
          time: '2021/09/26 9:07:45',
          timeago: '2時間前',
          user: {
            name: 'nitanda',
            image: require('@/assets/images/portrait/small/avatar-s-5.jpg')
          },
          detail: 'こんな質問を送信して見ました',
          totalScore: '100',
          favourite: false,
          comments: [
            {
              user: {
                name: '回答者A',
                image: require('@/assets/images/portrait/small/avatar-s-5.jpg')
              },
              time: '2021/09/26 9:08:45',
              timeago: '1時間前',
              detail: 'こんな質問へこんな回答をしてみました。',
              score: '10'
            },
            {
              user: {
                name: '回答者B',
                image: require('@/assets/images/portrait/small/avatar-s-5.jpg')
              },
              time: '2021/09/26 9:08:45',
              timeago: '1時間前',
              detail: 'こんな質問へこんな回答をしてみました。',
              score: '10'
            },
            {
              user: {
                name: '回答者C',
                image: require('@/assets/images/portrait/small/avatar-s-5.jpg')
              },
              time: '2021/09/26 9:08:45',
              timeago: '1時間前',
              detail: 'こんな質問へこんな回答をしてみました。',
              score: '10'
            }
          ]
        },
        {
          id: 2,
          time: '2021/09/26 9:07:45',
          timeago: '2時間前',
          user: {
            name: 'nitanda',
            image: require('@/assets/images/portrait/small/avatar-s-5.jpg')
          },
          detail: 'こんな質問を送信して見ました',
          totalScore: '100',
          favourite: false,
          comments: [
            {
              user: {
                name: '回答者A',
                image: require('@/assets/images/portrait/small/avatar-s-5.jpg')
              },
              time: '2021/09/26 9:08:45',
              timeago: '1時間前',
              detail: 'こんな質問へこんな回答をしてみました。',
              score: '10'
            },
            {
              user: {
                name: '回答者B',
                image: require('@/assets/images/portrait/small/avatar-s-5.jpg')
              },
              time: '2021/09/26 9:08:45',
              timeago: '1時間前',
              detail: 'こんな質問へこんな回答をしてみました。',
              score: '10'
            },
            {
              user: {
                name: '回答者C',
                image: require('@/assets/images/portrait/small/avatar-s-5.jpg')
              },
              time: '2021/09/26 9:08:45',
              timeago: '1時間前',
              detail: 'こんな質問へこんな回答をしてみました。',
              score: '10'
            }
          ]
        }
      ]
    }
  },
  methods: {
    onUploadBtnClick() {
      this.$refs.uploader.click()
    },
    attachmentFile(id) {
      this.$refs.attachment[id].click()
    },
  },
  filters: {
    timePipe: function(value) {
      if (!value) return ''
      return value
    }
  },
  created() {

  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/chart-apex.scss';
.qa-textarea {
  border: 1px solid #d8d6de;
  border-radius: 0.35rem;
}
.QA-textarea-outline{
	padding: 0.571rem 1rem;
	margin-top:1.5vw;
	display: flex;
}
.QA-textarea{
	border: 1px solid #d8d6de;
	border-radius: 0.357rem;
}
.QA-textarea-btngroup{
	margin-top:1vw;
	margin-bottom:0.3vw;
}
.QA-textarea-btngroup .btnrow .btn-group .btn{
	margin-top:0.4rem;
	margin-bottom:0.4rem;
	padding: 0.1rem 0.5rem !important;
	border-color: #d8d6de !important;
	color:#454447;
}
.QA-textarea-btngroup .processbtn .uploadbtn{
	margin-right: 1rem;
}
.QA-textarea-btngroup .processbtn button{
	margin-top:0.4rem;
	margin-bottom:0.4rem;
	padding-top: 0.2rem !important;
	padding-bottom: 0.2rem !important;
	border-color: #d8d6de !important;
	color:#454447;
	float:right;
}
.user-info-sub{
	margin-left: 5vw;
}
.nitanda-name, .nitanda-fix{
	color: rgb(0, 131, 218);
}
.nitanda-fix{
	cursor:pointer;
}
.nitanda-delete{
	color: rgb(243, 45, 45);
	cursor: pointer;
}
.nitanda-sublist{
	margin-bottom:2.5vw;
}
.nitanda-subinfo{
	margin-left:3vw;
}
.score, .favourite, .showallcomments, .fix, .delete{
	cursor:pointer;
}
.score:hover, .favourite:hover, .showallcomments:hover{
	color:rgb(3, 3, 3);
	font-weight: 600;
}
.fix:hover, .delete:hover{
	font-weight: 600;
}
.user-info p span{
	margin-left:1.5vw;
}
.list-adjust{
	margin-bottom: 2vw !important;
}
.checkbox-adjust{
	display: inline-block;
	padding-top: 0.5vw;
	margin-right:2vw;
}
.history-list{
	max-height: 10vw;
	overflow-y:scroll;
}

.blog div.blog_container{
  position: relative;
  margin-left: 30px;
  margin-top: 15px;
  padding-left: 30px;
}
.blog div.blog_container::after{
  width: 1px;
  height: 100%;
  background: linear-gradient(#ebe9f1, transparent);
  left: -6px;
  position: absolute;
  content: "";
  top: 30px;
}
.blog div.blog_container span.blog_avatar{
  position: absolute;
  left: -30px;
  top: -15px;
  z-index: 10;
}
.blog div.collapse-title{
  width: 100%;
  display: block;
}
.blog div.blog_container span.fav_color{
  color: rgb(0, 131, 218);
}
.blog div.blog_container .comment_container{
  overflow: auto;
  max-height: 400px;
}

</style>
