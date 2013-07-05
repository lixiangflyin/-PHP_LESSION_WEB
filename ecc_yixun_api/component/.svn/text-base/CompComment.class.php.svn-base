<?php
class CompComment
{
	private static $tableName = 't_comment';
	private static $comment = '';

	public static function selectConfig($id) {
		$db = CompConfig::getDB();
		$sql = "SELECT * FROM " . self::$tableName . " WHERE id=" . $id;
		$rs = $db->getRows($sql);
		return $rs ? $rs : array();
	}
	
	public static function setConfig($id, $isReply, $pageSize) {
		$db = CompConfig::getDB();
		$rs = self::selectConfig($id);
		if ($rs) {
			$condition = 'id=' . $id;
			$data = array(
				'is_reply'		=> $isReply,
				'page_size'		=> $pageSize,
				'update_time'	=> date("Y-m-d H:i:s"),
				'user_id'		=> $_COOKIE['CurrentUserID']
			);
			$rs = $db->update(self::$tableName, $data, $condition);
			if ($rs === false) {
				return array('result' => false, 'errorMsg' => $db->errMsg);
			}
		} else {
			$data = array(
				'is_reply' 	   => $isReply,
				'page_size'    => $pageSize,
				'create_time'  => date("Y-m-d H:i:s"),
				'update_time'  => date("Y-m-d H:i:s"),
				'user_id'      => $_COOKIE['CurrentUserID']
			);
			$rs = $db->insert(self::$tableName, $data);
			if ($rs === false) {
				return array('result' => false, 'errorMsg' => $db->errMsg);
			}
		}
		return array('result' => true);
	}
	
	public static function getConfig($id) {
		$db = CompConfig::getDB();
		if ($id) {
			$rs = self::selectConfig($id);
			if ($rs) {
				$isReply = isset($rs[0]['is_reply']) && !empty($rs[0]['is_reply']) ?  '<a href="#" reply="{id}" rtype="{type}" uid="{user_id}" onclick="return false">[回复]</a>' : '';
				$pageSize =  isset($rs[0]['page_size']) && !empty($rs[0]['page_size']) ?  $rs[0]['page_size'] : 10;
				$eventId = $id + 600000;
				self::$comment = '<script type="text/javascript" src="http://st.icson.com/static_v1/js/app/event.comp.comment.js" charset="gb2312"></script>
		<div class="mod_goods_info">
			<ul id="review_header" class="hd">
				<li class="status_on">
					<h3><a href="javascript:;">相关评论（<span id="review_count"></span>）</a></h3>
				</li>
			</ul>
		
			<div id="review_content" class="bd">
				<div class="comment_all">
					<!--S 发表评论 -->
					<div class="wrap_comment"><a name="comment"></a>
						<div id="review_discussion_box" class="mod_comm id_comment2">
							<div class="i_hd">
								<h3 class="tit">发表评论</h3>
							</div>
							<div class="i_bd">
								<!--<p class="tip nor">字数长度请在5-500个字之间。</p>-->
								<textarea class="textarea_long" name="content"></textarea>
								<p t="tipArea" class="g">
									<label class="todo_link wrap_verify">
										<span class="verify_w">验证码：</span>
										<input type="text" class="verify_input" maxlength="4">
										<img src="http://event.51buy.com/json.php?jsontype=str&mod=compcomment&act=vcode" class="verify_img" />
										<span class="nor">看不清？</span>
										<a href="javascript:;" onclick="G.app.comp.comment.onChangeVCode(event);return false;">换一张</a>
									</label>
									<label class="todo_link">
										<input type="checkbox" checked="checked" value="1" t="accept_rule" class="c" />
										我接受易迅网的<a target="_blank" href="http://st.icson.com/help/1-7-terms.htm#rule_discussion">评论规则</a>
									</label>
								</p>
								<div class="g">
									<span class="wrap_btn">
										<a class="btn_common" t="submit" href="javascript:;" onclick="return false;">发表</a>
									</span>
									<span t="word_calc" class="word red"><b>0</b>/1000</span>
								</div>
							</div>
						</div>
						<div class="sidebar">
						<div class="intr">
							<h4>评论说明</h4>
							<p>当涉及广告、比价、重复反馈、不实评论、恶意评论、粗口、危害国家安全等等不当言论时，易迅网有权予以管理。</p>
							<p class="todo_link"><a target="_blank" href="http://st.icson.com/help/1-7-terms.htm#rule_discussion">查看更多商品评论说明</a></p>
						</div>
						</div>
					</div>
					<!--E 发表评论-->
					<div class="foot_line">&nbsp;</div>
					<div class="content">
						<ul class="list_comment list_refer">
						</ul>
		<div id="review_list_tpl" style="display:none">
			<!--<@list@><li>
				<div class="user">
					<img width="60" height="60" src="http://st.icson.com/static_v1/img/guest/guest{pic_order}.gif" />
					<span class="name">{user_name}</span> <span class="level">{user_level_name}</span>
				</div>
				<div class="cont">
					<div class="text">{content}</div>
					<div class="wrap_btn">
						<span class="title">{type_chn}{stars}<span class="date">{create_time_chn}</span></span>发表
						' . $isReply . '
					</div>
					<div class="reply" id="replylist_{type}_{id}" total="{replies_number}" open="0"{attr_addition}>
						<div class="arrow_top"><i>◆</i></div>
						<p class="reply_more"{ifkillReplyMore}><a href="#" replylist="{id}" rtype="{type}" onclick="return false">查看全部{replies_number}条回复&gt;&gt;</a></p>
						<ul class="list_reply">
							<@replies_all@><li>
								<div class="reply">
									<div class="reply_user"><img width="40" height="40" src="http://st.icson.com/static_v1/img/guest/guest{pic_order}.gif" /></div>
									<div class="reply_cont"><p class="reply_text"><strong class="reply_name">{user_name}回复：</strong>{content}</p>
									<p class="reply_date">{reply_date_chn}</p>
								</div>
							</li><@_replies_all@>
						</ul>
					</div>
				</div>
			</li><@_list@>-->
		</div>
		<div id="review_reply_list_tpl" style="display:none">
			<!--<@list@><li>
				<div class="reply">
					<div class="reply_user"><img width="40" height="40" src="http://st.icson.com/static_v1/img/guest/guest{pic_order}.gif" /></div>
					<div class="reply_cont"><p class="reply_text"><strong class="reply_name">{user_name}回复：</strong>{content}</p>
					<p class="reply_date">{reply_date_chn}</p>
				</div>
			</li><@_list@>-->
		</div>
						<div class="page_wrap">
							<div class="paginator" id="review_page"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		$(document).ready(function(){
			G.app.comp.comment.init({
				eventId:' . $eventId . ', pageSize:' . $pageSize . '
			});
		});
		</script>';
			}
		}
		return self::$comment;
	}
	
