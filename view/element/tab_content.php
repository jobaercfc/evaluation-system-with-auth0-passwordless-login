<div class='vertical-align row'>
    <?php
        $items_details = $user_items_evals_details->categories->$id;

        foreach ($items_details as $items_detail) {
    ?>
        <h5><b>Item Name : </b><?=$items_detail->item_name;?></h5>
        <h5><b>Item Description : </b><?=$items_detail->item_description;?></h5>

        <h5 class="text-center">Your Mastery Level :</h5>
        <div class="btns-pb">
            <?php
            $item_mastery_count = 1;
            foreach ($item_mastery_level as $item) {
                ?>
                <label>
                    <input checked='' name='button-group' type='radio' value='item'>
                    <span class='btn-pb <?=($item_mastery_count == 1) ? "first" : "";?><?=($item_mastery_count == count($item_mastery_level)) ? "last" : "";?>'><?=$item;?></span>
                    </input>
                </label>
                <?php $item_mastery_count++; } ?>
        </div>
        <div class="row" style="margin-top: 20px"></div>
        <h5 class="text-center">Your Interest Level :</h5>
        <div class="btns-pb">
            <?php
            $item_interest_count = 1;
            foreach ($item_interest_level as $item) {
                ?>
                <label>
                    <input checked='' name='button' type='radio' value='<?=$item;?>>'>
                    <span class='btn-pb <?=($item_interest_count == 1) ? "first" : "";?><?=($item_interest_count == count($item_interest_level)) ? "last" : "";?>'><?=$item;?></span>
                    </input>
                </label>
                <?php $item_interest_count++; } ?>
        </div>
        <hr>
    <?php } ?>

</div>