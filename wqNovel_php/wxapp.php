<?php
use Qiniu\json_decode;
/**
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 * User: fanyk
 * Date: 2017/12/10
 * Time: 14:46.
 */
class WqNovelModuleWxapp extends WeModuleWxapp {
	// const TABLE = 'we7_wxapp_wqNovel';
	const LUNBO = 'ims_we7_wxapp_lunbo'; // 轮播图数据
	const TUIJIAN = 'ims_we7_wxapp_tuijian'; // 精品推荐数据
	const HOT = 'ims_we7_wxapp_hot'; // 热门数据
	const LIMITTIMEFREE = 'ims_we7_wxapp_limittimefree'; // 限时免费
	const NEWBOOK = 'ims_we7_wxapp_newbook'; // 新书
	const FINISHIBOOK = 'ims_we7_wxapp_finishbook'; // 完本小说
	const BOOKKIND = 'ims_we7_wxapp_bookkind'; // 书籍分类
	const INTRODUCE = 'ims_we7_wxapp_instroduce'; // 书籍介绍
	const BOOKS = 'ims_we7_wxapp_books'; // 书架上的书籍
	const RECHARGEKIND = 'ims_we7_wxapp_rechargekind'; // 书币记录
	const ADDMONEYRECORD = 'ims_we7_wxapp_addmoneyrecord'; // 充值记录
	const BUYRECORD = 'ims_we7_wxapp_buyrecord'; // 购买记录
	const RECENTREADRECORD = 'ims_we7_wxapp_recentreadrecord'; // 最近阅读
	const CONTACTUS = 'ims_we7_wxapp_contactus'; // 联系我们
	const MEMBERKIND = 'ims_we7_wxapp_memberkind'; // 会员日
	const MEMBERMEMO = 'ims_we7_wxapp_membermemo'; // 会员说明
	const RECHARGEMEMO = 'ims_we7_wxapp_rechargememo'; // 充值说明
	const NOVELDETAIL = 'ims_we7_wxapp_noveldetail'; // 小说明细
	const GUESSLIKE = 'ims_we7_wxapp_guesslike'; // 猜你喜欢
	const CATALOG = 'ims_we7_wxapp_catalog'; // 章节目录
	const READNOVEL = 'ims_we7_wxapp_readnovel'; // 读小说
	const MEMBERINFO = 'ims_we7_wxapp_memberinfo'; // 会员信息
	const baseUrl = "http://localhost/";
	private $gpc;
	private $w;
	private $uid; // 用户ID
	public function __construct() {
		// parent::__construct();
		global $_W;
		global $_GPC;
		$this->gpc = $_GPC;
		$this->w = $_W;
		$this->uid = $_W ['openid'];
		$this->uniacid = $_W ['uniacid'];
		// $this->uid = 0;
		// 如果需要强制登录 加 下边代码
		// if (empty($this->uid)) {
		// $this->result(41009, '请先登录');
		// }
	}
	public function get($key, $default = null) {
		return isset ( $this->gpc [$key] ) ? $this->gpc [$key] : $default;
	}
	

	
	/**
	 * 获取精品轮播图数据
	 */
	public function doPageGoodChooseLunbo() {
		$data = pdo_getall ( $this::LUNBO, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '轮播数据', $data );
	}
	/**
	 * 获取精品推荐数据
	 */
	public function doPageTuiJian() {
		// echo $this->gpc['sex']
		$data = pdo_getall ( $this::TUIJIAN, array (
				'sex' => $this->gpc ['sex'] 
		), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '主编精品推荐数据', $data );
	}
	
	/**
	 * 获取精品热门小说
	 */
	public function doPageHot() {
		$data = pdo_getall ( $this::HOT, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '精品热门小说', $data );
	}
	
