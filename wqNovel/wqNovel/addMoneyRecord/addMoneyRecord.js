// wqNovel/addMoneyRecord/addMoneyRecord.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    dataList: [], //数据列表
    totalpage: 0, //总页数
    currentpage: 0, //当前页码
    autoid: 0, //当前自动编号
    fileName: 'ims_we7_wxapp_addmoneyrecord'//请求地址
  }
  ,
  /**
   * 获取数据
   */
  getData: function () {
    try {
      this.data.currentpage++
      if (this.data.currentpage > this.data.totalpage) {//如果超过就提示
        app.util.message({
          title: "所有数据已加载"
        })
        return
      }
      var that = this
      app.util.request({//获取数据
        url: 'entry/wxapp/AddMoneyRecord',
        data:{
          autoid:this.data.autoid
        },
        success: function (e) {
          try {
            // console.log(e.data.data)
            for (var i = 0; i < e.data.data.length; i++) {
              that.data.dataList.push(e.data.data[i])
            }
            that.setData({//刷新数据
              dataList: that.data.dataList,
              autoid: e.data.data[e.data.data.length - 1].auto_id
            })

          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error('getdata')
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
        title: '充值记录',
      })
      app.util.getTotalPage(this, 'AddMoneyRecord')
     
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
    // this.getData()
    app.util.getData(this,'AddMoneyRecord')
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})