<template>
  <section id="qa-question">
    <b-card no-body>
      <b-card-body>
        <b-row>
          <b-col sm="6">
            <b-input-group class="input-group-merge">
              <b-form-input placeholder="検索"></b-form-input>
              <b-input-group-append is-text>
                <feather-icon icon="SearchIcon"></feather-icon>
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
              ></b-form-textarea>
              <b-row>
                <b-col lg="7">
                  <b-button-group
                    size="sm"
                  >
                    <b-button
                      v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                      variant="outline-primary"
                      :class="'active'"
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
                      class="mr-2 cursor-pointer" 
                      icon="UploadIcon"
                      @click="onUploadBtnClick"
                    ></feather-icon>
                    <input 
                      ref="uploader"
                      class="d-none"
                      type="file"
                    />
                    <b-form-checkbox
                      :value="true"
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
  </section>
</template>
<script>
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
  setup() {
    
  },
  methods: {
    onUploadBtnClick() {
      this.$refs.uploader.click()
    },
    attachmentFile(id) {
      this.$refs.attachment[id].click()
    },
  },
})
</script>
<style>
  .qa-question-textarea {
    border: 1px solid #d8d6de;
    border-radius: 00.35rem;
  }
</style>