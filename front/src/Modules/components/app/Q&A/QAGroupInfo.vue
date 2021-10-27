<template>
  <section id="qa-groups">
    <b-card no-body>
      <b-card-body>
        <p v-if="qaGroups.length === 0" class="text-center mb-0">no questions</p>
        <app-collapse>
          <app-collapse-item 
            v-for="(qaGroup, qaGroupIdx) in qaGroups"
            v-bind:key="qaGroupIdx + '-' + qaGroup.id + '-qaGroup'"
            v-bind:title="qaGroup.created_at | titleTimePipe"
            class="qa-group"
          >
          <div class="qa-group-container">
            <b-avatar
              class="q_user_avatar"
              :src="qaGroup.user.avatar_url && appConfig.serverUrl + qaGroup.user.avatar_url"
              size="lg"
            />
            <div class="qa_group_content">
              <div class="d-flex justify-content-between">
                <div class="d-flex flex-column align-items-start">
                  <span v-if="qaGroup.anonymous" class="user fav_color">社員</span>
                  <span v-if="!qaGroup.anonymous" class="user fav_color">{{qaGroup.user.employee_name}}</span>
                  <p style="white-space: pre-line">{{qaGroup.content}}</p>
                </div>
                <div class="right_header">
                  <span class="time">{{qaGroup.created_at | agoTimePipe}}</span>
                </div>
              </div>
              <hr>
              <div class="flex row justify-content-between mb-1">
                <div class="col-md-4 d-flex justify-content-between">
                  <span class="score">スコア ( {{qaGroup.score}} )</span>
                  <span v-if="qaGroup.answer.length > 5" :class="['cursor-pointer']" @click="showAll(qaGroup.id)">すべてコメントを見る ( {{qaGroup.answer.length}} )</span>
                </div>
                <div class="d-flex col-md-4 align-items-center">
                  <span class="ml-auto"></span>
                  <b-badge v-if="qaGroup.tag_relation" class="ml-2" variant="primary">
                    {{common_states.tags.filter(item => item.id == qaGroup.tag_relation.tag_id)[0].tag_name}}
                  </b-badge>
                  <a :href="appConfig.serverUrl + qaGroup.attachment" target="blank" download>
                    <feather-icon 
                      icon="DownloadIcon"
                      :class="['cursor-pointer', 'ml-2', 'text-info']"
                      size="18"
                      v-if="qaGroup.attachment"
                    ></feather-icon>  
                  </a>
                  <!-- <feather-icon 
                    icon="StarIcon"
                    :class="['cursor-pointer', 'ml-2', 'text-warning']"
                    size="18"
                  ></feather-icon> -->
                  <feather-icon 
                    icon="ThumbsUpIcon"
                    :class="['cursor-pointer', 'ml-2', 'text-success']"
                    size="18"
                    @click="follow(qaGroup.id, 1, 1, qaGroup.id)"
                  ></feather-icon>
                  <feather-icon 
                    icon="ThumbsDownIcon"
                    :class="['cursor-pointer', 'ml-2', 'text-danger']"
                    size="18"
                    @click="follow(qaGroup.id, -1, 1, qaGroup.id)"
                  ></feather-icon>
                </div>
              </div>
              <div class="answers-container">
                <div class="media-list media-bordered">
                  <answer-info 
                    v-for="(answer,answerIdx) in qaGroup.showAll ? qaGroup.answer : qaGroup.answer.slice(0,5)"
                    v-bind:key="answerIdx + '-' + answer.id + '-answer'"
                    :answer="answer"
                    :question_id="qaGroup.id"
                  />
                </div>
                <b-input-group class="input-group-merge mt-1 mb-1">
                  <b-form-textarea
                    id="textarea-default"
                    placeholder="質問内容"
                    rows="5"
                    v-model="answers[qaGroup.id].content"
                  ></b-form-textarea>
                  <b-input-group-append is-text>
                    <feather-icon
                      icon="UploadIcon"
                      :class="['cursor-pointer', answers[qaGroup.id].attachment && 'text-danger']"
                      v-on:click="attachmentFile(qaGroupIdx)"
                    ></feather-icon>
                    <input type="file" ref="attachment" @change="setAttachment($event, qaGroup.id)" hidden/>
                  </b-input-group-append>
                  <b-input-group-append is-text>
                    <b-button variant="outline-primary" size="sm" @click="postAnswer(qaGroup.id)">答え</b-button>
                  </b-input-group-append>
                </b-input-group>
              </div>
            </div>
          </div>
          </app-collapse-item>
          <div class="text-center mt-1 mb-0">
            <b-button
              variant="primary"
              @click="loadMore"
              v-if="totalCount > 5 && qaGroups.length < totalCount"
            >
              もっと見る
            </b-button>
          </div>
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
  BButton,
  BFormTextarea,
  BBadge
} from 'bootstrap-vue'

