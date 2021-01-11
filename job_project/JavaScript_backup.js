<!--<script language="javascript">
 function uncheck_any()
 {
   var any = document.getElementById('Any');
   any.checked = false;
   
   var empty = document.getElementById('empty');
   if(empty.checked)
     empty.checked = false;
 }
 
 function uncheck()
 {
    var on_first = document.getElementById('on_first');
   if(on_first.checked)
     on_first.checked = false;
     
   var on_second = document.getElementById('on_second');
   if(on_second.checked)
     on_second.checked = false;
   
   var on_third = document.getElementById('on_third');
   if(on_third.checked)
     on_third.checked = false;
   
   var empty = document.getElementById('empty');
   if(empty.checked)
     empty.checked = false;
 }
 
 function uncheck_bases()
 {
   var any = document.getElementById('Any');
   any.checked = false;
   
   var on_first = document.getElementById('on_first');
   if(on_first.checked)
     on_first.checked = false;
     
   var on_second = document.getElementById('on_second');
   if(on_second.checked)
     on_second.checked = false;
   
   var on_third = document.getElementById('on_third');
   if(on_third.checked)
     on_third.checked = false;
 }
 
 function count_cb(cols)
 {
   var count = 0;
   
   for(i = 0; i < cols.length; i++)
   {
     if(cols[i].checked == true)
       count++;
   }
       
   if(count > 14)
   {
     for(i = 0; i < cols.length; i++)
     {
       if(cols[i].checked == false)
         cols[i].disabled = true;
     }
   }
   else
   {
     for(i = 0; i < cols.length; i++)
     {
       if(cols[i].disabled == true)
         cols[i].disabled = false;
     }
   }
 }
 
 function uncheck_cols(cols)
 {
   for(i = 0; i < cols.length; i++)
   {
     if(cols[i].checked == true)
       cols[i].checked = false;
     
     cols[i].disabled = false;
   }
 }
</script>-->