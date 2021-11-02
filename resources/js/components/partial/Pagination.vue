<template>
<!-- component -->
<div class="mt-16 px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
	<div>
		<nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
			<li v-if="isPrevExists(pagination.current_page)"
				class="relative inline-flex items-center px-4 py-2 border border-gray-500 bg-gray-200 text-lg text-gray-900 hover:bg-gray-400 cursor-pointer">
                <span @click="goToPrev(pagination.current_page)"><i class="fas fa-angle-double-left"></i></span></li>
			<li v-for="page in pages" :key="page"
				class="relative inline-flex items-center px-4 py-2 border border-gray-500 bg-gray-200 text-lg text-gray-900 hover:bg-gray-400" :class="{ 'bg-blue-300': isActive(pagination.current_page, page) }">
                <router-link :to="`/?page=${page}`">{{ page }}</router-link></li>
      <li v-if="isNextExists(pagination.next_page_url)" class="relative inline-flex items-center px-4 py-2 border border-gray-500 bg-gray-200 text-lg text-gray-900 hover:bg-gray-400 cursor-pointer">
          <span @click="goToNext(pagination.current_page)"><i class="fas fa-angle-double-right"></i></span></li>
		</nav>
	</div>
</div>
</template>

<script>
import { useRouter } from 'vue-router'

export default {
  name: 'Pagination',
  props: {
    pagination: {
      type: Object,
      required: true
    },
    pages: {
      type: Array,
      required: true
    }
  },
  setup() {
    const router = useRouter()

    // check if prev page exists
    const isPrevExists = (num) => {
      return num != 1
    }

    // check if next page exists
    const isNextExists = (url) => {
      return url != null
    }

    // check if current page 
    const isActive = (current, page) => {
      return current == page
    }

    // got to prev page 
    const goToPrev = (page) => {
      router.push('/?page=' + (page - 1))
    }
    
    // got to next page 
    const goToNext = (page) => {
      router.push('/?page=' + (page + 1))
    }
    
    return {
      isPrevExists, isNextExists, isActive, goToPrev, goToNext
    }
  }
}
</script>