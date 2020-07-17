<div class='vertical-align row'>
    <form method="" action="" id="form_category_<?=$id;?>" name="form_category_<?=$id;?>">

    <?php
        $items_details = $user_items_evals_details->categories->$id;

        foreach ($items_details as $items_detail) {
    ?>
        <h5><b><?=$labels['eval_page']['item_name'];?> : </b><?=$items_detail->item_name;?></h5>
        <h5><b><?=$labels['eval_page']['item_description'];?> : </b><?=$items_detail->item_description;?></h5>

        <h5 class="text-center"><?=$labels['eval_page']['mastery_level'];?> :</h5>
        <div class="btns-pb form_category_<?=$id;?>_input">
            <?php
            $item_mastery_count = 1;
            foreach ($item_mastery_level as $item) {
                ?>
                <label class="mastery-label">
                    <input name='mastery_<?=$items_detail->specific_item_id?>' type='radio' value='<?=$item;?>'>
                    <span class='btn-pb <?=($item_mastery_count == 1) ? "first" : "";?><?=($item_mastery_count == count($item_mastery_level)) ? "last" : "";?>'><?=$item;?></span>
                    </input>
                </label>
                <?php $item_mastery_count++; } ?>
        </div>
        <div class="row" style="margin-top: 20px"></div>
        <h5 class="text-center"><?=$labels['eval_page']['interest_level'];?> :</h5>
        <div class="btns-pb form_category_<?=$id;?>_input">
            <?php
            $item_interest_count = 1;
            foreach ($item_interest_level as $item) {
                ?>
                <label class="interest-label">
                    <input name='interest_<?=$items_detail->specific_item_id;?>' type='radio' value='<?=$item;?>'>
                    <span class='btn-pb <?=($item_interest_count == 1) ? "first" : "";?><?=($item_interest_count == count($item_interest_level)) ? "last" : "";?>'><?=$item;?></span>
                    </input>
                </label>
                <?php $item_interest_count++; } ?>
        </div>
        <hr>
    <?php } ?>
    </form>
</div>