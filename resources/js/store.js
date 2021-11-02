import { createStore } from 'vuex'
import Axios from 'axios'

const store = createStore({
  state () {
    return {
      user: null,
      test: 'tigers'
    }
  },
  getters: {
    isUserExists (state) {
      return state.user != null
    },
    user (state) {
      return state.user
    }
  },
  mutations: {
    setUser(state, resUser) {
      state.user = resUser
    }
  },
  actions: {
    // get current user 
    async getUser (context) {
      await Axios.get('/api/user')
                  .then( response => {
                    context.commit('setUser', response.data)
                  })
    }    
  }
})

export default store