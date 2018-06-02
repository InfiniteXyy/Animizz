<template>
<div class="page">
<div class="container">
  <el-card shadow="hover" :body-style="{ padding: '0px' }" class="card">
    <div slot="header">
      <span>注册</span>
    </div>
    <el-form :model="account" status-icon :rules="rules" style="padding: 14px;" label-position="left">
      <el-form-item label="账号" prop="email">
        <el-input v-model="account.email" auto-complete="off" placeholder="请输入邮箱"></el-input>
      </el-form-item>
      <el-form-item label="密码" prop="password">
        <el-input type="password" v-model="account.password" auto-complete="off" placeholder="请输入密码"></el-input>
      </el-form-item>
      <el-form-item label="重新输入密码" prop="password2">
        <el-input type="password" v-model="account.password2" auto-complete="off" placeholder="重新输入密码"></el-input>
      </el-form-item>
      <el-form-item>
        <el-checkbox label="同意所有条款" name="type"></el-checkbox>
        <el-button type="success" disabled style="width:100%" @click="handleLogin">注册</el-button>
      </el-form-item>
    </el-form>
  </el-card>
  <span class="muted-text">已经有账号了？
    <router-link to="login">
      <el-button type="text">登录</el-button>
    </router-link>
  </span>
</div>
</div>
</template>
<script>
export default {
  data () {
    var validateEmail = (rule, value, callback) => {
      if (value === '') callback(new Error('请输入邮箱'))
      if (value.split('@').length === 2) callback()
      else callback(new Error('请输入正确的邮箱'))
    }
    return {
      account: { email: '', password: '' },
      rules: { email: [{ validator: validateEmail, trigger: 'blur' }] }
    }
  },

  methods: {
    handleLogin () {
      this.$router.push({ path: '/animizz/mine' })
    }
  }
}
</script>

<style>
.container {
    text-align: left;
    align-self: center;
}

.card {
  width: 350px;
}

.muted-text {
  color: #b5bac2;
}

</style>
