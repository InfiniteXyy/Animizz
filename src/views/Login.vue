<template>
<div class="page">
    <div class="container">
        <el-card shadow="hover" :body-style="{ padding: '0px' }" class="card">
            <div slot="header">
                <b>登录您的账号</b>
            </div>
            <el-form :model="account" status-icon :rules="rules" style="padding: 14px;" label-position="left">
                <el-form-item label="账号" prop="email">
                    <el-input v-model="account.email" auto-complete="off" placeholder="请输入邮箱"></el-input>
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
      this.$router.push({ path: '/animizz/explore' })
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