	/**
	 * 限时免费
	 */
	public function doPagelimitTimeFree() {
		$data = pdo_getall ( $this::LIMITTIMEFREE, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '精品限时免费小说', $data );
	}
	/**
	 * 新书
	 */
	public function doPageNewBook() {
		$data = pdo_getall ( $this::NEWBOOK, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '精品新书', $data );
	}
	/**
	 * 完本书
	 */
	public function doPageFinishBook() {
		$data = pdo_getall ( $this::FINISHIBOOK, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '精品完书', $data );
	}
	/**
	 * 获取书的类别
	 */
	public function doPageBookKind() {
		$data = pdo_getall ( $this::BOOKKIND, array (
				'line' => $this->gpc ['line'] 
		), array (), array (), array (
				'order_line desc',
				'auto_id asc' 
		) );
		$this->result ( 0, '书分类获取', $data );
	}
	public function doPageGetTotalPage() {
		// print ("fdsfds");
		// print($this->gpc['table']);
		$data = pdo_getall ( $this->gpc ['table'], array (), array (
				'count(*)' 
		), array (), array () );
		
		// 计算总页数
		$totalRecord = $data [0] ['count(*)'];
		$totalPage = ( int ) ($totalRecord / 20);
		if ($totalRecord % 20 != 0 || $totalRecord<20) {
			$totalPage ++; //
		}
		// 计算总页数
		
		// print_r($totalPage);
		$this->result ( 0, '获取总页码', $totalPage );
	}
	
	/**
	 * 获取小说分类详细信息
	 */
	public function doPageBookKindDetail() {
		$condition = " 1=1 ";
		// 如果设置了又不是全部的，必须加入过滤条件
		if (isset ( $this->gpc ['lineoneautoid'] )) {
			if ($this->gpc ['lineoneautoid'] != 5 && $this->gpc ['lineoneautoid'] != 6 && $this->gpc ['lineoneautoid'] != 10 && $this->gpc ['lineoneautoid'] != 13)
				$condition .= " And  line_one_auto_id=" . $this->gpc ['lineoneautoid'];
			// $condition ['line_one_auto_id'] = $this->gpc ['lineoneautoid'];
		}
		if (isset ( $this->gpc ['linetwoautoid'] )) {
			if ($this->gpc ['linetwoautoid'] != 5 && $this->gpc ['linetwoautoid'] != 6 && $this->gpc ['linetwoautoid'] != 10 && $this->gpc ['linetwoautoid'] != 13)
				$condition .= " And  line_two_auto_id=" . $this->gpc ['linetwoautoid'];
		}
		if (isset ( $this->gpc ['linethreeautoid'] )) {
			// print_r($this->gpc ['linethreeautoid']);
			// exit();
			if ($this->gpc ['linethreeautoid'] != 5 && $this->gpc ['linethreeautoid'] != 6 && $this->gpc ['linethreeautoid'] != 10 && $this->gpc ['linethreeautoid'] != 13)
				$condition .= " And  line_three_auto_id=" . $this->gpc ['linethreeautoid'];
		}
		if (isset ( $this->gpc ['linefourautoid'] )) {
			if ($this->gpc ['linefourautoid'] != 5 && $this->gpc ['linefourautoid'] != 6 && $this->gpc ['linefourautoid'] != 10 && $this->gpc ['linefourautoid'] != 13)
				$condition .= " And  line_four_auto_id=" . $this->gpc ['linefourautoid'];
		}
		if (isset ( $this->gpc ['autoid'] )) {
			if ($this->gpc ['autoid'] != 0)
				$condition .= " And auto_id<" . $this->gpc ['autoid'];
		}
		// 如果设置了又不是全部的，必须加入过滤条件
		// print_r($condition);
		// exit();
		$data = pdo_getall ( $this::INTRODUCE, $condition, array (), array (), array (
				'auto_id desc' 
		), array (
				' 20 ' 
		) );
		$this->result ( 0, '小说分类详细信息', $data );
	}
	/**
	 * 获取书架信息所有记录
	 */
	public function doPageBookTotalRecord() {
		$data = pdo_getall ( $this::BOOKS, array (), " *,null as checked ", array (), array (
				'auto_id desc' 
		), array (
				' 20 ' 
		) );
		$this->result ( 0, '书架信息', $data );
	}
	/**
	 * 获取书架上总共多少本
	 */
	public function doPageBookTotalBook() {
		$data = pdo_getall ( $this::BOOKS, array (), array (
				'count(*)' 
		), array (), array (
				'auto_id desc' 
		), array (
				' 20 ' 
		) );
		$this->result ( 0, '书架总共本', $data [0] ['count(*)'] );
	}
	