import AppCollapse from '@core/components/app-collapse/AppCollapse.vue'
import AppCollapseItem from './QAGroupCollapseItem.vue'
import AnswerInfo from './AnswerInfo.vue'
import { mapGetters } from 'vuex'
import moment from 'moment'
import ToastificationContentVue from '@/@core/components/toastification/ToastificationContent.vue'
import appConfig from '@/appConfig'
import axios from 'axios'

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
    BFormTextarea,
    BButton,
    AppCollapse,
    AppCollapseItem,
    AnswerInfo,
    BBadge
  },
  computed: {
    ...mapGetters({
      qaGroups: 'qa/qaGroups',
      answers: 'qa/answers',
      searchVal: 'qa/qaSearchVal',
      totalCount: 'qa/totalCount',
      common_states: 'common/common_states',
    }),
  },
  setup() {
    
  },
  data() {
    return {
      opinion: null,
      appConfig: appConfig
    }
  },
  methods: {
    attachmentFile(id) {
      this.$refs.attachment[id].click()
    },
    setAttachment: function(event, id) {
      var input = event.target;
      this.answers[id].attachment=input.files[0];
    },

    //show all answers
    showAll: function(qaGroupId) {
      this.qaGroups.forEach(item => {
        if (item.id == qaGroupId) {
          item.showAll = true
        }
      });
    },

    //filter question and answer groups
    filterQAGroup: function() {
      if (this.searchVal == '') {
        return this.qaGroups
      } else {
        var searchGroup = this.searchVal.split(' ').filter(item => item != '')
        return this.qaGroups.filter(item => {
          var posibilityGroup = searchGroup.map(sItem => {
            return item.content.indexOf(sItem) > -1
          })
          if (posibilityGroup.reduce((sum, next) => sum && next, true)) {
            return item
          }
        })
      }
    },

    //post answer
    postAnswer: function(id) {
      if (this.answers[id].content !== '') {
        this.$swal({
          title: 'Are you sure?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'はい、そうです。',
          cancelButtonText: 'いいえ。',
          customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1',
          },
          buttonsStyling: false,
        }).then(result => {
          if (result.value) {
            this.$store.dispatch('qa/postAnswer', {
              answer: this.answers[id],
              question_id: id
            })
          }
        })
      } else {
        this.$toast({
          component: ToastificationContentVue,
          position: 'top-right',
          props: {
            title: `内容を入力してください。`,
            icon: 'CoffeeIcon',
            variant: 'danger',
          },
        })
      }
    },

    //follow question and answer
    follow: function(follow_id, type, category, question_id) {
      this.$swal({
        title: 'Are you sure?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: type === 1 ? `Follow this ${category === 1 ? 'question' : 'answer'}!` : `Unfollow this ${category === 1 ? 'question' : 'answer'}!`,
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.value) {
          this.$store.dispatch('qa/follow', {
            follow_id: follow_id,
            type: type,
            category: category,
            question_id: question_id
          })
        }
      })
    },

    //load more
    loadMore: function() {
      this.$store.dispatch('qa/retrieveQAGroup')
    },

  },
  filters: {
    // qa group title time pipe
    titleTimePipe: function(value) {
      return moment(value).format('YYYY/MM/DD h:mm:ss')
    },

    // question time diff from now
    agoTimePipe: function(value) {
      var nowTime = moment(new Date())
      var created_at = moment(value)
      var diffTime = nowTime.diff(created_at)
      var days = moment.duration(diffTime).days() 
      var hours = moment.duration(diffTime).hours() 
      var mins = moment.duration(diffTime).minutes() 
      var secs = moment.duration(diffTime).seconds() 
      return (days > 0 ? days + 'day ' : '') + (hours > 0 ? hours + 'h ' : '') + (mins > 0 ? mins + 'm ' : '') + (secs > 0 ? secs + 's ' : '') + 'ago'
    }
  },
  mounted() {
    // retrieve init qa group data
    this.$store.dispatch('qa/searchQAGroup')
    
    //socket listen qa notification
    Echo.private('qa.notification').listen('QACreated',(payload) => {
      console.log(payload)
      var user = payload.qaNotification.user
      if (payload.qaNotification.category == 1) {

        this.$toast({
          component: ToastificationContentVue,
          position: 'top-right',
          props: {
            title: `「${user.employee_name}」 が質問をしました。`,
            icon: 'CoffeeIcon',
            variant: 'success',
          },
        })

        var searchGroup = this.searchVal.split(' ').filter(item => item != '')

        var posibilityGroup = searchGroup.map(sItem => {
          return payload.qaNotification.question.content.indexOf(sItem) > -1
        })

        if (posibilityGroup.reduce((sum, next) => sum && next, true)) {
          console.log('filtered')
          var newQuestion = [payload.qaNotification.question]
          this.qaGroups.forEach(item => {
            newQuestion.push(item)
          })
          this.$store.commit('qa/SET_QA_GROUP',{ qaGroups: newQuestion })
          this.answers[payload.qaNotification.question.id] = {content: '', attachment:null}
        }

      } else if (payload.qaNotification.category == 2) {

        this.$toast({
          component: ToastificationContentVue,
          position: 'top-right',
          props: {
            title: `「${user.employee_name}」 が答えた。`,
            icon: 'CoffeeIcon',
            variant: 'success',
          },
        })

        var question_id = payload.qaNotification.answer.question_id
        var newAnswer = payload.qaNotification.answer
        this.qaGroups.forEach(item => {
          if (item.id == question_id) {
            item.answer = [newAnswer, ...item.answer]
          }
        })
      }
    })

  },
  destroyed() {
    Echo.leave('qa.notification')
  }
})
</script>
<style>
.qa-group div.qa-group-container{
  position: relative;
  margin-left: 30px;
  margin-top: 15px;
  padding-left: 30px;
}
.qa-group div.qa-group-container::after{
  width: 1px;
  height: 100%;
  background: linear-gradient(#605f62, transparent);
  left: -6px;
  position: absolute;
  content: "";
  top: 30px;
}
.qa-group div.qa-group-container span.q_user_avatar{
  position: absolute;
  left: -30px;
  top: -15px;
  z-index: 10;
}
.qa-group div.collapse-title{
  width: 100%;
  display: block;
}
.qa-group div.qa-group-container .fav_color{
  color: rgb(0, 131, 218);
}
.qa-group div.qa-group-container .answers-container{
  overflow: auto;
  /* max-height: 400px; */
}

</style>