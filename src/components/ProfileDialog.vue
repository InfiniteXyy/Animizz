<template>
  <el-form ref="form" :model="form" label-width="120px">
    <el-form-item label="用户名">
      <el-input v-model="form.username"></el-input>
    </el-form-item>
    <el-form-item label="手机">
      <el-input v-model="form.phone"></el-input>
    </el-form-item>
    <el-form-item label="status">
      <el-input v-model="form.status"></el-input>
    </el-form-item>
  </el-form>
</template>

<script>
import info from '../utils/global.js'
export default {
  data () {
    return {
      form: {
        username: info.profile.username,
        status: info.profile.status,
        phone: info.profile.phone
      }
    }
  },
  mounted () {
    console.log(info.profile)
  }
}
</script>

<style scoped>
.el-form-item {
  max-width: 80%;
}
</style>