	/**
	 * 获取总共书币
	 */
	public function doPageRechargekindTotal() {
		$data = pdo_getall ( $this::RECHARGEKIND, array (), array (
				'sum(bi)' 
		), array (), array (
				'auto_id desc' 
		), array (
				' 20 ' 
		) );
		$this->result ( 0, '书架总共本', $data [0] ['0'] );
	}
	
	/**
	 * 分页下拉办法
	 */
	private function doPageRecord($table) {
		$condistion = ""; // $this->gpc['autoid'];
		$data = array ();
		if ($this->gpc ['autoid'] > 0) { // 如果存在自动编号就处理
			$condistion = " auto_id<" . $this->gpc ['autoid'];
		}
		if ($condistion == "") { // 没有直接取20
			$data = pdo_getall ( $table, array (), array (), array (), array (
					'auto_id desc' 
			), array (
					' 20 ' 
			) );
		} else { // 有就处理下一页
			$data = pdo_getall ( $table, $condistion, array (), array (), array (
					'auto_id desc' 
			), array (
					' 20 ' 
			) );
		}
		$this->result ( 0, '记录', $data );
	}
	
	/**
	 * 充值记录
	 */
	public function doPageAddMoneyRecord() {
		$this->doPageRecord ( $this::ADDMONEYRECORD );
	}
	/**
	 * 消费记录
	 */
	public function doPageBuyRecord() {
		$this->doPageRecord ( $this::BUYRECORD );
	}
	
	/**
	 * 最近阅读记录
	 */
	public function doPageRecentReadRecord() {
		$this->doPageRecord ( $this::RECENTREADRECORD ); // 最近阅读
	}
	public function doPageContactUs() {
		$data = pdo_getall ( $this::CONTACTUS, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '联系我们', $data );
	}
	
	/**
	 * 获取开通会员信息
	 */
	public function doPageMemberKind() {
		$data = pdo_getall ( $this::MEMBERKIND, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '开通会员', $data );
	}
	
	/**
	 * 会员说明
	 */
	public function doPageMemberMemo() {
		$data = pdo_getall ( $this::MEMBERMEMO, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '会员说明', $data );
	}
	
	/**
	 * 获取充值信息
	 */
	public function doPageGetRechargeKind() {
		// echo "dsfdsfds";
		// exit("fdsfds");
		$data = pdo_getall ( $this::RECHARGEKIND, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '充值', $data );
	}
	/**
	 * 充值说明
	 */
	public function doPageGetRechargeMemo() {
		$data = pdo_getall ( $this::RECHARGEMEMO, array (), array (), array (), array (
				'auto_id desc' 
		) );
		// echo ($data[0]['memo']);
		// print_r($data[0]['memo']);
		$this->result ( 0, '充值说明', $data );
	}
	
