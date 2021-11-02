<template>
<div class="grid gap-7 sm:grid-cols-3 sm:gap-5">
  <div v-for="item in items" :key="item" class="relative">
    <div class="group h-56 flex justify-end items-end bg-gray-100 overflow-hidden rounded-lg shadow-lg relative" @mouseover="changeStatus(item.id)">
    <img
        :src="item.imagename" 
        loading="lazy"
        :alt="item.user.name" 
        class="w-full h-full object-cover object-center absolute inset-0 transform group-hover:scale-110 transition duration-200"
    />
    </div>

    <div v-if="checkStatus(item.id)" class="bg-gray-800 bg-opacity-50 absolute top-0 left-0 w-full h-full" @mouseleave="resetStatus(item.id)">
      <span v-if="user" class="mr-8 bg-white absolute p-1 right-5 top-3 rounded cursor-pointer" :class="{ 'bg-red-400 text-white': item.liked_by_user }" @click="$emit('likeEvent', item.id, item.user.id, item.liked_by_user)"><i class="far fa-heart"></i> {{ item.likes.length }}</span>
      <span class="absolute bg-white p-1 px-2 right-3 top-3 rounded cursor-pointer"><i class="fas fa-download"></i></span>
      <router-link :to="{ name: 'detail', params: { id: item.id }}"
        class="inline-block text-gray-200 text-xs md:text-sm border border-gray-500 rounded-lg backdrop-blur px-2 md:px-3 py-1 mr-3 mb-3 absolute left-3 bottom-0"
        >{{ item.user.name }}</router-link>
    </div>
  </div>
</div>
</template>

<script>
import { ref, onMounted } from 'vue'
import Axios from 'axios'

export default {
  name: 'Image',
  props: { 
    items: {
      type: Object,
      default: () => {}
    }
  },
  setup(props, context) {
    const user = ref({})

    let isActives = ref({
      target: String,
      status: false
    })

    const changeStatus = (n) => {
      isActives.value.target = n,
      isActives.value.status = true
    }

    const resetStatus = (n) => {
      isActives.value.target = n,
      isActives.value.status = false
    }

    const checkStatus = (n) => {
      if(isActives.value.target == n && isActives.value.status == true){
        return true
      }
    }

    // get current user 
    const getUser = async () => {
      await Axios.get('/api/user')
                  .then( response => {
                    console.log(response.data)
                    user.value = response.data
                  })
                  .catch( error => {
                    console.log(error.response.status)
                  })
    }

    onMounted(() => {
      getUser()
    })

    // function to pass to ImageList component
    const likeEvent = (imageId, userId) => {
      context.emit('likeImage', imageId, userId)
    }

    return {
      changeStatus, resetStatus, checkStatus, likeEvent, user
    }
  }
}
</script>