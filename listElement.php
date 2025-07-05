<div class="col">
  <div class="review">
    <div class="review-info">ⓘ</div>
    <div>
      <?php $review=$repository->GetNextReview() ?>
      <h3 class="from-headline review-title">
        <?= $review->getName(); ?>
      </h3>
      <p class="form-text from-subheadline review-text">
        <?= $review->getComment() ?>
      </p>
    </div>
  </div>
</div>