	/**
	 * 最近一次更新时间
	 */
	public function doPageLastistComeTime() {
		$data = pdo_getall ( $this::INTRODUCE, array (), array (), array (), array (
				'auto_id desc' 
		), array (
				'1' 
		) );
		$this->result ( 0, '最近更新', $data );
	}
	/**
	 * 小说明细
	 */
	public function doPageNovelDetail() {
		$condition = '';
		$condition = " B.auto_id='" . $this->gpc ['introduce_auto_id'] . "'";
		$data = pdo_getall ( 'ims_we7_wxapp_noveldetail A
Inner Join ims_we7_wxapp_instroduce B On A.introduce_auto_id=B.auto_id', $condition, ' A.*,B.is_member_read,B.need_bi ', array (), array (
				' A.auto_id desc' 
		) );
		$this->result ( 0, '小说明细', $data );
	}
	
	/**
	 * 猜测你喜欢
	 */
	public function doPageGuessLike() {
		$data = pdo_getall ( $this::GUESSLIKE, array (), array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '猜你喜欢', $data );
	}
	/**
	 * 获取章节目录
	 */
	public function doPageCatalog() {
		$condition = ' introduce_auto_id=' . $this->gpc ['introduce_auto_id'];
		$data = pdo_getall ( $this::CATALOG, $condition, array (), array (), array (
				'auto_id asc' 
		) );
		$this->result ( 0, '章节内容', $data );
	}
	
	/**
	 * 加入书架
	 */
	public function doPageAddBook() {
		$introduce_auto_id = $this->gpc ['introduce_auto_id'];
		$condition = ' auto_id=' . $introduce_auto_id;
		$data_introduce = pdo_getall ( $this::INTRODUCE, $condition, array (), array (), array (
				'auto_id desc' 
		) );
		// print_r ( $data_introduce [0] );
		$condition = ' introduce_auto_id=' . $introduce_auto_id;
		$data_book = pdo_getall ( $this::BOOKS, $condition, array (), array (), array (
				'auto_id desc' 
		) );
		if (count ( $data_book ) > 0) { // 如果已经存在
			$this->result ( 0, '已经存在' );
		} else {
			// print_r($data_introduce[0] ['title']);
			// print_r("<br>......<br>");
			// print_r($data_introduce[0] ['src']);
			// print_r("<br>......<br>");
			$insert = pdo_insert ( $this::BOOKS, array (
					'title' => $data_introduce [0] ['title'],
					'src' => $data_introduce [0] ['src'],
					'introduce_auto_id' => $introduce_auto_id 
			) );
			if ($insert) {
				$this->result ( 0, 'message', $insert );
			}
		}
		// print_r(count($data_book));
	}
	
	/**
	 * 获取是否有最近阅读这本书的章节
	 */
	public function doPageGetLaticeCatlogId() {
		$data = pdo_getall ( 'ims_we7_wxapp_recentreadrecord A
INNER JOIN ims_we7_wxapp_catalog B On A.catalog_auto_id=B.auto_id', ' B.introduce_auto_id=' . $this->gpc ['introduce_auto_id'], array (
				'A.catalog_auto_id' 
		), array (), array (
				'A.auto_id desc' 
		), array (
				' 1 ' 
		) );
		$this->result ( 0, '章节内容', $data );
	}
	/**
	 * 根据章节内容获取小说
	 */
	public function doPageGetReadNovelByCatalog() {
		$condition = ' B.auto_id=' . $this->gpc ['catalog_auto_id'];
		$table = 'ims_we7_wxapp_readnovel A 
inner JOIN ims_we7_wxapp_catalog B On A.catalog_auto_id=B.auto_id
INNER JOIN ims_we7_wxapp_instroduce C On B.introduce_auto_id=C.auto_id';
		$data = pdo_getall ( $table, $condition, array (
				'A.*',
				'C.src',
				'c.auto_id as introduce_auto_id' 
		), array (), array (
				'A.auto_id desc' 
		) );
		$this->result ( 0, '小说内容', $data );
	}
	
	/**
	 * 根据介绍编号获取小说内容
	 */
	public function doPageGetReadNovelByIntroduce() {
		$condition = ' C.auto_id=' . $this->gpc ['introduce_auto_id'] . " And B.auto_id=" . $this->gpc ['catalog_auto_id'];
		$table = 'ims_we7_wxapp_readnovel A
inner JOIN ims_we7_wxapp_catalog B On A.catalog_auto_id=B.auto_id
INNER JOIN ims_we7_wxapp_instroduce C On B.introduce_auto_id=C.auto_id';
		$data = pdo_getall ( $table, $condition, array (
				'A.*',
				'C.src',
				'c.auto_id as introduce_auto_id' 
		), array (), array (
				'A.auto_id desc' 
		) );
		$this->result ( 0, '小说内容', $data );
	}
	/**
	 * 搜索指定内容
	 */
	public function doPageSearch() {
		$condisiont = '';
		$condisiont = " title like '%" . $this->gpc ['value'] . "%' or des1 like '%" . $this->gpc ['value'] . "%' ";
		$data = pdo_getall ( $this::INTRODUCE, $condisiont, array (), array (), array (
				'auto_id desc' 
		) );
		$this->result ( 0, '搜索结果', $data );
	}
	
	/**
	 * 删除书架书籍
	 */
	public function doPageDelBooks() {
		$value = $this->gpc ['books_auto_id']; // 获取数值
		                                       // print_r(str_replace("&quot;", '',$value));
		$data = json_decode ( str_replace ( "&quot;", '', $value ) ); // 删除空格并转换数组
		                                                              // print_r ( $data );
		                                                              
		// 循环删除
		foreach ( $data as $item ) {
			// print_r ( $item );
			$result = pdo_delete ( $this::BOOKS, array (
					'auto_id' => $item 
			) );
		}
		// 循环删除
		
		// $result = pdo_delete(self::BOOKS, array('auto_id'=>intval($this->get('auto_id'))));
		// $this->result(0, '', $result ? 1 : 0);
		$this->result ( 0, '处理成功' );
	}
	
	/**
	 * 执行支付.
	 */
	public function doPagePay() {
		$orderid = $this->get ( 'orderid', null );
		// 判断权限
		if (! $this->hasOrder ( $orderid )) {
			$this->result ( 1, '非用户订单' );
		}
		// print_r($this->get('sum'));
		// exit();
		$order = array (
				'tid' => $orderid,
				'fee' => floatval ( $this->get ( 'sum' ) ),
				'title' => $this->get ( 'title' ) 
		);
		$paydata = $this->pay ( $order );
		if (is_error ( $paydata )) {
			$this->result ( $paydata ['errno'], $paydata ['message'] );
		}
		$this->result ( 0, '', $paydata );
	}
	
	// 判断当前用户有没这个订单
	private function hasOrder($orderid) {
		return true;
	}
	
	/**
	 * 获取支付结果.
	 */
	public function doPagePayResult() {
		global $_GPC;
		global $_W;
		$orderid = $_GPC ['orderid'];
		$order_type = trim ( $_GPC ['order_type'] );
		// 订单id
		$paylog = pdo_get ( 'core_paylog', array (
				'uniacid' => $_W ['uniacid'],
				'module' => 'we7_wxappdemo',
				'tid' => $orderid 
		) );
		$status = intval ( $paylog ['status'] ) === 1;
		$this->result ( $status, $status ? '支付成功' : '支付失败' );
	}
	
	/**
	 * 开通会员
	 */
	public function doPageStartMember() {
		global $_W;
		// echo $_W['openid'];
		
		$insert = pdo_insert ( $this::MEMBERINFO, array (
				'open_id' => $_W ['openid'],
				'bi' => 0 
		) );
		
		if ($insert) {
			$this->result ( 0, 'message', $insert );
			return;
		}
		$this->result ( 0, '添加失败' );
	}
	
	/**
	 * 判断是不是会员并返回消息
	 */
	public function doPageIsMemberByReturn() {
		global $_W;
		$data_select = pdo_getall ( $this::MEMBERINFO, array (
				'open_id' => $_W ['openid'] 
		) );
		if (count ( $data_select ) == 0) { // 如果不是会员禁止充值
			$this->result ( 0, '你还不是会员' );
			return false;
		} else {
			$this->result ( 0, '你是会员' );
			return true;
		}
	}
	
	/**
	 * 判断是不是会员
	 */
	public function doPageIsMember() {
		global $_W;
		$data_select = pdo_getall ( $this::MEMBERINFO, array (
				'open_id' => $_W ['openid'] 
		) );
		if (count ( $data_select ) == 0) { // 如果不是会员禁止充值
		                                   // $this->result ( 0, '你还不是会员' );
			return false;
		} else {
			// $this->result ( 0, '你是会员' );
			return true;
		}
	}
	
	/**
	 * 充值书币处理
	 */
	public function doPageRechargeBi() {
		global $_W;
		$update = ' bi=bi+' . $this->get ( 'bi' );
		$data_update = pdo_update ( $this::MEMBERINFO, $update, array (
				'open_id' => $_W ['openid'] 
		) );
		$this->result ( 0, '更新成功', $data_update ? 1 : 0 );
	}
	
	/**
	 * 判断读取条件是否充足
	 */
	public function doPageIsHasRightToRead() {
		$condition = " auto_id =" . $this->gpc ['introduce_auto_id'];
		$data = pdo_getall ( $this::INTRODUCE, $condition );
		$is_need_member = $data [0] ['is_member_read']; // 获取是否需要会员才能读
		$title = $data [0] ['title']; // 获取标题
		if ($is_need_member == 1) { // 如果需要会员
			if ($this->doPageIsMember () == false) { // 需要又不是会员
				$this->result ( 0, '需要会员才能读', 0 );
				exit ();
			}
		}
		$bi = $data [0] ['need_bi'];
		unset ( $data ); // 删除
		$data = pdo_getall ( $this::MEMBERINFO );
		if (count ( $data ) == 0) // 如果没有开通会员,根本不需要书币
			$this->result ( 0, '币更新成功' );
		if ($data [0] ['bi'] >= $bi) {
			
			$bi_value = $data [0] ['bi'] - $bi;
			$data = pdo_update ( $this::MEMBERINFO, array (
					'bi' => $bi_value 
			) );
			
			if ($bi > 0) { // 如果需要书币,插入书币使用记录
				pdo_insert ( $this::BUYRECORD, array (
						'buy_bi' => $bi,
						'buy_use_for' => $title,
						'buy_time' => date ( 'Y-m-d H:i:s', time () ) 
				) );
			}
			$insert = $this->result ( 0, '币更新成功', $data ? 1 : 0 );
		} else {
			$this->result ( 0, '书币不足' );
		}
	}
	
	/**
	 * 插入最近阅读
	 */
	public function doPageInsertRecentReadRecord() {
		$data = pdo_getall ( 'ims_we7_wxapp_catalog A
Inner join ims_we7_wxapp_instroduce B On A.introduce_auto_id=B.auto_id', ' A.auto_id=' . $this->get ( 'catalog_auto_id' ), ' A.auto_id,B.title,B.des1 ' );
		
		if (count ( $data ) > 0) { // 如果查找到记录
			$insert = pdo_insert ( $this::RECENTREADRECORD, array (
					'title' => $data [0] ['title'],
					'des' => $data [0] ['des1'],
					'catalog_auto_id' => $data [0] ['auto_id'] 
			) );
			
			if ($insert) {
				$this->result ( 0, 'message', $insert );
				return;
			}
			$this->result ( 0, '添加失败' );
		}
	}
	
	/**
	 * 插入新的充值记录
	 */
	public function doPageInsertRechargeRecord() {
		// date_default_timezone_set('PRC');//就可以了。
		
		// date_default_timezone_set('Asia/Shanghai');
		
		// echo date('Y-m-d H:i:s',time());;
		// exit();
		$insert = pdo_insert ( $this::ADDMONEYRECORD, array (
				'add_money' => $this->get ( 'sum' ),
				'add_money_time' => date ( 'Y-m-d H:i:s', time () ) 
		) );
		
		if ($insert) {
			$this->result ( 0, 'message', $insert );
			return;
		}
		$this->result ( 0, '添加失败' );
	}
}
