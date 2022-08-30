<div class="reply_view">
    <h3>댓글목록</h3>
        <?php
            $sql3 = "select * from comment where board_no='".$number."' order by no desc";
           $result2 = $connect->query($sql3);

           while($reply = $result2->fetch_array()){
        ?>
        <div class="dap_lo">
            <div><b><?php echo $reply['name'];?></b></div>
            <div class="dap_to comt_edit"><?php echo nl2br("$reply[comment]"); ?></div>
            <div class="rep_me dap_to"><?php echo $reply['date']; ?></div>

        </div>
    <?php } ?>

    <!--- 댓글 입력 폼 -->
    <div class="dap_ins">
        <form action="reply_ok.php?no=<?echo $number;?>&no=<?php echo $number; ?>" method="POST">
            <input type="hidden" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디" value=<?$_SESSION['userid']?>>
            <div style="margin-top:10px; ">
                <textarea name="content" class="reply_content" id="re_content" ></textarea>
                <button id="rep_bt" class="re_bt">댓글</button>
            </div>
        </form>
    </div>
</div>


 