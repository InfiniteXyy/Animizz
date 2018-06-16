<template>
<div class="wrapper">
    <div class="middle">
        <tasks></tasks>
    </div>
    <div class="right">
        <h1>这里应该放一个索引</h1>
    </div>
</div>
</template>

<script>
import tasks from '@/components/Tasks.vue'

export default {
  components: {
    tasks
  }
}
</script>
<style scoped>
.middle{
    width: 100%;
}

</style>
