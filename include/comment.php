<?php
include SITE_ROOT."/controller/comment.php";

?>


    <div class="col-md-12 col-12 comments" style="margin-bottom: 2em">
        <h3>Оставить комментарий</h3>
            <?php include_once SITE_ROOT."/helps/errorinfo.php"?>
        <form action="" method="post">
            <input hidden name="id_post" value="<?= $page ?>">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email Адрес</label>
                <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Напишите ваш отзыв</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
            </div>
            <div class="col-12" >
                <button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
            </div>
        </form>

            <?php if (count($comments)>0): ?>
                <div class="row all-comments" id="comm" style="padding: 3rem 0;">
                        <h3 class="col-12" style="margin-bottom: 2rem">Комментарии к записи</h3>
                    <?php foreach ($comments as $com):?>
                        <div class="one-comment" style="padding: 10px 0; ">
                            <i class="far fa-user" style="margin-left:12px; padding: 0.5rem; background: #b8b8b8; border-radius: 4px 4px 0 0">
                                <span style="display: inline-flex;"><?= $com['email'] ?></span>
                            </i>
                            <i class="fa-solid fa-calendar" style="padding: 0.5rem; background: #b8b8b8;  border-radius: 4px 4px 0 0">
                                <span style="font-weight: normal;"><?= $com['created_date'] ?></span>
                            </i>
                            <div class="col-12 text" style="padding: 0.75rem; border: 1px solid #008484; border-radius: 4px">
                                <?= $com['comment']?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

    </div>


