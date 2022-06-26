<div class="mt-3 mb-4">
    <?php echo do_shortcode("[breadcrumb]"); ?>
</div>
<div class="row mb-5">
    <form class="col-lg-8 col-md-12 col-sm-12 col-12 " method="post" action="<?php echo get_site_url();?>/?s">
        <div class="d-table w-100 ">

            <div class="filter-form-group input-group">

                <?php
      $args = array(
        'show_option_all'    => '選擇',
        'orderby'            => 'ID', 
        'order'              => 'ASC',
        'hide_empty'         => 0, 
        'child_of'           => 0,
        'hierarchical'       => 1, 
        'class' => 'form-select',
        'depth'              => 0,
        'taxonomy'           => 'category',
        'hide_if_empty'      => false ); 


                wp_dropdown_categories($args);



                ?>
            </div>

            <div class="filter-form-group input-group">

                <select name="year" id="year" class="form-select">

                    <option value="">年份</option>
                    <?php
        $start_year=1999; 
        for($i=date('Y');$i>=$start_year;$i--) {
            ?>
                    <option value="<?php echo $i?>">
                        <?php echo $i?>年
                    </option>
                    <?php
     } ?>
                    <!-- <?php if(date('Y')==$i){ echo'selected="selected"';}  ?> -->


                </select>

            </div>

            <div class="filter-form-group input-group">

                <select name="month" id="month" class="form-select">
                    <option value="">月份</option>

                    <option value="12">12月</option>
                    <option value="11">11月</option>
                    <option value="10">10月</option>
                    <option value="9">9月</option>
                    <option value="8">8月</option>
                    <option value="7">7月</option>
                    <option value="6">6月</option>
                    <option value="5">5月</option>
                    <option value="4">4月</option>
                    <option value="3">3月</option>
                    <option value="2">2月</option>
                    <option value="1">1月</option>
                    <!-- <?php if(date('m')=='01'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='02'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='03'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='04'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='05'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='06'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='07'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='08'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='09'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='10'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='11'){ echo'selected="selected"';}  ?> 
<?php if(date('m')=='12'){ echo'selected="selected"';}  ?>  -->
                </select>

            </div>


            <div class="filter-form-group input-group">
                <input name="search-txt" id="search-txt" type="search" class="form-control rounded" placeholder="搜尋..."
                    aria-label="搜尋..." aria-describedby="search-addon" />
                <button type="submit" class="btn filter-search-btn"></button>
            </div>
        </div>
    </form>



    <?php  $tags = get_tags();
                    if($tags)
                    {
?>
    <div class="tags-div col-lg-4 col-md-12 col-sm-12 col-12  ">

        <div class="row">

            <h5 class="col-12">Tags:</h5>
            <div class="tagcloud col-10">
                <?php
                        
                    echo '<ul>';
                    for($i=0;$i<sizeof($tags);$i++)
                    {
                        echo '<li><a href="'.get_site_url().'/tag/'.$tags[$i]->slug.'/">#'.$tags[$i]->name.'</a></li>';
                    }
                    echo '</ul>';


?>
            </div>
        </div>
    </div>

</div>
<?php 
                    }?>



<script type="text/javascript">
$(function() {

    $('.filter-search-btn').click(function() {

        window.location = '<?php echo get_site_url();?>?s=' + $('#search-txt').val() + '&c=' + $('#cat')
            .val();
    });
})
</script>