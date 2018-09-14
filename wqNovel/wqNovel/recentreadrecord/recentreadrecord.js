// wqNovel/recentreadrecord/recentreadrecord.js
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
    fileName: 'ims_we7_wxapp_recentreadrecord'//请求地址
  }
  ,
  onClickRead: function (e) {
    try {
      // console.log(e.currentTarget.dataset.catalogautoid)
      wx.navigateTo({
        url: '../readNovel/readNovel?catalog_auto_id=' + e.currentTarget.dataset.catalogautoid,
      })//直接进入阅读
    } catch (e) {
      console.error('onClickRead')
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
        title: '最近阅读',
      })
      app.util.getTotalPage(this, 'RecentReadRecord')
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
    try {
      app.util.getData(this, 'RecentReadRecord')
    } catch (e) {
      console.error('onReachBottom')
      console.error(e)
    }
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})