	public static function commentList($id) {
		$commentList = '';
		$db = CompConfig::getDB();
		if ($id) {
			$rs = self::selectConfig($id);
			if ($rs) {
				$isReply = isset($rs[0]['is_reply']) && !empty($rs[0]['is_reply']) ?  '<a href="#" reply="{id}" rtype="{type}" uid="{user_id}" onclick="return false">[回复]</a>' : '';
				$pageSize =  isset($rs[0]['page_size']) && !empty($rs[0]['page_size']) ?  $rs[0]['page_size'] : 10;
				$eventId = $id + 600000;
				$commentList = '<script type="text/javascript" src="http://st.icson.com/static_v1/js/app/event.comp.comment.split.js" charset="gb2312"></script>
				<div id="review_content" class="bd">
					<ul class="list_comment list_refer">
					</ul>
					<div id="review_list_tpl" style="display:none">
						<!--<@list@><li>
							<a href="javascript:void(0);" title="{content}">{content}</a>
						</li><@_list@>-->
					</div>
					<div class="page_wrap">
						<div class="paginator" id="review_page"></div>
					</div>
				</div>
		
				<script type="text/javascript">
				$(document).ready(function(){
					G.app.comp.comment.init({
						eventId:' . $eventId . ', pageSize:' . $pageSize . '
					});
				});
				</script>';
			}
		}
		return $commentList;
	}
	
	
	public static function commentPost() {
		$commentPost = '<script type="text/javascript" src="http://st.icson.com/static_v1/js/app/event.comp.comment.split.js" charset="gb2312"></script>
		<div class="wrap_comment"><a name="comment"></a>
				<div id="review_discussion_box" class="mod_comm id_comment2" style="border-right:none; width:500px;">
					<div class="i_bd">
						<textarea name="content" id="comment_content"></textarea>
						<p t="tipArea" class="g" style="padding-left:0;">
							<label class="todo_link wrap_verify" style="float:left;">
								<span class="verify_w">验证码：</span>
								<input type="text" class="verify_input" maxlength="4">
								<img src="http://event.51buy.com/json.php?jsontype=str&mod=compcomment&act=vcode" class="verify_img" />
								<span class="nor">看不清？</span>
								<a href="javascript:;" onclick="G.app.comp.comment.onChangeVCode(event);return false;">换一张</a>
							</label>
							<label class="todo_link" style="display:none;">
								<input type="checkbox" checked="checked" value="1" t="accept_rule" class="c" />
								我接受易迅网的<a target="_blank" href="http://st.icson.com/help/1-7-terms.htm#rule_discussion">评论规则</a>
							</label>
						</p>
						<div class="g">
							<span class="wrap_btn">
								<a class="btn_common" t="submit" href="javascript:;" onclick="return false;">发表</a>
							</span>
							<span t="word_calc" class="word red"><b>0</b>/1000</span>
						</div>
					</div>
				</div>
			</div>';
		return $commentPost;
	}
	
}