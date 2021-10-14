<template>
  <section id="wbc-qa-list">
    <b-row>
      <b-col>
        <b-card no-body>
          <b-card-body>
            <b-row>
              <b-col offset-md="8">
                <b-input-group class="input-group-merge">
                  <b-form-input placeholder="検索" />
                  <b-input-group-append is-text>
                    <feather-icon icon="SearchIcon" />
                  </b-input-group-append>
                </b-input-group>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="12">
                <b-card no-body>
                  <b-card-body>
                    <b-tabs>
                      <b-tab 
                        active
                        title="最新の解決"
                      >
                        <div class="pt-1 pb-1">
                          <b-button-group>
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
                          <p class="describe mt-1 mb-1">こんな質問してみました。</p>
                          <p class="pl-1 reply mb-1">ベストアンサー：こんな質問にこんな回答をしてみました。</p>
                          <p class="mb-1">
                            <feather-icon icon="MailIcon" class="mr-2"></feather-icon>
                            <span class="mr-2">5</span>
                            <span class="mr-2">2021/09/26</span>
                            <span class="mr-2">09/35</span>
                          </p>
                        </div>
                        <hr/>
                        <div class="pt-1 pb-1">
                          <b-button-group>
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
                          <p class="describe mt-1 mb-1">こんな質問してみました。</p>
                          <p class="pl-1 reply mb-1">ベストアンサー：こんな質問にこんな回答をしてみました。</p>
                          <p class="mb-1">
                            <feather-icon icon="MailIcon" class="mr-2"></feather-icon>
                            <span class="mr-2">5</span>
                            <span class="mr-2">2021/09/26</span>
                            <span class="mr-2">09/35</span>
                          </p>
                        </div>
                        <hr/>
                        <div class="pt-1 pb-1">
                          <b-button-group>
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
                          <p class="describe mt-1 mb-1">こんな質問してみました。</p>
                          <p class="pl-1 reply mb-1">ベストアンサー：こんな質問にこんな回答をしてみました。</p>
                          <p class="mb-1">
                            <feather-icon icon="MailIcon" class="mr-2"></feather-icon>
                            <span class="mr-2">5</span>
                            <span class="mr-2">2021/09/26</span>
                            <span class="mr-2">09/35</span>
                          </p>
                        </div>
                        <hr/>
                        <div class="pt-1 pb-1">
                          <b-button-group>
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
                          <p class="describe mt-1 mb-1">こんな質問してみました。</p>
                          <p class="pl-1 reply mb-1">ベストアンサー：こんな質問にこんな回答をしてみました。</p>
                          <p class="mb-1">
                            <feather-icon icon="MailIcon" class="mr-2"></feather-icon>
                            <span class="mr-2">5</span>
                            <span class="mr-2">2021/09/26</span>
                            <span class="mr-2">09/35</span>
                          </p>
                        </div>
                      </b-tab>
                      <b-tab
                        title="回答募集中"
                      ></b-tab>
                    </b-tabs>
                  </b-card-body>
                </b-card>
              </b-col>
            </b-row>
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
  BTab
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'


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
    BTab
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      data: {},
    }
  },
  created() {

  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/chart-apex.scss';
.describe {
  color: #0b60af;
}
.reply {
  color: #454447;
}
</style>
