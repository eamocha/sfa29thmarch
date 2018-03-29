<form  id="filtersForm"  class="filtersForm" action="<?php  echo $_SERVER['PHP_SELF']?>">                        
                         <table width="100%"  class="table table-condensed">
                        <tr> <td> <p>Has Electricity </p>  <select id="has_electricity"><?php echo yesOrNo() ?></select>  </td>
                           <td> <p> Active outlet </p> <select id="sales_coke_products"><?php echo yesOrNo() ?></select>  </td>
                             <td><p> Location occassion </p>  <select id="location_occassions"><option value="-1">Any</option><option value="Market">Market</option><option value="Residential">Residential</option><option value="Shops">Shops</option><option value="Transport">Transport</option><option value="Work/Business">Work/Business</option></select> </td>
                               <td><p>  Has Asset </p>  <select id="has_asset"><?php echo yesOrNo() ?></select>   </td> 
                                <td><p>Channel Type  </p> <select id="channel_id"><option  value="-1">All channels </option><?php echo channel_selection()?></select>  </td><td> <p> Sales FMCG </p>  <select id="sales_fmcg"><?php echo yesOrNo() ?></select>  </td> 
                           </tr><tr> <td><p>Sales Beverages</p><select id="do_you_sell_any_bevs"><?php echo yesOrNo() ?></select></td> 
                                  <td><p> Stopped stocking Coke</p><select id="stocked_coke_inthePast"><?php echo yesOrNo() ?></select></td> <td>  <p> Willing to sell coke </p>  <select id="willing_to_stock_coke"><?php echo yesOrNo() ?></select>  </td>
                                   <td> <p> Opening time  </p> <select id="opening_time"><option value="-1">All</option><?php echo time_selection()?></select>  </td> <td><p> Closing time </p>  <select id="closing_time" ><option value="-1">All</option><?php echo time_selection()?></select> </td><td></td>
                     </tr> </table>
                  </form>