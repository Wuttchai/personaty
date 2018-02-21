!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Bootstrap Multi Select Dropdown with Checkboxes using Jquery in PHP</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
</head>
 <body>
  <br /><br />
  <div class="container" style="width:600px;">
   <h2 align="center">Bootstrap Multi Select Dropdown with Checkboxes using Jquery in PHP</h2>
   <br /><br />
   <form method="post" id="framework_form">
    <div class="form-group">
     <label>Select which Framework you have knowledge</label>
     <select id="example-getting-started" multiple="multiple">
                                   <option value="cheese">Cheese</option>
                                   <option value="tomatoes">Tomatoes</option>
                                   <option value="Mozzarella">Mozzarella</option>
                                   <option value="Mushrooms">Mushrooms</option>
                                   <option value="Pepperoni">Pepperoni</option>
                                   <option value="Onions">Onions</option>
                               </select>

    </div>
    <div class="form-group">
     <input type="submit" class="btn btn-info" name="submit" value="Submit" />
    </div>
   </form>
   <br />
  </div>
 </body>
</html>

<script>
$(document).ready(function() {
                                       $('#example-getting-started').multiselect();
                                   });
</script>
