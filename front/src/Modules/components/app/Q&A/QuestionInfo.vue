<template>
  <section id="qa-question">
    <b-card no-body>
      <b-card-body>
        <b-row>
          <b-col sm="6">
            <b-input-group class="input-group-merge">
              <b-form-input placeholder="検索" v-model="searchVal"></b-form-input>
              <b-input-group-append>
                <b-button variant="outline-primary" @click="search">
                  <feather-icon icon="SearchIcon"></feather-icon>
                </b-button>
              </b-input-group-append>
            </b-input-group>
          </b-col>
        </b-row>
        <b-row class="mt-2">
          <b-col>
            <div class="qa-question-textarea p-1">
              <b-form-textarea
                id="textarea-default"
                class="mb-1"
                placeholder="質問内容"
                rows="5"
                v-model="newQuestion.content"
              ></b-form-textarea>
              <b-row>
                <b-col lg="7">
                  <b-button-group
                    size="sm"
                  >
                    <b-button 
                      v-for="tag in common_states.tags"
                      :key="'tag' + tag.id"
                      v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                      variant="outline-primary"
                      :class="tag.id === newQuestion.tag_id && 'active'"
                      @click="newQuestion.tag_id = tag.id"
                    >
                      {{tag.tag_name}}
                    </b-button>
                  </b-button-group>
                </b-col>
                <b-col lg="5">
                  <div class="d-flex align-items-center">
                    <feather-icon 
                      :class="['mr-2', 'cursor-pointer', newQuestion.attachment && 'text-danger']" 
                      icon="UploadIcon"
                      @click="onUploadBtnClick"
                    ></feather-icon>
                    <input 
                      ref="uploader"
                      class="d-none"
                      type="file"
                      @change="fileUpload"
                    />
                    <b-form-checkbox
                      v-model="newQuestion.anonymous"
                      class="custom-control-primary"
                    >
                      匿名投稿
                    </b-form-checkbox>
                    <b-button size="sm" class="ml-auto" variant="outline-primary" v-on:click="postQuestion">
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
  </section>
</template>
<script>
import ToastificationContentVue from '@core/components/toastification/ToastificationContent.vue'
import { defineComponent } from '@vue/composition-api'
import {
  BCard, 
  BCardBody, 
  BRow, 
  BCol, 
  BInputGroup, 
  BFormInput, 
  BInputGroupAppend,
  BFormTextarea,
  BButton,
  BButtonGroup,
  BFormCheckbox
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import { mapGetters } from 'vuex'

export default defineComponent({
  components: {
    BCard, 
    BCardBody, 
    BRow, 
    BCol, 
    BInputGroup, 
    BFormInput, 
    BInputGroupAppend,
    BFormTextarea,
    BButton,
    BButtonGroup,
    BFormCheckbox
  },
  directives: {
    Ripple,
  },
  computed: {
    ...mapGetters({
      newQuestion: 'qa/newQuestion',
      common_states: 'common/common_states',
      qaSearchVal: 'qa/qaSearchVal'
    }),
    searchVal: {
      get(){
        return this.qaSearchVal
      },
      set(searchVal){
        this.$store.commit('qa/SET_QA_SEARCHVAL', {searchVal})
      } 
    }
  },
  setup() {
    
  },
  methods: {
    onUploadBtnClick() {
      this.$refs.uploader.click()
    },

    //post question
    postQuestion() {
      if (this.newQuestion.content !== '') {
        this.$swal({
          title: '本当に問題を提示しますか？',
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
            this.$store.dispatch('qa/postQuestion')
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

    // set new question attachment
    fileUpload: function(event) {
      var input = event.target;
      this.newQuestion.attachment=input.files[0];
    },

    //search qa group
    search: function() {
      this.$store.dispatch('qa/searchQAGroup')
    }
  },
})
</script>
<style>
  .qa-question-textarea {
    border: 1px solid #d8d6de;
    border-radius: 00.35rem;
  }
</style>