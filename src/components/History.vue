<template>
    <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column
        prop="date"
        label="日期"
        width="180">
      </el-table-column>
      <el-table-column
        prop="name"
        label="姓名"
        width="180">
      </el-table-column>
      <el-table-column
        prop="address"
        label="书名">
      </el-table-column>
    </el-table>
  </template>

<script>
export default {
  data () {
    return {
      tableData: [{
        date: '2016-05-02',
        name: '宫斌凯',
        address: '网游之邪龙逆天'
      }, {
        date: '2016-05-04',
        name: '宫斌凯',
        address: '网游之逆天邪神'
      }, {
        date: '2016-05-01',
        name: '宫斌凯',
        address: '网游之天谴修罗'
      }, {
        date: '2016-05-03',
        name: '宫斌凯',
        address: '网游之修罗传说'
      }]
    }
  }
}
</script>

<style>

</style>
