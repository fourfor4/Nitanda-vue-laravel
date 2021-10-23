
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default function Toast() {
  const toast = useToast()
  return toast({
    component: ToastificationContent,
    props: {
      title: 'Error fetching users list',
      icon: 'AlertTriangleIcon',
      variant: 'danger',
    },
  })
}