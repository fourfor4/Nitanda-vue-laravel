<template>
  <section id="qa">
    <qa-question></qa-question>
    <qa-answers></qa-answers>
  </section>
</template>
<script>
import { defineComponent } from '@vue/composition-api'
import QaAnswers from '@/Modules/components/app/Q&A/AnswersInfo.vue'
import QaQuestion from "@/Modules/components/app/Q&A/QuestionInfo.vue"
import jsCookie from 'js-cookie'

export default defineComponent({
  components: {
    QaQuestion,
    QaAnswers
  },
  setup() {
    
  },
  mounted() {

    console.log(Echo)
    Echo.private('question.created').listen('QuestionCreated',(payload) => {
      console.log('QuestionCreated', payload)
    }).listen('MessageCreated',(payload) => {
      console.log('MessageCreated', payload)
    })
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
