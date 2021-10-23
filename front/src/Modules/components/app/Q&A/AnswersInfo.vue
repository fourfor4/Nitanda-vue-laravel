<template>
  <section id="qa-answers">
    <b-card no-body>
      <b-card-body>
        <app-collapse>
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
  </section>
</template>
<script>
import { defineComponent } from '@vue/composition-api'
import {
  BCard,
  BCardBody,
  BAvatar,
  BMedia,
  BInputGroup,
  BInputGroupAppend,
  BRow,
  BCol,
  BFormInput,
} from 'bootstrap-vue'

import AppCollapse from '@core/components/app-collapse/AppCollapse.vue'
import AppCollapseItem from './AnswerCollapseItem.vue'

export default defineComponent({
  components: {
    BCard,
    BCardBody,
    BAvatar,
    BMedia,
    BInputGroup,
    BInputGroupAppend,
    BRow,
    BCol,
    BFormInput,
    AppCollapse,
    AppCollapseItem,
  },
  setup() {
    
  },
  data() {
    return {
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
})
</script>
<style>
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