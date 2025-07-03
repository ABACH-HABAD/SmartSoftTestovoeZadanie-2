      <div id="ReviewList" class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
        <!--Здесь с помощью php будут размещаться отзывы из MySQL базы данных-->
        <?php
        require 'classes/review.php';

        $reviewsArray = []; //в этом массиве будут все отзывы из базы данных

				//подключение к базе данных
        $connection = new mysqli("localhost", "root", "123456789");
        if($connection->connect_error)
        {
          die("Ошибка: " . $connection->connect_error);
        }
        $command = "SELECT id, name, comment FROM smartsoft.reviews;";
        if ($result = $connection->query($command))
        {
          $i = 0;
          foreach($result as $row)
          {
						$id = $row["id"];
            $name = $row["name"];
            $comment = $row["comment"];
            array_push($reviewsArray, new Review($id, $name, $comment));
            $i++;
          }
        }
        else{
          echo "Произошла ошибка при выполнении запроса к базе данных";
        }
        $connection->close();

				//выбор уникальных отзывов
				$usedId = array_fill(0, 6, null);
      	for ($i = 0; $i < count($usedId); $i++) {
        	$goNext = false;
        	while (!$goNext) {
          	$goNext = true;
          	$usedId[$i] = rand(0, count($reviewsArray)-1);
          	for ($j = 0; $j < count($usedId); $j++) {
            	if ($i != $j && $usedId[$i] == $usedId[$j]) {
              	$goNext = false;
              	break;
            	}
          	}
          	if ($goNext) break;
        	}
      	}

				//добавление выбранных отзывов в статичный массив
				for($i = 0; $i < 6; $i++)
				{
        	array_push(Review::$ReviewList, $reviewsArray[$usedId[$i]]);
				}

				//загрузка блоков отзывов
				for($i = 0; $i < 6; $i++)
				{
        	include("listElement.php");
				}
        ?>
      </div>