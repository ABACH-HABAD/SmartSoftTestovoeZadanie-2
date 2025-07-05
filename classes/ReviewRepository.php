<?php
class ReviewRepository 
{
    private array $allReviews = [];
    private array $selectedReviews = [];

    public function addReview(Review $review): void 
    {
        $this->allReviews[] = $review;
    }

    //выбор уникальных отзывов
    public function GetRandom(int $count = 6)
    {	
        if ($count > count($this->allReviews))
        {
            $count = count($this->allReviews);
        }

    	$randomKeys = array_rand($this->allReviews, $count);
    	$randomArray = [];
    	foreach ($randomKeys as $key) 
        {
    	    $randomArray[] = $this->allReviews[$key];
    	}
        $this->selectedReviews = $randomArray;
    }

    //Получение нового отзыва из имеющихся
    public function GetNextReview() : Review 
    {
        if (count($this->selectedReviews) > 0)
        {
            return array_pop($this->selectedReviews);
        }
        else
        {
            if (count($this->allReviews) > 0)
            {
                $this->GetRandom(count($this->allReviews));
                return $this->GetNextReview();
            }
            else return new Review("Ошибка", "Не удалось загрузить отзыв");
        }
    }
}
?>