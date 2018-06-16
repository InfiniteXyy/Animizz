<template>
<div>
  <el-input type="textarea" :rows="4" placeholder="请输入内容" v-model="textarea">
  </el-input>
  <el-button class="button" size="mini" @click="handleSend">发送</el-button>
  <div id="momentList">
    <moment v-for="i in moments" :key="i.time.toLocaleTimeString()" :data='i'></moment>
  </div>

</div>
</template>

<script>
import moment from './MomentItem.vue'

export default {
  data () {
    return {
      textarea: '',
      moments: []
    }
  },
  methods: {
    handleSend () {
      this.moments.unshift({
        content: this.textarea,
        time: new Date()
      })
      this.textarea = ''
    }
  },
  components: {
    moment
  }
}
</script>

<style scoped>
.button {
  margin-top: 20px;
}
#momentList {
  margin-top: 80px;
}
</style>
