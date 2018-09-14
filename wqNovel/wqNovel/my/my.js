// pages/my/my.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    shubi: 0,//总书币
    headsrc: '', //头像
    nickName: '', //昵称
    shubi: '', //书币
    jianyou: '>' //右jiant
  }
  ,
  onShare: function (e) {
    try {
      app.util.message({
        title: '以后待定'
      })
    } catch (e) {
      console.error('onShare')
      console.error(e)
    }
  }
  ,
  onRecharge: function (e) {
    try {
      wx.navigateTo({
        url: '../rechargeKind/rechargeKind',
      })
    } catch (e) {
      console.error('onRecharge')
      console.error(e)
    }
  }
  ,
  onStartMember: function (e) {
    try {
      wx.navigateTo({ //启动会员
        url: '../memberKind/memberKind',
      })
    } catch (e) {
      console.error('onStartMember')
      console.error(e)
    }
  }
  ,
  onContactUs: function (e) {
    try {
      wx.navigateTo({
        url: '../contactUs/contactUs',
      })
    } catch (e) {
      console.error('onContactUs')
      console.error(e)
    }
  }
  ,
  /**
   * 最近阅读
   */
  onRecentRead: function (e) {
    try {
      wx.navigateTo({
        url: '../recentreadrecord/recentreadrecord',
      })
    } catch (e) {
      console.error('onRecentRead')
      console.error(e)
    }
  }
  ,
  onBuyRecord: function (e) {
    try {
      // console.log('fdsfdsfds')
      wx.navigateTo({
        url: '../buyRecord/buyRecord',
      })
    } catch (e) {
      console.error('onBuyRecord')
      console.error(e)
    }
  }
  ,
  onAddMoneyRecord: function (e) {
    try {
      wx.navigateTo({
        url: '../addMoneyRecord/addMoneyRecord',
      })
    } catch (e) {
      console.error('onAddMoneyRecord')
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
        title: '我的',
      })
      var that = this
      app.util.request({
        url: 'entry/wxapp/RechargekindTotal',
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.setData({
              shubi: e.data.data
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
    const self = this;
    app.util.footer(self);
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