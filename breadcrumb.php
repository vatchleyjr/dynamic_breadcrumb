<ul class="breadcrumb">
  <li><a class='button small' href='?id=0'>Home</a></li>
  <?php
  $i = 1;
  $bread = array();
  $query = "SELECT * FROM [table] WHERE id = ".$_GET['id'];
  $result = db_select($query);
  while(count($result[0]) != 0)
  {
    $obj = new stdClass;
    $obj-> $i;
    $obj->id = $result[0][id];
    $obj->name = $result[0][name];
    array_push($bread, $obj);
    $query = "SELECT * FROM [table] WHERE id = ".$result[0][parent_id];
    $result = db_select($query);
    $i++;
  }

  $i=1;
  krsort($bread);
  foreach($bread as $crumb)
  {
    if($i < count($bread))
    {
      print "<li><a class='button small' href='?id=".$crumb->id."'>".$crumb->name."</a></li>";
    } else {
      print "<li><a class='button small disabled primary' href='?id=".$crumb->id."'>".$crumb->name."</a></li>";
    }
    $i++;
  }		
  ?>
</ul>
<?php
if(is_null($_GET['id']))
{
  header('Location: '."?id=0");
} else {
  $query = "SELECT * FROM [table] WHERE parent_id = ".$_GET['id']." ORDER BY name";
}
?>
