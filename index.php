<style>
    a{
        text-decoration: none;
        color: #3367d6;
    }
</style>
<?php
$jsonStringData = file_get_contents("data/question.json");
  $faqData = json_decode($jsonStringData, true); // True to indicate associative arrays
$jsonStringLinks = file_get_contents("data/links.json");
  $linksData= json_decode($jsonStringLinks, true);

  
function getLinks($response, $linksData){
  $risp= explode("§", $response);
  if (count($risp) == 1){echo $response;}
  else {
    for ($i=0; $i < count($risp); $i++) { 
    // un link per forza di cose sarà sempre in una posizione dispari nel array esploso
      if($i % 2  == 1){
          foreach ($linksData as $link) {
            if($risp[$i] == $link["id"])
            {$risp[$i] = '<a href="' . $link["href"] . '">' . $link["text"] . '</a>';
           
          }}}}
          $risp = implode( "", $risp);
    echo $risp; }


};


  foreach ($faqData as $question) { ?>
    <h2><?= $question["question"] ?></h2>
    <?php foreach ($question["response"] as $response) { 
   if (!is_array($response)) {  ?>
    <p style="margin-bottom: 1rem;"><?php getLinks($response, $linksData) ?></p>
<?php } else{ ?> <ol> <?php foreach ($response as $point) { 
    if (!is_array( $point )) { ?>
       <li><?= $point ?></li>
       <?php   } else { ?> <ol> <?php foreach ($point as $pit){ ?>
        <li><?= $pit ?></li>
         <?php  } ?>
         </ol>
         <?php }
    ?>




<?php } ?> </ol>
<?php
}}}
?>


