<template>
<div>
  <h1>{{curFavourite.title}}
    <span style="float: right" id="switch" @click="dialogVisible=true">切换</span>
  </h1>
  <el-table :data="curFavourite.favouriteAnimation" :highlight-current-row="true">
    <el-table-column prop="animation.title" label="标题"></el-table-column>
    <el-table-column prop="operation" label="操作">
      <template slot-scope="scope">
        <el-row :gutter="20">
        <el-col :span="6">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">设定</el-button></el-col>
          <el-col :span="6">
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">删除</el-button></el-col>
          </el-row>
      </template>
    </el-table-column>
  </el-table>
  <el-row style="margin-top: 20px" :gutter="24">
    <el-col :span="6"><el-button>设置表信息</el-button></el-col>
  </el-row>
  <el-dialog title="清单" :visible.sync="dialogVisible" width="24%">
    <el-select v-model="tempFavourite" placeholder="请选择">
      <el-option v-for="item in favourList" :key="item.id" :label="item.title" :value="item.title">
      </el-option>
    </el-select>
    <span slot="footer" class="dialog-footer">
      <el-button type="primary" @click="handleSelect">确 定</el-button>
    </span>
  </el-dialog>
</div>
</template>

<script>
import http from '../utils/http.js'
import info from '../utils/global.js'

export default {
  data () {
    return {
      favourList: [],
      curFavourite: {title: '加载中...', favouriteAnimation: []},
      tempFavourite: '',
      dialogVisible: false
    }
  },
  methods: {
    handleSelect () {
      this.dialogVisible = false
      for (let i of this.favourList) {
        if (i.title === this.tempFavourite) {
          this.curFavourite = i
          console.log(this.curFavourite.favouriteAnimation)
          return
        }
      }
    },
    async getList () {
      const res = await http.get('favourite/get', {uid: info.uid})
      this.favourList = res.data
      this.tempFavourite = res.data[0].title
      this.handleSelect()
    }
  },
  mounted () {
    this.getList()
  }
}
</script>
<style scoped>
.left {
  text-align: center;
  width: 100px;
  min-width: 100px;
  margin-right: 20px;
  margin-top: 20px;
}
.el-button {
  width: 100%;
  display: block;
  margin: 10px 2px;
}

#switch {
  color: #409EFF;
  cursor: pointer;
  font-size: 14px;
}

.dialog-footer {
  display: inline-block;
  padding: 20px;
  padding-top: 10px;
  text-align: left;
}
</style>
