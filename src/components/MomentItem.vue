<template>
<div class="moment">
  <div class="wrapper">
    <div class="avatar">
    </div>
    <div class="content">
      {{data.content}}
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['data']
}
</script>

<style scoped>
.moment {
  width: 100%;
  margin-bottom: 20px;
  border-bottom: 2px solid #f5f7fb;
}
.avatar {
  width: 40px;
  height: 40px;
  margin: 20px;
  background-size: cover;
  background-position: top center;
  background-image: url(http://www.infinitex.cn/assets/avatar.png);
  display: inline-block;
  border-radius: 50%;
}
.content {
  margin-top: 30px;
  width: 100%;
}
</style>
