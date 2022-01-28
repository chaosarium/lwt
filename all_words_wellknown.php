<?php

/**
 * \file
 * \brief Setting all unknown words to Well Known (99)
 * 
 * Call: all_words_wellknown.php?text=[textid]
 * 
 * @package Lwt
 * @author  LWT Project <lwt-project@hotmail.com>
 * @license Unlicense <http://unlicense.org/>
 * @link    https://hugofara.github.io/lwt/docs/html/all__words__wellknown_8php.html
 * @since   1.0.3
 */

require_once 'inc/session_utility.php';

$status = $_REQUEST['stat'];
$langid = get_first_value(
    "SELECT TxLgID AS value 
    FROM " . $tbpref . "texts 
    WHERE TxID = " . $_REQUEST['text']
);

if ($status == 98) {
    pagestart("Setting all blue words to Ignore", false); 
} else if ($status == 99) {
    pagestart("Setting all blue words to Well-known", false); 
}

$sql = 'select Ti2Text, lower(Ti2Text) as  WoTextLC from (' . $tbpref . 'textitems2 left join ' . $tbpref . 'words on (Ti2WoID = WoID) and (Ti2LgID = WoLgID)) where Ti2WoID = 0 and Ti2WordCount = 1 and Ti2TxID = ' . $_REQUEST['text'] . ' group by lower(Ti2Text) order by Ti2Order';
$res = do_mysqli_query($sql);
$tooltip_mode = getSettingWithDefault('set-tooltip-mode');
$count = 0;
$javascript = "var title='';";
$sqlarr = array();
while ($record = mysqli_fetch_assoc($res)) {
	$term = $record['Ti2Text'];	
	$termlc = $record['WoTextLC'];
	$count1 = 0 + runsql('insert into ' . $tbpref . 'words (WoLgID, WoText, WoTextLC, WoWordCount, WoStatus, WoStatusChanged,' .  make_score_random_insert_update('iv') . ') values( ' . 
	$langid . ', ' . 
	convert_string_to_sqlsyntax($term) . ', ' . 
	convert_string_to_sqlsyntax($termlc) . ', 1, '.$status.' , NOW(), ' .  
make_score_random_insert_update('id') . ')','');
	$wid = get_last_key();
	$sqlarr[]= ' WHEN ' . convert_string_to_sqlsyntax_notrim_nonull($termlc) . ' THEN ' . $wid;
	if($tooltip_mode == 1)
		if ($count1 > 0 ) 
			$javascript .= "title = make_tooltip(" . prepare_textdata_js($term) . ",'*','','".$status."');";
	$javascript .= "$('.TERM" . strToClassName($termlc) . "', context).removeClass('status0').addClass('status".$status." word" . $wid . "').attr('data_status','".$status."').attr('data_wid','" . $wid . "').attr('title',title);";
	$count += $count1;
}
mysqli_free_result($res);
$sqltext = "UPDATE  " . $tbpref . "textitems2 SET Ti2WoID  = CASE lower(Ti2Text)";
$sqltext .= implode(' ', $sqlarr) . ' END where Ti2WordCount=1 and Ti2WoID  = 0 and Ti2LgID=' . $langid;
do_mysqli_query( $sqltext);

if ($status == 98) {
    echo "<p>OK, you ignore all " . $count . " word(s)!</p>"; 
} else if($status == 99) {
    echo "<p>OK, you know all " . $count . " word(s) well!</p>"; 
}

?>
<script type="text/javascript">
    //<![CDATA[
    var contexth = window.parent.frames['h'].document;
    <?php echo $javascript; ?> 
    $('#learnstatus', contexth).html('<?php echo addslashes(texttodocount2($_REQUEST['text'])); ?>');
    window.parent.frames['l'].setTimeout('cClick()', 1000);
    //]]>
</script>
<?php

pageend();

?>
