      <div id="ReviewList" class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
        <!--Здесь с помощью php будут размещаться отзывы из MySQL базы данных-->
        <?php
        require 'classes/Review.php';
		require 'classes/ReviewRepository.php';

		const ERROR = "Произошла ошибка при загрузке отзывов: ошибка выполнения запроса к базе данных";

		$repository = new ReviewRepository(); //в этом объекте будут все отзывы из базы данных

		//подключение к базе данных
		try
		{
        	$connection = new mysqli("localhost", "root", "123456789");
        	if($connection->connect_error)
        	{
          		echo "Произошла ошибка при попытке загрузки отзывов: " . $connection->connect_error;
        	}
        	$command = "SELECT name, comment FROM smartsoft.reviews;";
        	if ($result = $connection->query($command))
        	{
        		foreach($result as $row)
        		{
					$repository->addReview(new Review($row["name"], $row["comment"]));
        		}
        	}
        	else
			{
          		die(ERROR);
        	}
        	$connection->close();
		}			
		catch (Exception $e)
		{
			die(ERROR);
		}

		//выбор уникальных отзывов
		$repository->GetRandom(6);

		//загрузка блоков отзывов
		for($i = 0; $i < 6; $i++)
		{
        	include("listElement.php");
		}
        ?>
      </div>