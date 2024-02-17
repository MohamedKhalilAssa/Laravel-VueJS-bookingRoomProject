import { createStore } from 'vuex'

export default createStore({
  state: {
    authentication: false,
    user: null
  },
  getters: {
    getAuthentication (state) {
      return state.authentication
    },
    getUser (state) {
      return state.user
    }
  },
  mutations: {
    setAuthentication (state) {
      if(localStorage.getItem('Authentication')){
        console.log('localStorage')
        state.authentication = localStorage.getItem('Authentication') 
      }
      else{
        console.log('false')

        state.authentication = false
      }
    },
    setUser (state) {
      if(localStorage.getItem('User'))
        state.user = localStorage.getItem('User')
      else
        state.user = null
    }
  },
  actions: {
  },
  modules: {
  }
})
