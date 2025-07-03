<div class="col">
  <div class="review">
    <div class="review-info">ⓘ</div>
    <div>
      <h3 class="from-headline review-title">
        <?php
          $review = array_pop(Review::$ReviewList);
          echo $review->name;
          array_push(Review::$ReviewList, $review)
        ?>
      </h3>
      <p class="form-text from-subheadline review-text">
        <?php
          echo array_pop(Review::$ReviewList)->comment;
        ?>
      </p>
    </div>
  </div>
</div>
