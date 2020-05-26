<?php
include("./php_includes/mysqli_connect.php");

echo '<form class="form-horizontal" action="/action_page.php">';
  echo '<div class="form-group">';
    echo '<label class="control-label col-sm-2" for="question">Poll Question:</label>';
    echo '<div class="col-sm-10">';
      echo '<input type="text" class="form-control" id="question" placeholder="Poll question">
    </div>';
  echo '</div>';
  echo '<label class="radio-inline"><input type="radio" value="poll" name="optradio" checked>Poll</label>';
  echo '<label class="radio-inline"><input type="radio" value="quiz" name="optradio">Quiz</label>';
  echo '<div class="form-group">';
    echo '<label class="control-label col-sm-2" for="Option1">Option 1:</label>';
    echo '<div class="col-sm-10">';
      echo '<input type="text" class="form-control" id="option1" placeholder="Option 1">
    </div>';
  echo '</div>';
  echo '<div class="form-group">';
    echo '<label class="control-label col-sm-2" for="Option2">Option 2:</label>';
    echo '<div class="col-sm-10">';
      echo '<input type="text" class="form-control" id="option2" placeholder="Option 2">
    </div>';
  echo '</div>';
  echo '<div class="form-group">';
    echo '<label class="control-label col-sm-2" for="Option3">Option 3:</label>';
    echo '<div class="col-sm-10">';
      echo '<input type="text" class="form-control" id="option3" placeholder="Option 3">
    </div>';
  echo '</div>';
  echo '<div class="form-group">';
    echo '<label class="control-label col-sm-2" for="Option4">Option 4:</label>';
    echo '<div class="col-sm-10">';
      echo '<input type="text" class="form-control" id="option4" placeholder="Option 4">
    </div>';
  echo '</div>';
  echo '<div class="form-group">';
    echo '<label class="control-label col-sm-2" for="Option5">Option 5:</label>';
    echo '<div class="col-sm-10">';
      echo '<input type="text" class="form-control" id="option5" placeholder="Option 5">
    </div>';
  echo '</div>';
  echo '<div class="form-group">';
    echo '<div class="col-sm-offset-2 col-sm-10">';
      echo '<button type="submit" class="btn btn-default">Submit</button>
    </div>';
  echo '</div>';
echo '</form>';
?>
