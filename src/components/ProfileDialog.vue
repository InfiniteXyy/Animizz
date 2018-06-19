<template>
<el-form ref="form" :model="form" label-width="120px">
  <el-form-item label="用户名">
    <el-input :disabled="true" v-model="form.username"></el-input>
  </el-form-item>
  <el-form-item label="手机">
    <el-input :disabled="true" v-model="form.phone"></el-input>
  </el-form-item>
  <el-form-item label="status">
    <el-input v-model="form.status"></el-input>
  </el-form-item>
  <el-form-item label="头像">

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
      },
      imageUrl: ''
    }
  },
  mounted () {
    console.log(info.profile)
  },
  methods: {
    handleAvatarSuccess (res, file) {
      this.imageUrl = URL.createObjectURL(file.raw)
      alert(this.imageUrl)
    },
    beforeAvatarUpload (file) {
      const isJPG = file.type === 'image/jpeg'
      const isLt2M = file.size / 1024 / 1024 < 2

      if (!isJPG) {
        this.$message.error('上传头像图片只能是 JPG 格式!')
      }
      if (!isLt2M) {
        this.$message.error('上传头像图片大小不能超过 2MB!')
      }
      return isJPG && isLt2M
    }
  }
}
</script>

<style scoped>
.el-form-item {
  max-width: 80%;
}
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>
