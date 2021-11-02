<template>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2
                    class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6"
                >
                    Images
                </h2>

                <p
                    class="max-w-screen-md text-gray-500 md:text-lg text-center mx-auto"
                >
                    PaiImage is a photo sharing site with the concept of a place to connect people and photos. For all photo lovers!
                </p>
            </div>
            <!-- text - end -->

            <!-- image - start -->
                <Image :items="images"
                       :getAll="getImages"
                       @likeEvent="likeImage"/>
            <!-- image - end -->

            <!-- pagination -->
              <Pagination :pagination="pagination" 
                          :pages="pages"
                          :getImages="getImages" />
            <!-- /pagination -->
        </div>
    </div>
</template>

<script>
import { ref, toRefs, onMounted, watch } from 'vue'
import Axios from 'axios'
import Image from '../partial/Image.vue'
import Pagination from '../partial/Pagination.vue'

export default {
  components: {
    Image, Pagination 
  },
  props: {
    page: {
      type: Number,
      required: true,
      default: 1
    }
  },
    setup(props, context) {
      const images = ref({})
      const pagination = ref({})
      const pages = ref([])
      const len = ref()
      const { page } = toRefs(props)

      const getImages = async () => {
        await Axios.get('api/images/?page=' + props.page)
                   .then( response => {
                     images.value = response.data.data
                     pagination.value = response.data
                     len.value = pagination.value.last_page
                     if(pages.value.length == 0){
                       createPages(len.value)
                     }
                   })
                   .catch( error => {
                     console.log(error.status)
                   })
      }

      // reload page everytime page value changed
      watch(page, getImages)

      onMounted(() => {
        getImages()
      })

      // create pages 
      const createPages = (len) => {
        for(let i = 1; i <= len; i++){
          pages.value.push(i)
        }
      }

      // like image 
      const likeImage = async (imageId, userId, likedByUser) => {
        if(likedByUser){
           await Axios.delete('/api/images/' + imageId + '/like', {
          user_id: userId
        })
        .then( response => {
          console.log(response.data)
          getImages()
        })
        .catch( error => {
          console.log(error.response.status)
        })
        }else{
          await Axios.put('/api/images/' + imageId + '/like', {
            user_id: userId
          })
          .then( response => {
            console.log(response.data)
            getImages()
          })
          .catch( error => {
            console.log(error.response.status)
          })
        }
      }

      return {
        images, pages, pagination, getImages, likeImage
      }
    }
}
</script>
