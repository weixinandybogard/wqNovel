// wqNovel/catalog/catalog.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    dataList: [] //数据
  }

  ,
  onItemClick: function (e) {
    try {
      // console.log(this.data.dataList[e.currentTarget.dataset.index].introduce_auto_id);
      // console.log(e.currentTarget.dataset.index)
      // console.log(e.currentTarget.dataset.autoid);
      if (app.globalData.userInfo == null) {//如果是空就退出并提示
        util.message({
          title: '请先登录'
        })
        return
      }
      app.util.request({//查看是否存在权限
        url: 'entry/wxapp/IsHasRightToRead',
        data: {
          introduce_auto_id: this.data.dataList[e.currentTarget.dataset.index].introduce_auto_id,
          open_id:app.globalData.userInfo.openid
        },
        success: function (res) {
          try {
            // console.log(res.data)
            if (res.data.message.indexOf('币更新成功') >= 0) {
              wx.navigateTo({
                url: '../readNovel/readNovel?catalog_auto_id=' + e.currentTarget.dataset.autoid,
              })
            } else {
              app.util.message({
                title: res.data.message
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })


    } catch (e) {
      console.error('onItemClick')
      console.error(e)
    }
  }
  ,

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    try {
      // console.log(options.inautoid)
      wx.setNavigationBarTitle({
        title: '章节目录',
      })
      var that = this
      app.util.request({//获取章节信息
        url: 'entry/wxapp/Catalog',
        data: {
          introduce_auto_id: options.inautoid
        },
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.setData({//刷新数据
              dataList: e.data.data
            })
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
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

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})