<?php
/*
 *  getPageData(numHits,limit,page)
 *      numHits :- indecates total number of records within the table matching the result of query
 *      limit :- indecates number of records to be displayed per page
 *      page :- indecates the page number passed via query-string
 *      this function returns an array having following information.
 *      offset,limit,numPages,page
 *      offset :- indecate starting value of each page
 *      limit :- indecates number of records to be displayed per page
 *      numPages :- indecates total number of pages to be generated
 *      page :- indecates current page no.
 */

/*
 *  pagedata($limit,$tbl,$t_field,$page)
 *      limit :- indecates number of records to be displayed per page
 *      tbl :- indecates table name
 *      t_field :- indecates field name within given table
 *      page :- indecates current page no.
 *      
 *      this function returns an array having following information;
 *      offset,limit,page,numPages,total
 *      offset :- indecate starting value of each page
 *      limit :- indecates number of records to be displayed per page
 *      numPages :- indecates total number of pages to be generated
 *      page :- indecates current page no.
 *      total :- indecates total records within the table
 */

/*
 *  page_strip($page,$fdir,$pager)
 *      this function is used to generate the paging strip
 *      
 *      page :- indecates the current page no.
 *      fdir :- indecates the page where where the page no. data is to be sent
 *      pager :- an array having information returned by pagedata() function.
 * 
 *      NOTE : please check manual file for information about inbuilt function used in this file.
 */
     function getPagerData($numHits, $limit,$page) 
     {
          $numHits = (int) $numHits;
          $limit = max((int) $limit, 1); // returns max no. as limit from given arguments
          $page = (int) $page;
          $numPages = ceil($numHits / $limit); //returns number of pages by dividing tot. records / limit
          $page = max($page, 1); // returns max page
          $page = min($page, $numPages); // returns min page
          $offset = ($page - 1) * $limit; // returns starting record no. for each page
          $ret['offset'] = $offset;
          $ret['limit'] = $offset+$limit;
          $ret['numPages'] = $numPages;
          $ret['page'] = $page;
          return $ret;
    }
    function pagedata($l,$total,$page)
    {
          $limit = $l; 
          //$result = mysql_query("SELECT COUNT(id) AS count_data FROM $tbl");
          //$total = count($arr); // returns total record count within table
          $pager  = getPagerData($total, $limit, $page); 
          $pdata['offset'] = $pager['offset'];
          $pdata['limit']  = $pager['limit'];
		//  echo $total;
          $pdata['page']   = $pager['page'];
          $pdata['numPages'] = $pager['numPages'];
          $pdata['total']=$total;
          if ($total == 0) {
            $pdata['offset'] = 0;
          }
          return $pdata;
    }
  function page_strip($page,$fdir,$pager) 
  {
      
      if ($pager['total'] > 0) // generates page strip only if total no. of records found in table are greater than zero
      {
        if ($page == 1) // if current page no. is one then disable "prev" link used to navigete towords previous page
        {
             ?> <span class="paginate_button">Previous</span><?php 
        }
        else 
        {
            // here $fdir indecates page name where key-value pair(query string) is to be sent
        ?>
           <a href="<?php echo $fdir; ?>?p=<?php echo ($page - 1); ?>"><span class="paginate_button">Previous</span></a><?php 
        }
        // following for loop is used to generate the page numbers to be displayed in the paging strip
        for ($i=$page-3;$i<$page;$i++) 
        {
          
          if ($i  >  0) // if $i not matches current page then generate link having query string that indicates page number else disable link
          {
            echo '<a href="' . $fdir . '?p=' . $i . '"><span class="paginate_button">' . $i . '</span></a>' . '&nbsp;&nbsp;';
          }   
        }
		echo '<span class="paginate_active"><strong>' . $i . '</strong></span>';
		for ($i=$page+1;$i<=$pager['numPages'];$i++) 
        {
			echo '<a href="' . $fdir . '?p=' . $i . '"> <span class="paginate_button">' . $i . '</span></a>' . '&nbsp;&nbsp;';
			if ($i >=$page+3) // if $i not matches current page then generate link having query string that indicates page number else disable link
          	{
           		 break;
          	}
       	}  
        //// if current page no. is equals to last page then disable "next" link used to navigete towords next page
        if ($page == $pager['numPages'] ) { ?> <span class="paginate_button">Next</span><?php } else { ?>
    <a href="<?php echo $fdir; ?>?p=<?php echo ($page + 1); ?>"><span class="paginate_button">Next</span></a><?php } ?>
    <?php
      }
} 

function page_strip_submit($page,$fdir,$pager,$var,$value) 
  {
      
      if ($pager['total'] > 0) // generates page strip only if total no. of records found in table are greater than zero
      {
        if ($page == 1) // if current page no. is one then disable "prev" link used to navigete towords previous page
        {
             ?> <span class="paginate_button">Previous</span><?php 
        }
        else 
        {
            // here $fdir indecates page name where key-value pair(query string) is to be sent
        ?>
           <a href="<?php echo $fdir; ?>?p=<?php echo ($page - 1); ?>&<?php echo $var.'='.$value; ?>"><span class="paginate_button">Previous</span></a><?php 
        }
        // following for loop is used to generate the page numbers to be displayed in the paging strip
        for ($i=$page-3;$i<$page;$i++) 
        {
          
          if ($i  >  0) // if $i not matches current page then generate link having query string that indicates page number else disable link
          {
           echo '<a href="' . $fdir . '?p=' . $i.'&'.$var.'='.$value.'"><span class="paginate_button">' . $i . '</span></a>' . '&nbsp;&nbsp;';
          }   
        }
		echo '<span class="paginate_active"><strong>' . $i . '</strong></span>';
		for ($i=$page+1;$i<=$pager['numPages'];$i++) 
        {
			echo '<a href="' . $fdir . '?p=' . $i.'&'.$var.'='.$value.'"><span class="paginate_button">' . $i . '</span></a>' . '&nbsp;&nbsp;';
			if ($i >=$page+3) // if $i not matches current page then generate link having query string that indicates page number else disable link
          	{
           		 break;
          	}
       	}  
        //// if current page no. is equals to last page then disable "next" link used to navigete towords next page
        if ($page == $pager['numPages'] ) { ?> <span class="paginate_button">Next</span><?php } else { ?>
     <a href="<?php echo $fdir; ?>?p=<?php echo ($page + 1); ?>&<?php echo $var.'='.$value; ?>"><span class="paginate_button">Next</span></a><?php } ?>
    <?php
      }
} 

