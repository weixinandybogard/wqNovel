// wqNovel/memberKind/memberKind.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    dataList: [], //数据列表
    memo: ''
  }
  ,
  onItemCllick: function (e) {
    try {
      if (app.globalData.userInfo == null) {//如果是空就退出并提示
        util.message({
          title: '请先登录'
        })
        return
      }
      // console.log(app.globalData.userInfo);
      // app.util.request({//开通会员
      //   url: 'entry/wxapp/StartMember',
      //   success: function (e) {
      //     console.log(e)
      //   }
      //   ,
      //   fail: function (e) {
      //     console.error(e)
      //   }
      // })
      var date = new app.util.date();
      wx.showModal({
        title: '确认支付',
        content: '确认支付' + e.currentTarget.dataset.money + '元？',
        success: function (res) {
          if (res.confirm) {
            app.util.request({//发起支付请求
              'url': 'entry/wxapp/pay',
              data: {
                orderid: date.dateToLong(new Date),
                sum: e.currentTarget.dataset.money,
                title: '会员开通'
              },
              'cachetime': '0',
              success(res) {
                // console.log('成功')
                // console.log(res)

                if (res.data && res.data.data) {
                  // console.log('支付')
                  wx.requestPayment({//实际微新支付请求
                    'timeStamp': res.data.data.timeStamp,
                    'nonceStr': res.data.data.nonceStr,
                    'package': res.data.data.package,
                    'signType': 'MD5',
                    'paySign': res.data.data.paySign,
                    'success': function (res) {
                      //支付成功后，系统将会调用payResult() 方法，此处不做支付成功验证，只负责提示用户
                      app.util.message({
                        title: '支付成功'
                      })

                      app.util.request({//开通会员
                        url: 'entry/wxapp/StartMember',
                        success: function (e) {
                          // console.log(e.data)
                        }
                      })
                      // console.log('支付成功')
                      // console.log(res)
                    },
                    'fail': function (res) {
                      //支付失败后，
                      console.error('失败')
                      console.error(res)
                    }
                  })
                }
              }
            })
          }
        }
      })
    } catch (e) {
      console.error('onItemCllick')
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
        title: '开通会员',
      })
      var that = this
      app.util.request({//会员说明
        url: 'entry/wxapp/MemberMemo',
        success: function (e) {
          try {
            // console.log(e.data.data[0].member_memo)
            that.setData({
              memo: e.data.data[0].member_memo.replace(/\\n/g, "\n")
            })
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
      app.util.request({//会员开通类型
        url: 'entry/wxapp/MemberKind',
        success: function (e) {
          try {
            // console.log(e.data.data)
            var temp = {}

            for (var i = 0; i < e.data.data.length; i++) {
              // console.log('循环')
              if (i % 2 == 0) {
                temp = {}
                temp.auto_id1 = e.data.data[i].auto_id
                temp.member_kind1 = e.data.data[i].member_kind
                temp.member_day1 = e.data.data[i].member_day
                temp.money1 = e.data.data[i].money
              } else {

                temp.auto_id2 = e.data.data[i].auto_id
                temp.member_kind2 = e.data.data[i].member_kind
                temp.member_day2 = e.data.data[i].member_day
                temp.money2 = e.data.data[i].money
                that.data.dataList.push(temp);

              }
            }
            // console.log("i")
            // console.log(i)
            if ((i - 1) % 2 == 0) {
              // console.log('if')
              that.data.dataList.push(temp);
            }
            // console.log(that.data.dataList)
            that.setData({//刷新数据
              dataList: that.data.dataList
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