<template>
  <section id="qa">
    <qa-question></qa-question>
    <q-a-group></q-a-group>
  </section>
</template>
<script>
import { defineComponent } from '@vue/composition-api'
import QAGroup from '@/Modules/components/app/Q&A/QAGroupInfo.vue'
import QaQuestion from "@/Modules/components/app/Q&A/QuestionInfo.vue"
import jsCookie from 'js-cookie'

export default defineComponent({
  components: {
    QaQuestion,
    QAGroup
  },
  setup() {
    
  },
  mounted() {
    
  },
  destroyed() {
    Echo.leave('question.created')
  },
  methods: {
    submit() {
      axios.post('http://localhost:8000/api/question',{
        user_id: 3,
        content: 'uhh'
      }, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      } ).then(res => {
        console.log(res)
      })
    }
  }
})
</script>
