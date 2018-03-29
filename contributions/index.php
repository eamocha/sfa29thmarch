<?php session_start(); $USER_ID=$_SESSION['u_id'];
if(!isset($_SESSION['u_id']) ){header("location:../login.php");} 

include "../assets/lib/functions.php";
include "../assets/lib/config.php";
 //$connect = mysqli_connect("localhost", "root", "", "sfa");  
 $query = "SELECT * FROM tbl_sku_contributions where added_by=$USER_ID ORDER BY sku_contribution_id limit 1000 ";  
 $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));  
 ?>  
 <!DOCTYPE html>  
 <html> 
      <head>  
           <title>import excel</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:900px;">  
                <h2 align="center">Import CSV File Data</h2>  
                <h3 align="center">Route data</h3><br />  
                <form id="upload_csv" method="post" enctype="multipart/form-data">  
                     <div class="col-md-3">  
                          <br />  
                          <label>Attach file</label>  
                     </div>  
                     <div class="col-md-3">  
                          <input type="file" name="employee_file" style="margin-top:15px;" />  
                     </div>
                     <div class="col-md-3"><label>Select SKU</label> <select  id="sku" name="sku" >
                     <option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">10</option>
<option value="10">12</option>
<option value="11">11</option>
<option value="12">110</option>
<option value="13">9</option>
<option value="14">13</option>
<option value="15">17</option>
<option value="16">19</option>
<option value="17">20</option>
<option value="18">21</option>
<option value="19">22</option>
<option value="20">23</option>
<option value="21">25</option>
<option value="22">24</option>
<option value="23"></option>
<option value="24">26</option>
<option value="25">27</option>
<option value="26">28</option>
<option value="27">68</option>
<option value="28">69</option>
<option value="29">70</option>
<option value="30">71</option>
<option value="31">29</option>
<option value="32">31</option>
<option value="33">32</option>
<option value="34">33</option>
<option value="35">34</option>
<option value="36">35</option>
<option value="37">36</option>
<option value="38"></option>
<option value="39">37</option>
<option value="40">50</option>
<option value="41">47</option>
<option value="42">38</option>
<option value="43">39</option>
<option value="44">40</option>
<option value="45">41</option>
<option value="46">43</option>
<option value="47">45</option>
<option value="48">46</option>
<option value="49">53</option>
<option value="50">54</option>
<option value="51">55</option>
<option value="52">56</option>
<option value="53">57</option>
<option value="54">58</option>
<option value="55">59</option>
<option value="56">60</option>
<option value="57">61</option>
<option value="58">62</option>
<option value="59">65</option>
<option value="60">66</option>
<option value="61">111</option>
<option value="62">112</option>
<option value="63">113</option>
<option value="64">90</option>
<option value="65">114</option>


</select></div>
                     <div class="col-md-3">  
                          <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />  
                     </div>  
                     <div style="clear:both"></div>  
                </form>  
                <br /><br /><br />  
                <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered">  
                          <tr>  
                                 
                          <th width="5%">contributionId</th>  
                          <th width="25%">contribution</th>  
                          <th width="35%">Sku</th>  
                          <th width="10%">added by</th>  
                          <th width="20%">boundary</th>  
                          <th width="5%">route_id</th>  
                          </tr>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["sku_contribution_id"]; ?></td>  
                               <td><?php echo $row["contribution"]; ?></td>  
                               <td><?php echo product_name($row['sku_id']) ?></td>  
                               <td><?php echo $row["added_by"]; ?></td>  
                               <td><?php echo $row["boundary"]; ?></td>  
                               <td><?php  echo $row["boundary_id"]; ?></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
      $(document).ready(function(){  
           $('#upload_csv').on("submit", function(e){  
                e.preventDefault(); //form will not submitted  
                $.ajax({  
                     url:"import.php",  
                     method:"POST",  
                     data:new FormData(this),  
                     contentType:false,          // The content type used when sending data to the server.  
                     cache:false,                // To unable request pages to be cached  
                     processData:false,          // To send DOMDocument or non processed data file it is set to false  
                     success: function(data){  
                          if(data=='Error1')  
                          {  
                               alert("Invalid File");  
                          }  
                          else if(data == "Error2")  
                          {  
                               alert("Please Select File");  
                          }  
                          else  
                          {  
                               $('#employee_table').html(data);  
                          }  
                     }  
                })  
           });  
      });  
 </script>  