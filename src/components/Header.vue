<template>
    <el-header type="flex">
        <el-row class="header">
            <img class="logo" src="../assets/logo.png" height="35px"/>
            <el-col :span="4" :offset="18" style="text-align: center">
                <el-dropdown trigger="click" @command="click_item">
                    <span class="avatar"></span>
                    <span style="font-size: 14px; color: #777;">InfiniteXyy</span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command='setting'>个人设置</el-dropdown-item>
                        <el-dropdown-item command='back' divided>退出登录</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-col>
        </el-row>
    </el-header>
</template>

<script>
export default {
  methods: {
    click_item (command) {
      switch (command) {
        case 'setting':
          break
        default:
          this.$router.push({
            path: '/login'
          })
      }
    }
  }
}
</script>

<style>
.header {
  display: flex;
  align-items: center;
  height: 100%;
  width: 100%;
}
.el-header {
  border-bottom: 1px solid rgba(0, 40, 100, 0.06);
}
.avatar {
  width: 2rem;
  height: 2rem;
  background-color: #00a3af;
  display: inline-block;
  vertical-align: bottom;
  border-radius: 50%;
  cursor: pointer;
}
</style>
