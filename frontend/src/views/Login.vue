<template>
<div class="page">
  <div class="container">
    <el-card shadow="hover" :body-style="{ padding: '0px' }" class="card">
      <div slot="header">
        <b>登录您的账号</b>
      </div>
      <el-form :model="account" status-icon style="padding: 14px;" label-position="left">
        <el-form-item label="账号" prop="username">
          <el-input v-model="account.username" auto-complete="off" placeholder="请输入用户名或手机号"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="password">
          <el-input type="password" v-model="account.password" auto-complete="off" placeholder="请输入密码"></el-input>
        </el-form-item>
        <el-form-item>
          <el-checkbox label="记住我" name="type"></el-checkbox>
          <el-button type="primary" style="width:100%" @click="handleLogin">登录</el-button>
        </el-form-item>
      </el-form>
    </el-card>
    <span class="muted-text">还没有账号？
      <router-link to="register">
        <el-button type="text">立即注册</el-button>
      </router-link>
    </span>
  </div>
</div>
</template>
<script>
import http from '../utils/http.js'
import info from '../utils/global.js'

export default {
  data () {
    return {
      account: { username: '13524121679', password: '12345678' },
      alertContent: ''
    }
  },

  methods: {
    handleLogin: async function () {
      const res = await http.get('/user/login', this.account)
      if (res.code !== 200) {
        this.$message.error(res.msg)
      } else {
        info.apiToken = res.data.api_token
        info.uid = res.data.uid
        this.$router.push({
          path: '/animizz/explore'
        })
      }
    }
  }
}
</script>

<style>
.page {
    background-color: #f5f7fb;
    height: 100%;
    display: flex;
    margin: 0;
    padding: 0;
    justify-content: center;
    align-content: center;
}

.card {
    min-width: 350px;
}

.container {
    text-align: left;
    align-self: center;
}

.muted-text {
    color: #b5bac2;
}

</style>
