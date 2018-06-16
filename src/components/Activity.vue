<template>
<div>
  <el-input type="textarea" :rows="4" placeholder="请输入内容" v-model="textarea">
  </el-input>
  <el-button class="button" size="mini" @click="handleSend">发送</el-button>
</div>
</template>

<script>
export default {
  data () {
    return {
      textarea: ''
    }
  },
  methods: {
    handleSend () {
      this.textarea = ''
    }
  }
}
</script>

<style scoped>
.button {
  margin-top: 20px;
}
</style>
