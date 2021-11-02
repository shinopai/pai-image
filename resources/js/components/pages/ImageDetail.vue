<template>
  <div class="w-full p-3 mt-5">
    <div class="flex flex-col lg:flex-row rounded h-auto border shadow shadow-lg">
      <figure class="w-full lg:w-2/3">
        <img class="block h-auto w-full" :src="image.imagename">
        <figcaption class="m-2">Posted by {{ image.user.name }}</figcaption>
      </figure>
      <div class="w-full lg:w-1/3 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-7 pl-4 flex flex-col justify-between leading-normal">
        <div class="text-black text-lg mb-2 leading-tight"><span v-if="user" class="mr-5 border-2 p-1 bg-white rounded cursor-pointer" :class="{ 'bg-red-400 text-white': image.liked_by_user }" @click="likeImage(image.id, user.id, image.liked_by_user)"><i class="far fa-heart"></i> {{ image.likes.length }}</span>
      <span class="border-2 p-1 px-2 rounded cursor-pointer"><i class="fas fa-download"></i> Download</span>
      <h1 class="mt-5 font-bold text-lg"><i class="fas fa-comments"></i> Comments</h1>
      <ul class="mt-3">
        <li v-if="!isCommentExists">
          <p>No comment yet.</p>
        </li>
        <li v-for="comment in image.comments" :key="comment" class="mt-3 pb-2 border-b-2">
          <p>{{ comment.content }}</p>
          <p class="mt-5">{{ user.name }}</p>
        </li>
      </ul>
</div>
        <p v-if="user" class="mt-5 text-grey-darker text-base">
          <textarea class="border-2 p-2" cols="32" rows="5" style="resize: none;" v-model="content"></textarea>
          <button type="button" class="bg-yellow-500 hover:bg-yellow-700 text-white p-2 rounded block sm:ml-auto mt-2" @click="storeComment(image.id, user.id)">submit comment</button>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, toRefs, onMounted, watch } from 'vue'
import Axios from 'axios'

export default {
  props: {
    id: {
      type: String,
      required: true
    }
  },
  setup(props) {
    const image = ref({})
    const content = ref('')
    const user = ref({})
    const { id } = toRefs(props)
    let isCommentExists = ref(false)
    
    // get image detail 
    const getImage = async () => {
      await Axios.get('/api/images/' + props.id)
                 .then( response => {
                   image.value = response.data
                   isCommentExists.value = image.value.comments.length > 0
                 })
                 .catch( error => {
                   console.log(error.response.status)
                 })
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
      getImage()
      getUser()
    })

    // store comment 
    const storeComment = async (imageId, userId) => {
      await Axios.post('/api/images/' + imageId + '/comments', {
        content: content.value,
        user_id: userId
      })
      .then( response => {
        content.value = ''
        getImage()
      })
      .catch( error => {
        console.log(error.response.status)
      })
    }
    
    // page reload when created
    getImage()
    
    // reload page everytime page value changed
    watch(id, getImage)

    // like image 
    const likeImage = async (imageId, userId, likedByUser) => {
      if(likedByUser){
          await Axios.delete('/api/images/' + imageId + '/like')
      .then( response => {
        getImage()
      })
      .catch( error => {
        console.log(error.response.status)
      })
      }else{
        await Axios.put('/api/images/' + imageId + '/like', {
          user_id: userId
        })
        .then( response => {
          getImage()
        })
        .catch( error => {
          console.log(error.response.status)
        })
      }
    }

    return {
      image, content, user, storeComment, isCommentExists, likeImage
    }
  }
}
</script>
