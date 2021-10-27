<template>
  <b-media
    :answer="answer"
  >
    <template #aside>
      <b-avatar 
        :src="answer.user.avatar_url && appConfig.serverUrl + answer.user.avatar_url"
        size="lg"
      />
    </template>
    <b-row>
      <b-col md="4" class="fav_color">
        {{answer.user.employee_name}}
      </b-col>
      <b-col md="4" class="text-center">
        {{answer.updated_at | timePipe}}
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <p style="white-space: pre-line">{{answer.content}}</p>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <div class="d-flex align-items-center">
          <span class="mr-2">スコア ( {{answer.score}} )</span>
          <span class="mr-2" v-if="isBest()">💛ベストアンサー</span>
          <span class="ml-auto"></span>
          <a :href="appConfig.serverUrl + answer.attachment" target="blank" download>
            <feather-icon 
              icon="DownloadIcon"
              :class="['cursor-pointer', 'ml-2', 'text-info']"
              size="18"
              v-if="answer.attachment"
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
            @click="follow(answer.id, 1, 2)"
          ></feather-icon>
          <feather-icon 
            icon="ThumbsDownIcon"
            :class="['cursor-pointer', 'ml-2', 'text-danger']"
            size="18"
            @click="follow(answer.id, -1, 2)"
          ></feather-icon>
        </div>
      </b-col>
    </b-row>
  </b-media>
</template>
<script>
import appConfig from '@/appConfig'
import { defineComponent } from '@vue/composition-api'
import {
  BMedia,
  BAvatar,
  BRow,
  BCol
} from 'bootstrap-vue'
import moment from 'moment'
import { mapGetters } from 'vuex'

export default defineComponent({
  props: ['answer', 'question_id'],
  components: {
    BMedia,
    BAvatar,
    BRow,
    BCol
  },
  data() {
    return {
      appConfig: appConfig
    }
  },
  setup() {
    
  },
  computed: {
    ...mapGetters({
      qaGroups: 'qa/qaGroups'
    }),
  },
  filters: {
    timePipe: function(value) {
      return moment(value).format('YYYY/MM/DD h:mm:ss')
    },
  },
  methods: {

    // detect the best answer
    isBest() {
      var qaGroup = this.qaGroups.filter(item => item.id == this.question_id)[0]
      if (parseInt(this.answer.score) == Math.max.apply(Math, qaGroup.answer.map(item => parseInt(item.score)))) {
        return true
      } else {
        return false
      }
    },

    // like and dislike the answer
    follow: function(follow_id, type, category) {
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
            question_id: this.question_id
          })
        }
      })
    },
  }
})
</script>
