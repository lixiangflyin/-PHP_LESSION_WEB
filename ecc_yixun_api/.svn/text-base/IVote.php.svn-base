<?php
require_once(PHPLIB_ROOT . 'inc/constant.inc.php');
//require_once('inc/IVoteOptionTTC.php');
//require_once('inc/IVoteTTC.php');

class IVote
{
    public static $errCode = 0;
    public static $errMsg = "";

    public static $VOTE_STATUS = array(
                                   'valid' => 1,
                                   'unvalid' => 2,);
    /*
    *增加一个选项，属于后台操作
    */
    public static function addOption( $category_id, $biz_id, $option_id, $option_name1, $option_name2, $group_id, $order, $status = 1)
    {
        if (!isset($category_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[category_id is null]';
            return false;
        }

        if (!isset($biz_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[biz_id is null]';
            return false;
        }

        if (!isset($option_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[option_id is null]';
            return false;
        }

        if (!isset($group_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[group_id is null]';
            return false;
        }


        $ret = IVoteOptionTTC::insert(array('category_id' => $category_id,
                                            'biz_id'      => $biz_id,
                                            'option_id'   => $option_id,
                                            'option_name1'=> $option_name1,
                                            'option_name2'=> $option_name2,
                                            'group_id'    => $group_id,
                                            'order'       => $order,
                                            'status'      => $status));
        if (false == $ret) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert new option into voteoptionTTC failed]' . IVoteOptionTTC::$errMsg . IVoteOptionTTC::$errCode;
            return false;
        }

        return true;
    }

    /*
    *更新一个选项状态，属于后台操作
    */
    public static function updateOptionStatus( $category_id, $biz_id, $option_id, $is_valid = TRUE)
    {
        if (!isset($category_id) ) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[category_id is null]';
            return false;
        }

        if (!isset($biz_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[biz_id is null]';
            return false;
        }

        if (!isset($option_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[option_id is null]';
            return false;
        }

        if ($is_valid)
        {
            $status = self::$VOTE_STATUS['valid'];
        }
        else
        {
            $status = self::$VOTE_STATUS['unvalid'];
        }

        $ret = IVoteOptionTTC::update( array('category_id' => $category_id, 'biz_id' => $biz_id, 'status' => $status), array('option_id'=>$option_id));
        if (false === $ret) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[delete option from voteoptionTTC failed]' . IVoteOptionTTC::$errMsg;
            return false;
        }

        return true;
    }

    public static function getVoteOption($category_id, $biz_id, $option_id = NULL)
    {
        if (!isset($category_id) ) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[category_id is null]';
            return false;
        }

        if (!isset($biz_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[biz_id is null]';
            return false;
        }

        if (NULL === $option_id)
        {
            $vote_options = IVoteOptionTTC::get( $category_id, array('biz_id'=>$biz_id, 'status'=>1) );
        }
        else
        {
            $vote_options = IVoteOptionTTC::get( $category_id, array('biz_id'=>$biz_id, 'option_id' => $option_id ) );
        }
        if ( false === ($vote_options))
        {
             self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IVoteOptionTTC::$errMsg. ' '. IVoteOptionTTC::$errCode;
             return false;
        }

        return $vote_options;
    }

    /*
     * @brief 获取某一投票项目全部选项
     * @param $survey_id     when review then product_id
     * @param $category_id   when review then category3
     * @param $biz_id        when review then 1
     * @return array(array('survey_id', 'category_id', 'biz_id', 'option_id', 'group_id' group order,
     *                     'order' option order, 'option_name1' group name, 'option_name2' option name, 'score'))
     */
    public static function getVotes($survey_id, $category_id, $biz_id)
    {
        $result = array();

        if (!isset($survey_id) ) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[survey_id is null]';
            return false;
        }

        if (!isset($category_id) ) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[category_id is null]';
            return false;
        }

        if (!isset($biz_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[biz_id is null]';
            return false;
        }

        $votes = IVoteTTC::get($survey_id, array('biz_id' => $biz_id));
        if (false === $votes)
        {
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IVoteTTC::$errMsg. ' '. IVoteTTC::$errCode;
            return false;
        }

        $vote_options = IVoteOptionTTC::get( $category_id, array('biz_id'=>$biz_id, 'status' => self::$VOTE_STATUS['valid']) );
        if ( false === $vote_options)
        {
             self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IVoteOptionTTC::$errMsg. ' '. IVoteOptionTTC::$errCode;
             return false;
        }

        $tmp = array();
        foreach ($votes as $vote){
			$tmp[$vote['option_id']] = $vote;
        }
        $votes = $tmp;
        foreach ($vote_options AS $vote_option)
        {
            $vote = $vote_option;
            if (!isset($votes[$vote_option['option_id']]))
            {
                $vote['score'] = 0;
            }
            else
            {
                $vote['score'] = $votes[$vote_option['option_id']]['score'];
            }

            $result[] = $vote;
        }

        return $result;
    }

    /*
    *  投$num 票
    */
    public static function vote( $survey_id, $biz_id, $option_id, $num )
    {
        if (!isset($survey_id) ) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[survey_id is null]';
            return false;
        }

        if (!isset($biz_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[biz_id is null]';
            return false;
        }

        if (!isset($option_id)) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[option_id is null]';
            return false;
        }

        $Info = IVoteTTC::get( $survey_id, array('biz_id'=>$biz_id, 'option_id'=>$option_id) );
        if (false == $Info || empty($Info))
        {
            $ret = IVoteTTC::insert(array('survey_id'=>$survey_id, 'biz_id'=>$biz_id, 'option_id'=>$option_id, 'score'=>$num ));
        }
        else
        {
            $Info = $Info[0];
            $ret = IVoteTTC::update( array('survey_id'=>$survey_id, 'score'=>($Info['score']+$num) ), array('biz_id'=>$biz_id, 'option_id'=>$option_id) );
        }

        if (false === $ret) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update option into voteoptionTTC failed]' . IVoteTTC::$errMsg;
            return false;
        }

        return true;
    }
}


