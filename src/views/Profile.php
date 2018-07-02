<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet" href="../assets/css/main.css">

    <title>Profile</title>

  </head>

  <body class="text-center">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include '../views/Header.php'?>

    <main role="main" class="inner cover">

    <h1 class="profile-heading">Hi, <?=$user->getFullName() ?> (<?=$user->getUsername() ?>)</h1>
    <h3 class="profile-subheading"><?=$user->getEmail()?></h3>
    <h2 class="profile-message">Check out the quotes you've added (<?=sizeof($quotes)?>): </h2>

    <ul class="list-group">
      <section class="cards">
        <?php
            $line_break = 0;
            if(count($quotes) <= 0)
            {
                echo '<li>You haven`t added any quotes yet...</li>';
            }
            else 
            {
                foreach($quotes as $quote)
                {
                  echo  '<article class="card card--2">
                    <div class="card__info-hover">
                      <a href="../controllers/LikeQuote.php?id='.$quote->getId().'" class="like-wrapper"><svg class="card__like"  viewBox="0 0 24 24">
                          <path fill="#000000" d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                        </svg>
                      </a>'.$quote->getLikes().'<div class="card__clock-info">
                          <svg class="card__clock"  viewBox="0 0 24 24"><path d="M12,20A7,7 0 0,1 5,13A7,7 0 0,1 12,6A7,7 0 0,1 19,13A7,7 0 0,1 12,20M19.03,7.39L20.45,5.97C20,5.46 19.55,5 19.04,4.56L17.62,6C16.07,4.74 14.12,4 12,4A9,9 0 0,0 3,13A9,9 0 0,0 12,22C17,22 21,17.97 21,13C21,10.88 20.26,8.93 19.03,7.39M11,14H13V8H11M15,1H9V3H15V1Z" />
                          </svg><span class="card__time">'. $quote->getDateAdded() .'</span>
                        </div>
                        <div class="category">
                        <em>'
                        .
                          $quote->getCategoryName()
                        .
                        '</em></div>
                      
                    </div>
                    <div class="card__img"></div>
                    <a href="./GetQuote.php?id='.$quote->getId().'" class="card_link">
                       <div class="card__img--hover"></div>
                     </a>
                    <div class="card__info">
                      <span class="card__category">' . $quote->getTitle() . '</span>
                      <h3 class="card__title">'. substr($quote->getQuoteText(), 0, 50) .'...</h3>
                      <span class="card__by">by <a href="#" class="card__author" title="author">'. $quote->getRealAuthor() .'</a></span>
                      <br>                    
                      </div>
                  </article>';
                  
                  $line_break += 1;
                  if($line_break == 3) {
                    $line_break = 0;
                    echo '</section>';
                    echo '<section class="cards">';
                  }
                }

                echo '</section>';
                echo '<h2 class="profile-message">Check out the quotes you`ve liked ('.sizeof($liked_quotes).'): </h2></br>';
                echo '<section class="cards">';

                foreach($liked_quotes as $quote)
                {
                  echo  '<article class="card card--2">
                    <div class="card__info-hover">
                      <a href="../controllers/LikeQuote.php?id='.$quote->getId().'" class="like-wrapper"><svg class="card__like"  viewBox="0 0 24 24">
                          <path fill="#000000" d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                        </svg>
                      </a>'.$quote->getLikes().'<div class="card__clock-info">
                          <svg class="card__clock"  viewBox="0 0 24 24"><path d="M12,20A7,7 0 0,1 5,13A7,7 0 0,1 12,6A7,7 0 0,1 19,13A7,7 0 0,1 12,20M19.03,7.39L20.45,5.97C20,5.46 19.55,5 19.04,4.56L17.62,6C16.07,4.74 14.12,4 12,4A9,9 0 0,0 3,13A9,9 0 0,0 12,22C17,22 21,17.97 21,13C21,10.88 20.26,8.93 19.03,7.39M11,14H13V8H11M15,1H9V3H15V1Z" />
                          </svg><span class="card__time">'. $quote->getDateAdded() .'</span>
                        </div>
                        <div class="category">
                        <em>'
                        .
                          $quote->getCategoryName()
                        .
                        '</em></div>
                      
                    </div>
                    <div class="card__img"></div>
                    <a href="./GetQuote.php?id='.$quote->getId().'" class="card_link">
                       <div class="card__img--hover"></div>
                     </a>
                    <div class="card__info">
                      <span class="card__category">' . $quote->getTitle() . '</span>
                      <h3 class="card__title">'. substr($quote->getQuoteText(), 0, 50) .'...</h3>
                      <span class="card__by">by <a href="#" class="card__author" title="author">'. $quote->getRealAuthor() .'</a></span>
                      <br>                    
                      </div>
                  </article>';
                  
                  $line_break += 1;
                  if($line_break == 3) {
                    $line_break = 0;
                    echo '</section>';
                    echo '<section class="cards">';
                  }
                }

            }
        ?>
</ul>
      </main>
    </div>
  </body>
</html>