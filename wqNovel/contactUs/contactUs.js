// wqNovel/contactUs/contactUs.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    workTime: '',
    EM: '',
    QQ: '',
    weixin: '',
    fileName: 'contactUs'
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    try {
      wx.setNavigationBarTitle({
        title: '联系我们',
      })
      var that = this
      app.util.request({
        url: 'entry/wxapp/ContactUs',
        success: function (e) {
          try {
            // console.log(e.data.data[0])
            that.setData({
              workTime: e.data.data[0].work_time,
              EM: e.data.data[0].EM,
              QQ: e.data.data[0].QQ,
              weixin: e.data.data[0].weixin,
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