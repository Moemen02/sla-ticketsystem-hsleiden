import Vue from 'vue';
import Vuetify from 'vuetify/lib';
import 'material-design-icons-iconfont/dist/material-design-icons.css'

Vue.use(Vuetify);

const vuetify = new Vuetify({
  icons: {
      iconfont: 'md',
  },
  theme: {
      themes: {
          light: {
              primary: '#7986cb',
              secondary: '#7986cb',
              accent: '#7986cb',
              error: '#7986cb',
              warning: '#7986cb',
              info: '#7986cb',
              success: '#7986cb',
              edit: '#7986cb'
          },
      },
  },
})

export default new Vuetify({
  vuetify
});