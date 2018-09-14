// wqNovel/rechargeKind/rechargeKind.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    dataList: [], //数据
    memo: '' //说明
  }

  ,
  fatctPay: function (e) {
    try {
      // console.log('e')
      // console.log(e.currentTarget.dataset.money)
      // app.util.request({ //支付成功后更新书币
      //   url: 'entry/wxapp/RechargeBi',
      //   data: {
      //     bi: e.currentTarget.dataset.bi
      //   },
      //   success: function (res) {
      //     try {
      //       // console.log(res.data.message)

      //     } catch (e) {
      //       console.error('success')
      //       console.error(e)
      //     }
      //   }
      // })


      // app.util.request({//插入充值记录
      //   url: 'entry/wxapp/InsertRechargeRecord',
      //   data: {
      //     sum: e.currentTarget.dataset.money
      //   },
      //   success: function (InsertRechargeRecord) {
      //     // console.log(InsertRechargeRecord)
      //   }
      // })


      var date = new app.util.date();
      wx.showModal({
        title: '确认支付',
        content: '确认支付' + e.currentTarget.dataset.money + '元？',
        success: function (res) {
          if (res.confirm) {
            app.util.request({
              'url': 'entry/wxapp/pay',
              data: {
                orderid: date.dateToLong(new Date),
                sum: e.currentTarget.dataset.money,
                title: '充值书币'
              },
              'cachetime': '0',
              success(res) {
                console.log('成功')
                console.log(res.data)
                // console.log(app.globalData.userInfo.openid)

                // app.util.request({
                //   url:'entry/wxapp/InsertRechargeRecord',
                //   data:{
                //     sum: e.currentTarget.dataset.money
                //   },
                //   success: function (InsertRechargeRecord){
                //     console.log(InsertRechargeRecord)
                //   }
                // })


                if (res.data && res.data.data) {
                  // console.log('支付')
                  wx.requestPayment({
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


                      app.util.request({ //支付成功后更新书币
                        url: 'entry/wxapp/RechargeBi',
                        data: {
                          bi: e.currentTarget.dataset.bi
                        },
                        success: function (res) {
                          try {
                            // console.log(res.data.message)

                          } catch (e) {
                            console.error('success')
                            console.error(e)
                          }
                        }
                      })


                      app.util.request({//插入充值记录
                        url: 'entry/wxapp/InsertRechargeRecord',
                        data: {
                          sum: e.currentTarget.dataset.money,
                          open_id: app.globalData.userInfo.openid
                        },
                        success: function (InsertRechargeRecord) {
                          // console.log(InsertRechargeRecord)
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
      console.error('factPay')
      console.error(e)
    }
  }
  ,

  onPay: function (e) {
    try {

      if (app.globalData.userInfo == null) {//如果是空就退出并提示
        util.message({
          title: '请先登录'
        })
        return
      }

      // app.util.request({//插入充值记录
      //   url: 'entry/wxapp/InsertRechargeRecord',
      //   data: {
      //     sum: e.currentTarget.dataset.money,
      //     open_id: app.globalData.userInfo.openid
      //   },
      //   success: function (InsertRechargeRecord) {
      //     // console.log(InsertRechargeRecord)
      //   }
      // })

      var that = this
      app.util.request({
        url: 'entry/wxapp/IsMemberByReturn',
        success: function (res) {
          try {

            // console.log(res.data.message)
            if (res.data.message == '你是会员') {//是会员才可以充值
              that.fatctPay(e)
            } else {//不是会员就提示记录
              app.util.message({//消息提示
                title: res.data.message
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
      // this.fatctPay(e);

    } catch (e) {
      console.error('onPay')
      console.error(e)
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    try {
      wx.setNavigationBarTitle({
        title: '充值',
      })
      var that = this
      app.util.request({ //获取充值说明
        url: 'entry/wxapp/GetRechargeMemo',
        success: function (e) {
          try {

            that.setData({
              memo: e.data.data[0].memo.replace(/\\n/g, "\n")
            })

          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
      app.util.request({ //获取充值信息
        url: 'entry/wxapp/GetRechargeKind',
        success: function (e) {
          try {
            // console.log(e.data.data)
            var temp = {}
            for (var i = 0; i < e.data.data.length; i++) {
              if (i % 2 == 0) {
                temp = {}
                temp.auto_id1 = e.data.data[i].auto_id
                temp.money1 = e.data.data[i].money
                temp.bi1 = e.data.data[i].bi
              } else {
                temp.auto_id2 = e.data.data[i].auto_id
                temp.money2 = e.data.data[i].money
                temp.bi2 = e.data.data[i].bi
                that.data.dataList.push(temp)
              }
            }

            if ((i - 1) % 2 == 0) {
              that.data.dataList.push(temp)
            }
            that.setData({ //刷新数据
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