<div id="overview1" ><h3 style="background-color:#FFF">Overview</h3>
<?php include_once("assets/lib/config.php");include_once("assets/lib/functions.php"); $dealer_id=$_REQUEST['dealer_id'];
 
 
 ?><table width="100%"  class='table'>
 <?php
 
  $surveyQ=mysqli_query($mysqli,"SELECT `survey_id`, question,q_type, `survey_date`, `q_id`, `answer`,  `dealer_id` FROM `tbl_survey` s LEFT JOIN tbl_survey_questions sq on sq.survey_qID=s.q_id WHERE dealer_id=$dealer_id order by survey_id desc ")or die(mysqli_error($mysqli));
				   while($s_row=mysqli_fetch_array($surveyQ)){
					   
					   $qtype= $s_row["q_type"];
					   $q_id=$s_row["q_id"]
					   ?> 
                   
                   <tr>
                      <td colspan="4" nowrap><p style=" font-weight:bold; color:#000"><?php echo $s_row["question"]?></p></td>
                     <tr>
                      <td colspan="4" nowrap><?php   if($qtype=="CheckBox") { $array=checkbox_answers($q_id);
					  for($ar=0;$ar<=count($array) ;$ar++) {
  echo $array[$ar] . '<br />';
}}
  else if($qtype=="Radio") echo getColumnName('tbl_question_options','option_name',"main_question_id=$q_id"); else echo $s_row["answer"]?></td>
                      <?php } ?>
                     

<tr>

   
                  
                       </table>
 
 
