<template>
<el-header>
  <el-menu style="height: 60px" :default-active="activeIndex" mode="horizontal" :router="true" class="menu">
    <div class="menu-wrapper" style="float: left; pointer-events: none;">
      <img src="../assets/logo.png" height="40px">
    </div>
    <el-menu-item index="explore">浏览</el-menu-item>
    <el-menu-item index="mine">我的</el-menu-item>
    <el-menu-item index="group">群组</el-menu-item>
    <div class="menu-wrapper" style="float: right">
      <el-dropdown trigger="click" @command="click_item">
        <div class="avatar"></div>
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item command='setting'>个人设置</el-dropdown-item>
          <el-dropdown-item command='back' divided>退出登录</el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
    <div class="menu-wrapper" style="float: right; margin: 16px 0px; padding: 0 0">
      <el-button type="info" icon="el-icon-bell" circle size="mini"></el-button>
    </div>
    <div class="menu-wrapper" style="float: right;">
      <el-input v-model="search" placeholder="Search Animizz">
        <i slot="prefix" class="el-input__icon el-icon-search"></i>
      </el-input>
    </div>
  </el-menu>
</el-header>

</template>

<script>
export default {
  data () {
    return {
      activeIndex: 'explore',
      dialogTableVisible: false,
      search: ''
    }
  },
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
    },
    handleSelect () {

    }
  }
}
</script>

<style scoped>
.menu {
  padding: 0 20px;

}

.avatar {
  width: 40px;
  height: 40px;
  background-size: cover;
  background-position: top center;
  background-image: url(http://www.infinitex.cn/assets/avatar.png);
  display: inline-block;
  border-radius: 50%;
  cursor: pointer;
}
.menu-wrapper {
  margin: 10px 0;
  padding: 0 20px;
  white-space: nowrap;
}

</style>
