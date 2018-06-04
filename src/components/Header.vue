<template>
<el-header>
  <el-menu :default-active="activeIndex" mode="horizontal" :router="true" class="menu">
    <el-menu-item index="explore">浏览</el-menu-item>
    <el-menu-item index="mine">我的</el-menu-item>
    <el-menu-item index="setting">帮助</el-menu-item>
    <div class="menu-wrapper">
      <el-dropdown trigger="click" @command="click_item">
        <div class="avatar"></div>
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item command='setting'>个人设置</el-dropdown-item>
          <el-dropdown-item command='back' divided>退出登录</el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
    <div class="menu-wrapper">
      <el-input v-model="search" placeholder="请输入内容">
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
      activeIndex: 'mine',
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
  background-color: #00a3af;
  display: inline-block;
  vertical-align: bottom;
  border-radius: 50%;
  cursor: pointer;
}

.menu-wrapper {
  margin: 10px 0;
  padding: 0 20px;
  float: right;
  white-space: nowrap;
}
</style>
