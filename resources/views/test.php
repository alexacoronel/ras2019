<html>

   <head>
      <title>Form Example</title>
   </head>

   <body>
      <form action = "/api" method = "post">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

         <table>
            <tr>
               <td>Name</td>
               <td><input type = "text" name = "json" /></td>
            </tr>

            <tr>
               <td colspan = "2" align = "center">
                  <input type = "submit" value = "Register" />
               </td>
            </tr>
         </table>
      </form>
   </body>
</html>
