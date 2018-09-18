// wqNovel/bookManage/bookManage.js
const app = getApp()
const util = require('../../utils/js/util.js')
Page({

  /**
   * 页面的初始数据
   */
  data: {
    dataList: [], //数据列表
    totalpage: 0, //总页数
    currentpage: 0, //当前页码
    autoid: 0, //当前自动编号
    fileName: 'ims_we7_wxapp_books', //表名
    totalBook: 0,
    buttonSelectText: "全选",
    selectItem_auto_id: []//选择的自动编号
  }

  ,
  onDel: function (e) {
    try {
      if (this.data.selectItem_auto_id.length == 0) {//判断可用删除
        app.util.message({
          title: '没有选择删除'
        })
        return
      }
      var that = this
      app.util.request({//删除书籍
        url: 'entry/wxapp/DelBooks',
        data: {
          books_auto_id: this.data.selectItem_auto_id
        },
        success: function (e) {
          try {
            // console.log(e.data)
            that.setData({//清空所有数据
              dataList: [], //数据列表
              totalpage: 0, //总页数
              currentpage: 0, //当前页码
              autoid: 0, //当前自动编号
              fileName: 'ims_we7_wxapp_books', //表名
              totalBook: 0,
              buttonSelectText: "全选",
              selectItem_auto_id: []//选择的自动编号
            })
            util.getTotalPage(that, 'BookTotalRecord')//刷新页面
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error('onDel')
      console.error(e)
    }
  }
  ,

  onSelectAll: function (e) {
    try {
      this.data.selectItem_auto_id = [];//先清空
      //处理
      if (this.data.buttonSelectText == "全选") {
        for (var i = 0; i < this.data.dataList.length; i++) {
          this.data.dataList[i].checked = true;
          this.data.selectItem_auto_id.push(this.data.dataList[i])
        }
        this.data.buttonSelectText = "反全选"
      } else {
        for (var i = 0; i < this.data.dataList.length; i++) {
          this.data.dataList[i].checked = false;
        }
        this.data.buttonSelectText = "全选"
      }
      //处理

      this.setData({ //界面
        dataList: this.data.dataList,
        buttonSelectText: this.data.buttonSelectText
      })
    } catch (e) {
      console.error('onSelectAll')
      console.error(e)
    }
  }
  ,
  checkboxChange: function (e) {
    try {
      // console.log(e.detail.value)
      this.data.selectItem_auto_id = []//清空
      this.data.selectItem_auto_id = e.detail.value//再保存

    } catch (e) {
      console.error('checkboxChange')
      console.error(e)
    }
  }
  ,
  refreshMyself: function () {
    try {
      this.setData({
        dataList: this.data.dataList, //数据列表
        totalpage: this.data.totalpage, //总页数
        currentpage: this.data.currentpage, //当前页码
        autoid: this.data.autoid, //当前自动编号
        fileName: this.data.fileName, //请求地址
        totalBook: this.data.totalBook,
        buttonSelectText: this.data.buttonSelectText
      })
    } catch (e) {
      console.error('refreshMyself')
      console.error(e)
    }
  }
  ,


  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    try {


      wx.setNavigationBarTitle({
        title: '管理书架',
      })

      var that = this
      util.getTotalPage(that, 'BookTotalRecord')

    } catch (e) {
      console.error('onload')
      console.error(e)
    }
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
    util.getTotalPage(this, 'BookTotalRecord')
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})