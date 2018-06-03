<template>
  <el-aside>
    <el-menu default-active="2" class="sidebar">
      <el-submenu index="1">
        <template slot="title">
          <i class="el-icon-menu"></i>
          <span>热点</span>
        </template>
        <el-menu-item-group title="动漫">
          <router-link to="animes">
            <el-menu-item index="1-1">今日番剧</el-menu-item>
          </router-link>
          <router-link to="timeline">
            <el-menu-item index="1-2">新番表</el-menu-item>
          </router-link>
        </el-menu-item-group>
        <el-menu-item-group title="影视">
          <router-link to="movies">
            <el-menu-item index="1-3">电影</el-menu-item>
          </router-link>
        </el-menu-item-group>
      </el-submenu>
      <router-link to="mine">
        <el-menu-item index="2">
          <i class="el-icon-location"></i>
          <span slot="title">我的</span>
        </el-menu-item>
      </router-link>
      <router-link to="explore">
        <el-menu-item index="3">
          <i class="el-icon-view"></i>
          <span slot="title">发现</span>
        </el-menu-item>
      </router-link>
    </el-menu>
  </el-aside>
</template>

<script>
export default {

}
</script>
<style scoped>
.sidebar {
  border-right: 0px;
}

a {
  text-decoration: none;
}
</style>