function page_strip_from_to($page,$fdir,$pager,$var1,$value1,$var2,$value2) 
  {
      
      if ($pager['total'] > 0) // generates page strip only if total no. of records found in table are greater than zero
      {
        if ($page == 1) // if current page no. is one then disable "prev" link used to navigete towords previous page
        {
             ?> <span class="paginate_button">Previous</span><?php 
        }
        else 
        {
            // here $fdir indecates page name where key-value pair(query string) is to be sent
        ?>
          <a href="<?php echo $fdir; ?>?p=<?php echo ($page - 1); ?>&<?php echo $var1.'='.$value1; ?>&<?php echo $var2.'='.$value2; ?>"> <span class="paginate_button">Previous</span></a><?php 
        }
        // following for loop is used to generate the page numbers to be displayed in the paging strip
        for ($i=$page-3;$i<$page;$i++) 
        {
          
          if ($i  >  0) // if $i not matches current page then generate link having query string that indicates page number else disable link
          {
             echo '<a href="' . $fdir . '?p=' . $i.'&'.$var1.'='.$value1.'&'.$var2.'='.$value2.'"><span class="paginate_button">' . $i . '</span></a>' . '&nbsp;&nbsp;';
          }   
        }
		echo '<span class="paginate_active"><strong>' . $i . '</strong></span>';
		for ($i=$page+1;$i<=$pager['numPages'];$i++) 
        {
			 echo '<a href="' . $fdir . '?p=' . $i.'&'.$var1.'='.$value1.'&'.$var2.'='.$value2.'"><span class="paginate_button">' . $i . '</span></a>' . '&nbsp;&nbsp;';
			if ($i >=$page+3) // if $i not matches current page then generate link having query string that indicates page number else disable link
          	{
           		 break;
          	}
       	}  
        //// if current page no. is equals to last page then disable "next" link used to navigete towords next page
        if ($page == $pager['numPages'] ) { ?><span class="paginate_button">Next</span><?php } else { ?><a href="<?php echo $fdir; ?>?p=<?php echo ($page + 1); ?>&<?php echo $var1.'='.$value1; ?>&<?php echo $var2.'='.$value2; ?>"><span class="paginate_button">Next</span></a><?php } ?>
    <?php
      }
} 

function page_strip_log($page,$fdir,$pager,$var1,$value1,$var2,$value2,$var3,$value3) 
  {
      
      if ($pager['total'] > 0) // generates page strip only if total no. of records found in table are greater than zero
      {
        if ($page == 1) // if current page no. is one then disable "prev" link used to navigete towords previous page
        {
             ?> <span class="paginate_button">Previous</span><?php 
        }
        else 
        {
            // here $fdir indecates page name where key-value pair(query string) is to be sent
        ?>
          <a href="<?php echo $fdir; ?>?p=<?php echo ($page - 1); ?>&<?php echo $var1.'='.$value1; ?>&<?php echo $var2.'='.$value2; ?>&<?php echo $var3.'='.$value3; ?>"> <span class="paginate_button">Previous</span></a><?php 
        }
        // following for loop is used to generate the page numbers to be displayed in the paging strip
        for ($i=$page-3;$i<$page;$i++) 
        {
          
          if ($i  >  0) // if $i not matches current page then generate link having query string that indicates page number else disable link
          {
             echo '<a href="' . $fdir . '?p=' . $i.'&'.$var1.'='.$value1.'&'.$var2.'='.$value2.'&'.$var3.'='.$value3.'"><span class="paginate_button">' . $i . '</span></a>' . '&nbsp;&nbsp;';
          }   
        }
		echo '<span class="paginate_active"><strong>' . $i . '</strong></span>';
		for ($i=$page+1;$i<=$pager['numPages'];$i++) 
        {
			 echo '<a href="' . $fdir . '?p=' . $i.'&'.$var1.'='.$value1.'&'.$var2.'='.$value2.'&'.$var3.'='.$value3.'"><span class="paginate_button">' . $i . '</span></a>' . '&nbsp;&nbsp;';
			if ($i >=$page+3) // if $i not matches current page then generate link having query string that indicates page number else disable link
          	{
           		 break;
          	}
       	}  
        //// if current page no. is equals to last page then disable "next" link used to navigete towords next page
        if ($page == $pager['numPages'] ) { ?><span class="paginate_button">Next</span><?php } else { ?><a href="<?php echo $fdir; ?>?p=<?php echo ($page + 1); ?>&<?php echo $var1.'='.$value1; ?>&<?php echo $var2.'='.$value2; ?>&<?php echo $var3.'='.$value3; ?>"><span class="paginate_button">Next</span></a><?php } ?>
    <?php
      }
} 

?>
