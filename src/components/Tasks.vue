<template>
<el-row>
  <el-col :span="8" v-for="o in 5" :key="o">
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <span>名称</span>
        <el-dropdown trigger="click" @command="handleCommand">
          <i class="el-dropdown-link el-icon-setting">
          </i>
          <el-dropdown-menu slot="dropdown" >
            <el-dropdown-item command="1">管理列表</el-dropdown-item>
            <el-dropdown-item>设为关注</el-dropdown-item>
            <el-dropdown-item divided>分享</el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
      </div>
      <div v-for="o in 4" :key="o" class="text item">
        {{'列表内容 ' + o }}
      </div>
    </el-card>
    <el-dialog title="收货地址" :visible.sync="dialogTableVisible">
      <el-table :data="gridData">
        <el-table-column property="date" label="日期" width="150"></el-table-column>
        <el-table-column property="name" label="姓名" width="200"></el-table-column>
        <el-table-column property="address" label="地址"></el-table-column>
      </el-table>
    </el-dialog>
  </el-col>
</el-row>

</template>

<script>
export default {
  data () {
    return {
      gridData: [{
        date: '2016-05-02',
        name: '王小虎',
        address: '上海市普陀区金沙江路 1518 弄'
      }, {
        date: '2016-05-04',
        name: '王小虎',
        address: '上海市普陀区金沙江路 1518 弄'
      }, {
        date: '2016-05-01',
        name: '王小虎',
        address: '上海市普陀区金沙江路 1518 弄'
      }, {
        date: '2016-05-03',
        name: '王小虎',
        address: '上海市普陀区金沙江路 1518 弄'
      }],
      dialogTableVisible: false
    }
  },
  methods: {
    handleCommand () {
      this.dialogTableVisible = true
    }
  }
}
</script>

<style>
  .text {
    font-size: 14px;
  }

  .item {
    margin-bottom: 18px;
  }

  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }

  .clearfix:after {
    clear: both
  }

  .box-card {
    margin: 20px
  }

  .el-dropdown-link {
    cursor: pointer;
  }

  .el-icon-arrow-down {
    font-size: 12px;
  }
</style>
